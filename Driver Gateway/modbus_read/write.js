'use strict'
// HEHEHEasds

const Modbus = require('jsmodbus')
const net = require('net')
var sendTelegram = require('./sendTelegram.js')

const socket = new net.Socket()
const options = {
    'host': '127.0.0.1',
    'port': '502',
    'logEnabled': true,
    'logLevel': 'debug'
}

var InfiniteLoop = require('infinite-loop');
var il = new InfiniteLoop();
const client = new Modbus.client.TCP(socket)
function genRand(min, max, decimalPlaces) {
    var rand = Math.random() * (max - min) + min;
    var power = Math.pow(10, decimalPlaces);
    return Math.floor(rand * power) / power;
}

var address = {
    'ph': '0002',
    'tss': '0004',
    'amonia': '0006',
    'cod': '0008',
    'flow_meter': '0010'
};


socket.on('connect', function () {
    function addOne() {
        var precision = 100; // 2 decimals
        var ph = Math.floor(Math.random() * (14 * precision - 1 * precision) + 1 * precision) / (1 * precision)
        // now you can call any function normally, just sending a buffer instead of an
        // array

        console.log(ph);

          for (var key in address) {
              let randomvalue;
              if (key === 'ph') {
                   randomvalue = genRand(5, 14, 2);
                }else if(key ==='tss'){
                   randomvalue = genRand(60, 200, 2);
                } else if (key === 'amonia') {
                     randomvalue = genRand(200, 500, 2);
                } else if (key === 'cod') {
                     randomvalue = genRand(3, 10,4);
                }else{
                     randomvalue = genRand(50000, 200000,4);
                }
              var buf = Buffer.allocUnsafe(4); // 4 bytes == 32bit
              buf.writeFloatBE(randomvalue);
              client.writeMultipleRegisters(address[key],buf ).then(function (resp) {
                  // resp will look like { fc : 16, startAddress: 4, quantity: 4 }
                  console.log(randomvalue);
                  // console.log(resp);
              }, function () {
                  sendTelegram("WWT (WRITE VALUE ERROR)")
              });
          }
        
    }

    il.add(addOne);
    il.setInterval(1000).run();
})



socket.on('error', console.error)
socket.connect(options)

