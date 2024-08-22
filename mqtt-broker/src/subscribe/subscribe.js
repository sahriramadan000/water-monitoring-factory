// subscribe.js
let mqtt = require('mqtt')
const io = require('socket.io-client');
const socket = io('http://localhost:2222');

let staticData = {
    factory_code: null,
    site_code: null,
    data: {
        ph: 0,
        flow: 0,
        total_debit: 0,
        total_credit: 0,
    }
};

function startSubscriber() {
    let client = mqtt.connect('mqtt://localhost:1884')

    client.on('message', (topic, message) => {
        message = message.toString();
        console.log('===> Message from Client (Message)', topic, message);
        console.log('===================================================');

        try {
            // Parse the incoming message as JSON
            let jsonData = JSON.parse(message);

            // Update static JSON based on the topic
            switch (topic) {
                case 'site_1':
                    Object.assign(staticData, jsonData);
                    break;

                case 'site_2':
                    Object.assign(staticData, jsonData);
                    break;

                case 'site_3':
                    Object.assign(staticData, jsonData);
                    break;

                case 'site_4':
                    Object.assign(staticData, jsonData);
                    break;

                default:
                // Handle other topics if necessary
                    break;
            }

            // Log the updated static data
            console.log('Updated Static Data:', staticData);
            socket.emit('realtimeMonitor', staticData);
            console.log('===================================================');
        } catch (error) {
            console.error('Error parsing JSON:', error);
        }
      });

    client.on('connect', () => {
        client.subscribe('site_1')
        client.subscribe('site_2')
        client.subscribe('site_3')
        client.subscribe('site_4')
        console.log('Connect');
    });
}

module.exports = { startSubscriber };
