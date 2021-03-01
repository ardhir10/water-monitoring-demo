const modbus = require('jsmodbus');
const net = require('net')
const datetime = require('node-datetime');
const query = require('./pgsqlquery');
const pg = require('./coreQuery');
var jwt = require('jwt-simple');
const isOnline = require('is-online');
var exec = require('child_process').exec;
const util = require('util');
// const exec = util.promisify(require('child_process').exec);
var clear = require('clear');
var sendTelegram = require('./sendTelegram.js')


// ----- GLOBAL CONFIG
var hostWebsocket = 'http://localhost';
var portWebsocket = '1010';
var poolingInterval = 1000; //ms
var loggerInterval = 60; //second

// ----- MQTT GOIOT
const {
    getmqttClient
} = require('./mqttnya')

// ----- JWT API
var server_url = 'http://203.166.207.50/api/server-uji';
var uid = '123456789';
var secretapi = 'secretapi'; //ms
var send_api_interval = 5; //second

const {
    sendJwt
} = require('./testJwt')

var moment = require('moment')

// CONVERT LILTE EDIAN
var buffer = new ArrayBuffer(4);
var view = new DataView(buffer);

// async function getGlobalSetting() {
//     const gs = `SELECT * FROM global_settings ORDER BY id DESC limit 1 `;
//     var globalSetting = await pg.getQuery(gs);
//     return globalSetting;
// }





// ----- WEBSOCKET
const axios = require('axios');

function sendSocket(controllerData, host) {
    axios.post(host + ':' + portWebsocket + '/eh-water', controllerData)
        .then(function (response) {
            // console.log(response.data);
        })
        .catch(function (error) {
            console.log("--->[\x1b[34mWEBSOCKET\x1b[0m] WEBSOCKET ERROR ! ");
        });
};

function sendGatewayStatus(status = {}, host) {
    axios.post(host + ':' + portWebsocket + '/eh-gateway-status', status)
        .then(function (response) {
            // console.log(status);
        })
        .catch(function (error) {
            console.log("--->[\x1b[34mWEBSOCKET\x1b[0m] WEBSOCKET ERROR ! ");
        });
};


// ----- FIX VALUE
function fix_val(val, del = 2) {
    if (val != undefined || val != null) {
        var rounded = val.toFixed(del).toString().replace('.', "."); // Round Number
        return numberWithCommas(rounded); // Output Result
    } else {
        return '-';
    }
}

