// MQTT PUBLISH

let mqtt = require('mqtt')
let client = mqtt.connect('mqtt://91.121.93.94:1883')
// let client = mqtt.connect('mqtt://localhost:1884')

let topik = 'logger/site_1';
let topik2 = 'logger/site_2';
let topik3 = 'logger/site_3';
let topik4 = 'logger/site_4';
let topik5 = 'logger/site_5';
let topik6 = 'logger/site_6';
let topik7 = 'logger/site_7';
let topik8 = 'logger/site_8';

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
        let message3 = {
            factory_code: 'SPP01',
            site_code: 'SS3',
            data: {
                ph: getRandomFloat(7, 7.4),
                flow: getRandomInt(4.2, 5.1),
                total_debit: getRandomInt(0.010, 0.200),
                total_credit: getRandomInt(15000, 25000),
            }
        };
        let message4 = {
            factory_code: 'SPP01',
            site_code: 'SS4',
            data: {
                ph: getRandomFloat(7, 7.4),
                flow: getRandomInt(4.2, 5.1),
                total_debit: getRandomInt(0.010, 0.200),
                total_credit: getRandomInt(15000, 25000),
            }
        };
        let message5 = {
            factory_code: 'SPP01',
            site_code: 'SS5',
            data: {
                ph: getRandomFloat(7, 7.4),
                flow: getRandomInt(4.2, 5.1),
                total_debit: getRandomInt(0.010, 0.200),
                total_credit: getRandomInt(15000, 25000),
            }
        };
        let message6 = {
            factory_code: 'SPP01',
            site_code: 'SS6',
            data: {
                ph: getRandomFloat(7, 7.4),
                flow: getRandomInt(4.2, 5.1),
                total_debit: getRandomInt(0.010, 0.200),
                total_credit: getRandomInt(15000, 25000),
            }
        };
        let message7 = {
            factory_code: 'SPP01',
            site_code: 'SS7',
            data: {
                ph: getRandomFloat(7, 7.4),
                flow: getRandomInt(4.2, 5.1),
                total_debit: getRandomInt(0.010, 0.200),
                total_credit: getRandomInt(15000, 25000),
            }
        };
        let message8 = {
            factory_code: 'SPP01',
            site_code: 'SS8',
            data: {
                ph: getRandomFloat(7, 7.4),
                flow: getRandomInt(4.2, 5.1),
                total_debit: getRandomInt(0.010, 0.200),
                total_credit: getRandomInt(15000, 25000),
            }
        };

        let jsonMessage = JSON.stringify(message);
        let jsonMessage2 = JSON.stringify(message2);
        let jsonMessage3 = JSON.stringify(message3);
        let jsonMessage4 = JSON.stringify(message4);
        let jsonMessage5 = JSON.stringify(message5);
        let jsonMessage6 = JSON.stringify(message6);
        let jsonMessage7 = JSON.stringify(message7);
        let jsonMessage8 = JSON.stringify(message8);
        client.publish(topik, jsonMessage);
        client.publish(topik2, jsonMessage2);
        client.publish(topik3, jsonMessage3);
        client.publish(topik4, jsonMessage4);
        client.publish(topik5, jsonMessage5);
        client.publish(topik6, jsonMessage6);
        client.publish(topik7, jsonMessage7);
        client.publish(topik8, jsonMessage8);

        console.log("Pesan Published! ", message);
    } ,3000)

})
