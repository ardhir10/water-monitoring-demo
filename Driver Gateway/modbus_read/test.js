// var axios = require('axios');
// var data = JSON.stringify({ "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwaCI6Ny41LCJ0c3MiOjAsImFtb25pYSI6MCwiZmxvd19tZXRlciI6MCwidWlkIjoiMjAwMDAwOTgyIiwiZGF0ZXRpbWUiOjE2MDMyNzQ5NDB9.kHtrAo-KC6CXOH5gCMj269qXFHp8J4P05TUEVATrICE" });

// var config = {
//     method: 'post',
//     url: 'http://203.166.207.50/api/server-uji',
//     headers: {
//         'Content-Type': 'application/json'
//     },
//     data: data
// };

// axios(config)
//     .then(function (response) {
//         console.log(JSON.stringify(response.data));
//     })
//     .catch(function (error) {
//         console.log(error);
//     });


const sendTelegram = require('./sendTelegram.js')
sendTelegram();