// ----- Check Konsentran
function checkConsentrant(val){
    if (val === undefined) {
        return '-';
    }
    return val;
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function sendAlarm(req, host) {
    console.log(req);
    axios.post(host + ':' + portWebsocket + '/eh-water-alarm', req)
        .then(function (response) {
            // console.log(status);
        })
        .catch(function (error) {
            console.log(error);
        });
};



// ----- SPREAD JSMODBUS
const InfiniteLoop = require('infinite-loop');



// ----- BACKUP DATABASE
var schedule = require('node-schedule');
// *    *    *    *    *    *
// ┬    ┬    ┬    ┬    ┬    ┬
// │    │    │    │    │    │
// │    │    │    │    │    └ day of week(0 - 7)(0 or 7 is Sun)
// │    │    │    │    └───── month(1 - 12)
// │    │    │    └────────── day of month(1 - 31)
// │    │    └─────────────── hour(0 - 23)
// │    └──────────────────── minute(0 - 59)
// └───────────────────────── second(0 - 59, OPTIONAL)
let backup = async () => {
    const gsc = `SELECT * FROM global_settings ORDER BY id DESC limit 1 `;
    var getSchedule = await pg.getQuery(gsc);
    let second = (getSchedule[0].schedule_second == null) ? '*' : getSchedule[0].schedule_second
    let minute = (getSchedule[0].schedule_minute == null) ? '*' : getSchedule[0].schedule_minute
    let hour = (getSchedule[0].schedule_hour == null) ? '*' : getSchedule[0].schedule_hour
    let dom = (getSchedule[0].schedule_day_of_month == null) ? '*' : getSchedule[0].schedule_day_of_month
    let month = (getSchedule[0].schedule_month == null) ? '*' : getSchedule[0].schedule_month
    let dow = (getSchedule[0].schedule_day_of_week == null) ? '*' : getSchedule[0].schedule_day_of_week
    var j = schedule.scheduleJob(second + ' ' + minute + ' ' + hour + ' ' + dom + ' ' + month + ' ' + dow, async function () {
        // --- Backup Database 
        let commandBackup = exec('cd ../../ && php artisan schedule:run');
        commandBackup.stdout.on('data', function (data) {
            console.log('BACKUPP:====' + data);
        });
    });
}
backup();






function ModbusRead(iterator, optns, addressList) {
    let il = {},
        socket = {},
        options = {},
        client = {},
        dataInsert = {},
        logging = true;

    il[iterator] = new InfiniteLoop();
    socket[iterator] = new net.Socket()
    options[iterator] = {
        'host': optns.host,
        'port': optns.port
    }

    client[iterator] = new modbus.client.TCP(socket[iterator])
    socket[iterator].on('connect', async function () {


        // ----- GET GLOBAL SETTING
        const gs = `SELECT * FROM global_settings ORDER BY id DESC limit 1 `;
        var globalSetting = await pg.getQuery(gs);
        hostWebsocket = (globalSetting[0].websocket_host == null) ? hostWebsocket : globalSetting[0].websocket_host; //ms
        portWebsocket = (globalSetting[0].websocket_port == null) ? portWebsocket : globalSetting[0].websocket_port; //ms
        poolingInterval = (globalSetting[0].websocket_pool_interval == null) ? poolingInterval : globalSetting[0].websocket_pool_interval; //ms
        loggerInterval = (globalSetting[0].db_log_interval == null) ? loggerInterval : globalSetting[0].db_log_interval; //ms

        // ----- GET API SETTING
        const apisetting = `SELECT * FROM api_settings ORDER BY id DESC limit 1 `;
        var apisettings = await pg.getQuery(apisetting);
        server_url = (apisettings[0].server_url == null) ? server_url : apisettings[0].server_url; //ms
        uid = (apisettings[0].uid == null) ? uid : apisettings[0].uid; //ms
        secretapi = (apisettings[0].jwt_secret == null) ? jwt_secret : apisettings[0].jwt_secret; //ms
        send_api_interval = (apisettings[0].send_interval == null) ? send_interval : apisettings[0].send_interval; //ms

        // ----- GET MAINTENANCE
        const mq = `SELECT * FROM maintenance where status = 1 ORDER BY id DESC  `;
        var maintenanceValue = await pg.getQuery(mq);

        // ----- GET GOIOT
        const goiots = `SELECT * FROM goiot_setting ORDER BY id DESC limit 1 `;
        global.goiotSetting = await pg.getQuery(goiots);


        // ----- schedule save database
        let dataLogs = {
            'real': {},
            'maintenance': {},
            'goiot': {},
        };
        let saveIntervalMinute = loggerInterval / 60;
        let saveIntervalSecond = loggerInterval % 60 

        if (saveIntervalMinute<1){
            saveIntervalMinute = '*';
            if (saveIntervalSecond < 1) {
                saveIntervalSecond = '00';
            } else {
                saveIntervalSecond = '*/' + saveIntervalSecond;
            }
        }else{
            saveIntervalMinute = '*/' + loggerInterval/60;
            saveIntervalSecond = '00';
        }
        var saveDatabase = schedule.scheduleJob(`${saveIntervalSecond} ${saveIntervalMinute} * * * *`, async function (data) {
            let dt = datetime.create();
            let dateTime = dt.format('Y-m-d H:M:S');

            // ---- redeclare Tstamp 
            dataLogs['real']['tstamp'] = dateTime 
            dataLogs['maintenance']['tstamp'] = dateTime 

            sendTelegram(dateTime + "INSERT DATABASE")

            console.log('--->[\x1b[35mDATETIME\x1b[0m] ' + dateTime)
            // ----- save to database log and logs_report
            query.insert('logs', dataLogs.real, function (res) {
                console.log('--->[\x1b[36mPGSQL\x1b[0m] ' + res + ' (' + dataLogs.real.controller_name + ')');
            });
            query.insert('log_reports', dataLogs.maintenance, function (res) {
                console.log('--->[\x1b[36mPGSQL\x1b[0m] ' + res + ' (' + dataLogs.maintenance.controller_name + ')');
            });

            // ----- send and save to goiot
            if (goiotSetting[0].status != 0 ){
                try {
                    const mqttKita = await getmqttClient()
                    let PjidAndDevice = goiotSetting[0].clientid.split("#")
                    mqttKita.publish(`v2/${PjidAndDevice[0]}/${PjidAndDevice[1]}/json`, JSON.stringify(dataLogs.goiot))
                    // ----- Kirim data ke goiot 
                    // mqttKita.publish("v2/601db255623f1b65c9642800/DEMO_DEVICE/direct/totalizer", '100')
                    console.log("--->[\x1b[32mGOIOT\x1b[0m] Goiot Send Success !");
                    // [{"tag":"my_tag_1","value":0, "time":"yyyy-MM-dd HH:mm:ss"},{"tag":"my_tag_2"," value":0,"time":"yyyy-MM-dd HH:mm:ss"}]
                } catch (error) {
                    console.log("--->[\x1b[32mGOIOT\x1b[0m] Goiot Send Failed !" + error);
                    console.trace(error)
                    // process.exit(1)
                }
            }
        }.bind(null, dataLogs));


        // ----- SEND KLHK
        let payloadSchedule = {};
        let klhkTstamp = {};
        let klhkIntervalMinute = send_api_interval / 60;
        let klhkIntervalSecond = send_api_interval % 60 

        if (klhkIntervalMinute<1){
            klhkIntervalMinute = '*';
            if (klhkIntervalSecond < 1) {
                klhkIntervalSecond = '00';
            } else {
                klhkIntervalSecond = '*/' + klhkIntervalSecond;
            }
        }else{
            klhkIntervalMinute = '*/' + send_api_interval/60;
            klhkIntervalSecond = '00';
        }
        var sendKlhk = schedule.scheduleJob(`${klhkIntervalSecond} ${klhkIntervalMinute} * * * *`, async function (data) {
            let dt = datetime.create();
            let dateTime = dt.format('Y-m-d H:M:S');
            payloadSchedule['datetime'] = moment(dateTime).unix();
            // ---- redeclare Tstamp 
            sendJwt(dateTime, server_url, payloadSchedule, secretapi)
        }.bind(null, payloadSchedule, klhkTstamp));


        
         


        var counter = 0;
        async function getData() {
            dataLogReports = {};
            counter++;
            let dt = datetime.create();
            let dateTime = dt.format('Y-m-d H:M:S');
            console.log('--->[\x1b[35mDATETIME\x1b[0m] ' + `\x1b[45m${dateTime}\x1b[0m`)

            let result = {};
            let deviceRes = {}
            for (var key in addressList) {
                try {
                    let resp = await client[iterator].readHoldingRegisters(addressList[key], 2)
                    // console.log(key)
                    var strArray = key.split(":");
                    switch (strArray[1]) {
                        case 'FloatBE':
                            // console.log(strArray[0]+ ":"+resp.response._body.valuesAsArray)
                            // view.setInt16(0, resp.response._body.valuesAsArray[1], false);
                            // view.setInt16(2, resp.response._body.valuesAsArray[0], false);
                            // valuemodbus = view.getFloat32(0, false);
                            valuemodbus = resp.response._body._valuesAsBuffer.readFloatBE();
                            break;

                        case 'FloatLE':
                            view.setInt16(0, resp.response._body.valuesAsArray[0], false);
                            view.setInt16(2, resp.response._body.valuesAsArray[1], false);
                            valuemodbus = view.getFloat32(0, false);
                            break;

                        case 'Int16BE':
                            valuemodbus = resp.response._body._valuesAsBuffer.readInt16BE();
                            break;

                        default:
                            valuemodbus = resp.response._body._valuesAsBuffer.readFloatBE();
                            break;
                    }
                    result[strArray[0]] = valuemodbus
                } catch (error) {
                    logging = false;
                    sendGatewayStatus({
                        'status': 'disconnected'
                    }, hostWebsocket);
                    console.log('--->[\x1b[31mGATEWAY STATUS\x1b[0m] Error');
                    process.exit();
                }

            }
            result['tstamp'] = dateTime;
            deviceRes[iterator] = result




            // ----- INSERT DATA
            // ----- KOLOM DAN NAMA TAG YANG DIBACA HARUS SAMA DENGAN DATABASE SENSORS->sensor_name
            dataInsert['tstamp'] = dateTime;
            dataInsert['ph'] = deviceRes[iterator].ph;
            dataInsert['tss'] = deviceRes[iterator].tss;
            dataInsert['amonia'] = deviceRes[iterator].amonia;
            dataInsert['cod'] = deviceRes[iterator].cod;
            dataInsert['flow_meter'] = deviceRes[iterator].flow_meter;
            dataInsert['controller_name'] = iterator;


            // ----- KLHK INIT DATA
            if (maintenanceValue.length) {
                for (const key in maintenanceValue) {
                    if (maintenanceValue.hasOwnProperty(key)) {
                        const el = maintenanceValue[key];
                        deviceRes[iterator][el.sensor] = el.value;
                    }
                }
            }
            var timestamp = moment(dateTime).unix();
            let payload = {
                "ph": checkConsentrant(deviceRes[iterator].ph),
                "tss": checkConsentrant(deviceRes[iterator].tss),
                "amonia": checkConsentrant(deviceRes[iterator].amonia),
                "cod": checkConsentrant(deviceRes[iterator].cod),
                "flow_meter": checkConsentrant(deviceRes[iterator].flow_meter),
                "uid": uid,
                "datetime": timestamp,
            }
            console.log('--->[\x1b[33mPAYLOAD\x1b[0m] '+JSON.stringify(payload));
            let token = jwt.encode(payload, secretapi);
            let encode_payload = {
                'token': token
            };

            // ----- CHECK INTERNET
            let statusKoneksi = await isOnline();
            if (statusKoneksi) {
                let text = 'SPARING ' + uid + ' ' + dateTime + ' ' + fix_val(deviceRes[iterator].ph, 2) + ' ' + fix_val(deviceRes[iterator].cod, 2) + ' ' + fix_val(deviceRes[iterator].tss, 2) + ' ' + fix_val(deviceRes[iterator].amonia, 2) + ' ' + fix_val(deviceRes[iterator].flow_meter, 2) + ' ';
                // ----- Kirim data yang error
                const queryErrorApi = `SELECT * FROM fail_api_logs`;
                let errorData = await pg.getQuery(queryErrorApi);
                // ----- Jika ada data yang error kirim klh kembali
                if (errorData.length > 0) {
                    for (const key in errorData) {
                        let errdata = errorData[key];
                        // ----- Kirim Ke KLH
                        let datetimeError = errdata.created_at;
                        let payloadError = errdata.decode_payload;
                        sendJwt(datetimeError, server_url, payloadError, secretapi)
                        // let command = exec('gammu --sendsms TEXT 082113222883 -text "' + text + '"');
                        // command.stdout.on('data', function (data) {
                        //     console.log('' + data);
                        // });
                        const queryDel = `DELETE FROM fail_api_logs where id = ` + errdata.id;
                        var Delete = await pg.getQuery(queryDel);
                    }
                }



               

                // ----- Define data Goiot
                let dataGoiot = [{
                    "tag": (goiotSetting[0].ph_tag == null) ? "tagPh" : goiotSetting[0].ph_tag,
                    "value": String(deviceRes[iterator].ph),
                    "time": dateTime
                }, {
                    "tag": (goiotSetting[0].ph_tag == null) ? "tagTss" : goiotSetting[0].tss_tag,
                    "value": String(deviceRes[iterator].tss),
                    "time": dateTime
                },
                {
                    "tag": (goiotSetting[0].ph_tag == null) ? "tagAmonia" : goiotSetting[0].amonia_tag,
                    "value": String(deviceRes[iterator].amonia),
                    "time": dateTime
                }, {
                    "tag": (goiotSetting[0].ph_tag == null) ? "tagCod" : goiotSetting[0].cod_tag,
                    "value": String(deviceRes[iterator].cod),
                    "time": dateTime
                }, {
                    "tag": (goiotSetting[0].ph_tag == null) ? "tagFlowmeter" : goiotSetting[0].flowmeter_tag,
                    "value": String(deviceRes[iterator].flow_meter),
                    "time": dateTime
                }
                ];
                dataLogs['goiot'] = dataGoiot
                
                // ----- DEFINE KLHK
                payloadSchedule = payload
                klhkTstamp = dateTime
                // if (counter % send_api_interval === 0) {
                //     // ----- KIRIM SMS
                //     // let command = exec('gammu --sendsms TEXT 082113222883 -text "' + text + '"');
                //     // command.stdout.on('data', function (data) {
                //     //     console.log('' + data);
                //     // });
                //     // console.log(text);
                //     sendJwt(dateTime, server_url, payload, secretapi)
                // }
            } else {
                // ----- Simpan Fail Api Logs
                if (counter % send_api_interval === 0) {
                    let dataFailApi = {};
                    dataFailApi['created_at'] = dateTime;
                    dataFailApi['encode_payload'] = encode_payload;
                    dataFailApi['decode_payload'] = payload;


                    query.insert('fail_api_logs', dataFailApi, function (res) {
                        console.log('--->[\x1b[36mPGSQL\x1b[0m] ' + res + ' (KLHK FAIL API LOGS :' + dateTime + ')');
                    });
                    console.log('--->[\x1b[31mKLHK\x1b[0m] ' + "Koneksi  Mati : API TIDAK DIKIRIM !");
                }


                // --- Insert Connection Log Error
                // let dataConnection = {};
                // let dt = datetime.create();
                // let dateTime = dt.format('Y-m-d H:M:S');
                // dataConnection['msg'] = 'INTERNET DISCONNECT';
                // dataConnection['tstamp'] = dateTime;
                // await query.insert('connection_logs', dataConnection, function (res) {
                //     console.log(res + ' (INSERT CONNECTION LOG ERROR :' + dateTime + ')');
                //     process.exit();
                // });

            }


            // ----- SEND REALTIME
            // --- Realtime Websocket
            
            sendSocket(deviceRes[iterator], hostWebsocket);
            // -----  KIRIM WEBSOCKET
            deviceRes[iterator]['controller'] = iterator
            if (logging) {
                sendGatewayStatus({
                    'status': 'device-connect'
                }, hostWebsocket);
                sendGatewayStatus({
                    'status': 'socket-connect'
                }, hostWebsocket);
            }



            // -----  ALARM
            function checkFormula(pv, formula, sp) {
                switch (formula) {
                    case '==':
                        return (pv == sp) ? true : false;
                        break;
                    case '>':
                        return (pv > sp) ? true : false;
                        break;
                    case '>=':
                        return (pv >= sp) ? true : false;
                        break;
                    case '<':
                        return (pv < sp) ? true : false;
                        break;

                    case '<=':
                        return (pv <= sp) ? true : false;
                        break;

                    default:
                        return false;
                        break;
                }
            }
            const queryGetAlarmSetting = `SELECT * FROM alarm_settings AS als `;
            var alarmSettings = await pg.getQuery(queryGetAlarmSetting);
            for (const key in alarmSettings) {
                let alarmSetting = alarmSettings[key];
                let dataAlarm = {};
                
                if ('ph' === alarmSetting['sensor']) {
                    if (checkFormula(deviceRes[iterator].ph, alarmSetting['formula'], alarmSetting['sp'])) {
                        if (alarmSetting['status'] != 1) {
                            let update = `UPDATE alarm_settings SET status=1 where id = ` + alarmSetting['id'];
                            await pg.getQuery(update);
                            dataAlarm['tstamp'] = dateTime;
                            dataAlarm['text'] = alarmSetting['text'];
                            dataAlarm['set_point'] = alarmSetting['sp'];
                            dataAlarm['actual'] = deviceRes[iterator].ph;
                            // KIRIM NOTIF ALARM
                            sendAlarm(dataAlarm, hostWebsocket);
                            query.insert('alarms', dataAlarm, function (res) {
                                console.log(res + ' (' + alarmSetting['text'] + ')');
                            });
                        }
                    } else {
                        let updateNormal = `UPDATE alarm_settings SET status=0 where id = ` + alarmSetting['id'];
                        await pg.getQuery(updateNormal);
                    }
                }

                if ('tss' === alarmSetting['sensor']) {
                    if (checkFormula(deviceRes[iterator].tss, alarmSetting['formula'], alarmSetting['sp'])) {
                        if (alarmSetting['status'] != 1) {
                            let update = `UPDATE alarm_settings SET status=1 where id = ` + alarmSetting['id'];
                            await pg.getQuery(update);
                            dataAlarm['tstamp'] = dateTime;
                            dataAlarm['text'] = alarmSetting['text'];
                            dataAlarm['set_point'] = alarmSetting['sp'];
                            dataAlarm['actual'] = deviceRes[iterator].tss;
                            // KIRIM NOTIF ALARM
                            sendAlarm(dataAlarm, hostWebsocket);

                            // SIMPAN ALARM KE DATABASE
                            query.insert('alarms', dataAlarm, function (res) {
                                console.log(res + ' (' + alarmSetting['text'] + ')');
                            });
                        }
                    } else {
                        let updateNormal = `UPDATE alarm_settings SET status=0 where id = ` + alarmSetting['id'];
                        await pg.getQuery(updateNormal);
                    }
                }

                if ('amonia' === alarmSetting['sensor']) {
                    if (checkFormula(deviceRes[iterator].amonia, alarmSetting['formula'], alarmSetting['sp'])) {
                        if (alarmSetting['status'] != 1) {
                            let update = `UPDATE alarm_settings SET status=1 where id = ` + alarmSetting['id'];
                            await pg.getQuery(update);
                            dataAlarm['tstamp'] = dateTime;
                            dataAlarm['text'] = alarmSetting['text'];
                            dataAlarm['set_point'] = alarmSetting['sp'];
                            dataAlarm['actual'] = deviceRes[iterator].amonia;
                            // KIRIM NOTIF ALARM
                            sendAlarm(dataAlarm, hostWebsocket);

                            // SIMPAN ALARM KE DATABASE
                            query.insert('alarms', dataAlarm, function (res) {
                                console.log(res + ' (' + alarmSetting['text'] + ')');
                            });
                        }
                    } else {
                        let updateNormal = `UPDATE alarm_settings SET status=0 where id = ` + alarmSetting['id'];
                        await pg.getQuery(updateNormal);
                    }
                }

                if ('cod' === alarmSetting['sensor']) {
                    if (checkFormula(deviceRes[iterator].cod, alarmSetting['formula'], alarmSetting['sp'])) {
                        if (alarmSetting['status'] != 1) {
                            let update = `UPDATE alarm_settings SET status=1 where id = ` + alarmSetting['id'];
                            await pg.getQuery(update);
                            dataAlarm['tstamp'] = dateTime;
                            dataAlarm['text'] = alarmSetting['text'];
                            dataAlarm['set_point'] = alarmSetting['sp'];
                            dataAlarm['actual'] = deviceRes[iterator].cod;
                            // KIRIM NOTIF ALARM
                            sendAlarm(dataAlarm, hostWebsocket);

                            // SIMPAN ALARM KE DATABASE
                            query.insert('alarms', dataAlarm, function (res) {
                                console.log(res + ' (' + alarmSetting['text'] + ')');
                            });
                        }
                    } else {
                        let updateNormal = `UPDATE alarm_settings SET status=0 where id = ` + alarmSetting['id'];
                        await pg.getQuery(updateNormal);
                    }
                }

                if ('flow_meter' === alarmSetting['sensor']) {
                    if (checkFormula(deviceRes[iterator].flow_meter, alarmSetting['formula'], alarmSetting['sp'])) {
                        if (alarmSetting['status'] != 1) {
                            let update = `UPDATE alarm_settings SET status=1 where id = ` + alarmSetting['id'];
                            await pg.getQuery(update);
                            dataAlarm['tstamp'] = dateTime;
                            dataAlarm['text'] = alarmSetting['text'];
                            dataAlarm['set_point'] = alarmSetting['sp'];
                            dataAlarm['actual'] = deviceRes[iterator].flow_meter;
                            // KIRIM NOTIF ALARM
                            sendAlarm(dataAlarm, hostWebsocket);

                            // SIMPAN ALARM KE DATABASE
                            query.insert('alarms', dataAlarm, function (res) {
                                console.log(res + ' (' + alarmSetting['text'] + ')');
                            });
                        }
                    } else {
                        let updateNormal = `UPDATE alarm_settings SET status=0 where id = ` + alarmSetting['id'];
                        await pg.getQuery(updateNormal);
                    }
                }

            }
            
            dataLogs['real'] = dataInsert;
            

            // -- merubah nilai berdasarkan nilai maintenance
            let dataMaintenanceValue={};
            Object.assign(dataMaintenanceValue, dataInsert);
            if (maintenanceValue.length) {
                for (const key in maintenanceValue) {
                    if (maintenanceValue.hasOwnProperty(key)) {
                        var elM = maintenanceValue[key];
                        dataMaintenanceValue[elM.sensor] = elM.value;
                    }
                }
            }
            dataLogs['maintenance'] = dataMaintenanceValue;


            // ------  INSERT KE DATABASE

            console.log('\x1b[5m=========================================================================================================================\x1b[0m')
            console.log('\n')
        }

        async function Pooling() {
            getData();
            // -- CLEAR SCREEN
            // clear();
        }

        il[iterator].add(Pooling);
        il[iterator].setInterval(poolingInterval).run();
    })
    socket[iterator].on('error', async (err) => {
        console.log('--->[\x1b[41mDEVICE\x1b[0m] ' +"Gagal Koneksi " + optns.deviceId + ":" + err.errno)
        sendGatewayStatus({
            'status': 'device-disconnect'
        }, hostWebsocket);

        // --- Insert Connection Log Error
        let dataConnection = {};
        let dt = datetime.create();
        let dateTime = dt.format('Y-m-d H:M:S');
        dataConnection['msg'] = 'ECONNREFUSED';
        dataConnection['tstamp'] = dateTime;
        await query.insert('connection_logs', dataConnection, function (res) {
            console.log('--->[\x1b[36mPGSQL\x1b[0m] ' +res + ' (INSERT CONNECTION LOG ERROR :' + dateTime + ')');
            process.exit();
        });
    });
    socket[iterator].connect(options[iterator])



}


// ----- READ CONTROLLER
var controller = require('./coreController');
controller.getController((c) => {
    for (var i in c) {
        ModbusRead(i, c[i].options, c[i].tags);
    }
});


// ----- SOCKET IO
const socket = require('socket.io-client')('http://localhost:1010', {
    query: "from=Gateway"
});
socket.on('connect', function () {
    // console.log('Socket connected...');
});



// ----- RESTFULL TESTING
require('./coreApi');
