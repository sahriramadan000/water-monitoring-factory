// MQTT PUBLISH

let mqtt = require('mqtt')
let client = mqtt.connect('mqtt://91.121.93.94:1883')
// let client = mqtt.connect('mqtt://localhost:1884')

let topik = 'logger/site_1';
let topik2 = 'logger/site_2';

function getRandomFloat(min, max) {
    return (Math.random() * (max - min) + min).toFixed(2);
}

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}


client.on('connect', () => {
    setInterval(()=> {
        let message = {
            factory_code: 'SPP01',
            site_code: 'SS1',
            data: {
                ph: getRandomFloat(7, 7.4),
                flow: getRandomInt(4.2, 5.1),
                total_debit: getRandomInt(0.010, 0.200),
                total_credit: getRandomInt(15000, 25000),
            }
        };
        let message2 = {
            factory_code: 'SPP01',
            site_code: 'SS2',
            data: {
                ph: getRandomFloat(7, 7.4),
                flow: getRandomInt(4.2, 5.1),
                total_debit: getRandomInt(0.010, 0.200),
                total_credit: getRandomInt(15000, 25000),
            }
        };

        let jsonMessage = JSON.stringify(message);
        let jsonMessage2 = JSON.stringify(message2);
        client.publish(topik, jsonMessage);
        client.publish(topik2, jsonMessage2);

        console.log("Pesan Published! ", message);
    } ,3000)

})
