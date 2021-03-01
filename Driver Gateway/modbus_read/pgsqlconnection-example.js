const {
    Client
} = require('pg')

// const client = new Client({
//     host: 'iotjpa.com',
//     user: 'postgres',
//     database: 'jpa_eh',
//     password: 'Together1!',
//     port: 5432,
// })asds sdasds asdasdsads
// })


const client = new Client({
    host: 'localhost',
    user: 'postgres',
    database: 'jpa_eh',
    password: 'root',
    port: 5432,
})

client.connect(function (err) {
    if (err) {
        // console.log(err)
        console.log('--->[\x1b[46mPGSQL\x1b[0m] ' + 'Postgre Error to connect !')

        process.exit(1);
    } else {
        console.log('--->[\x1b[46mPGSQL\x1b[0m] ' + 'Postgre Connected !')
    };
})

module.exports.client = client;
