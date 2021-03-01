
var exec = require('child_process').exec;

const sendTelegram = (msg="FROM VPS") => {
    let commandSendTelegram = exec(`telegram-send "${msg}"`);
    commandSendTelegram.stdout.on('data', function (data) {
        console.log('SEND STATUS :' + data);
    });
}

module.exports = sendTelegram;
