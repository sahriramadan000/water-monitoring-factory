const express = require('express')
const app = express()
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
require('dotenv').config();
const port = process.env.PORT_EXPRESS || 2222;
var server = require("http").Server(app);
var io = require("socket.io")(server);

// Import File
const { startBroker } = require('./src/broker/broker');
const { startSubscriber } = require('./src/subscribe/subscribe');

app.all('*', function(req, res, next) {
    let origin = req.headers.origin;
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});

// Route Trial
app.get('/', (req, res) => {
    res.send('Hello, Express!');
});

// Mulai broker
startBroker();

// Mulai subscriber
startSubscriber();

// SOCKET
io.on("connection", function (socket) {
    let from = socket.handshake.query['from'];
    console.log('Client Connected : '+socket.id);

    socket.on('realtimeMonitor', function(msg){
        // console.log('SOCKET==> ',msg);

        io.to("all").emit('realtimeMonitor', msg);
    });

    socket.on('disconnect', () => {
        console.log('Client Disconnected : '+socket.id);
     });
    socket.join("all");
});

server.listen(port, '0.0.0.0', function () {
    console.log('listening on *:' + port);
});
