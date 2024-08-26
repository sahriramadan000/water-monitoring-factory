// MQTT PUBLISH

let mqtt = require('mqtt')
// let client = mqtt.connect('mqtt://91.121.93.94:1883')
let client = mqtt.connect('mqtt://localhost:1884')

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
            factory_code: 2334234,
            site_code: 'SS1',
            data: {
                ph: getRandomFloat(6.5, 8.5),
                flow: getRandomInt(50, 200),
                total_debit: getRandomInt(1000, 5000),
                total_credit: getRandomInt(15000, 25000),
            }
        };
        let message2 = {
            factory_code: 2334234,
            site_code: 'SS2',
            data: {
                ph: getRandomFloat(6.5, 8.5),
                flow: getRandomInt(50, 200),
                total_debit: getRandomInt(1000, 5000),
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
