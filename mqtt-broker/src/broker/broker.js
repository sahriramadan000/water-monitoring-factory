// broker.js
var mosca = require('mosca');

function startBroker() {
    let setting = {
        port: 1884,
        username: 'test',
        password: '12345678'
    }
    let broker = new mosca.Server(setting)

    broker.on('ready', () => {
        console.log("Broker Ready!");
    })

    broker.on('published', (packet) => {
        message = packet.payload.toString()
        // console.log(message, 'MASUK');
    })
}

module.exports = { startBroker };
