// MQTT PUBLISH

let mqtt = require('mqtt')
let client = mqtt.connect('mqtt://localhost:1884')

let topik = 'site_1';

function getRandomFloat(min, max) {
    return (Math.random() * (max - min) + min).toFixed(2);
}

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}


client.on('connect', () => {
    setInterval(()=> {
        let message = {
            factory_code: 2334234,
            site_code: 23234,
            data: {
                ph: getRandomFloat(6.5, 8.5),
                flow: getRandomInt(50, 200),
                total_debit: getRandomInt(1000, 5000),
                total_credit: getRandomInt(15000, 25000),
            }
        };

        let jsonMessage = JSON.stringify(message);
        client.publish(topik, jsonMessage);

        console.log("Pesan Published! ", message);
    } ,1000)

})
