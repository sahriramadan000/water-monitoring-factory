let mqtt = require('mqtt');
let { Pool } = require('pg');
let moment = require('moment');
const io = require('socket.io-client');
const socket = io('http://localhost:2222');
const schedule = require('node-schedule');

// PostgreSQL connection setup
const pool = new Pool({
    user: 'postgres',
    host: 'localhost',
    database: 'water-monitoring-factory',
    password: 'root',
    port: 5432,
});

// Store data and last save times for each topic
let topicData = {};

// Function to save data to the database
function saveToDatabase(siteCode, factoryCode, data) {
    const query = `
        INSERT INTO sensor_histories (site_code, factory_code, ph, flow, total_debit, total_credit, created_at, updated_at)
        VALUES ($1, $2, $3, $4, $5, $6, NOW(), NOW())
    `;

    const values = [
        siteCode,
        factoryCode,
        data.ph ?? -1,
        data.flow ?? -1,
        data.total_debit ?? -1,
        data.total_credit ?? -1
    ];

    pool.query(query, values, (err, res) => {
        if (err) {
            console.error('Error saving to database:', err);
            return;
        }
        console.log(`Data saved successfully for site ${siteCode}:`, data);
    });
}

// Function to check and save data every minute
function checkAndSaveData() {
    console.log('Current topicData:', topicData);

    for (const [topic, message] of Object.entries(topicData)) {
        const { site_code, factory_code, data } = message;

        if (site_code && factory_code && data) {
            saveToDatabase(site_code, factory_code, data);
        } else {
            console.error(`Missing data for topic: ${topic}`);
        }
    }
}

// Schedule a job to run every minute
schedule.scheduleJob('* * * * *', () => {
    console.log('Running scheduled job to save data...');
    checkAndSaveData();
});

function startSubscriber() {
    let client = mqtt.connect('mqtt://localhost:1884');

    client.on('message', (topic, message) => {
        message = message.toString();
        console.log('===> Message from Client (Message)', topic, message);
        console.log('===================================================');

        try {
            let jsonData = JSON.parse(message);

            // Update topicData
            if (jsonData.site_code) {
                topicData[topic] = jsonData;

                // Emit the data via Socket.io
                socket.emit('realtimeMonitor', jsonData);
            }

        } catch (error) {
            console.error('Error parsing JSON:', error);
        }
    });

    client.on('connect', () => {
        pool.query(`
            SELECT sites.topic, sites.site_code, factories.factory_code
            FROM sites
            INNER JOIN factories ON sites.factory_id = factories.id
            WHERE sites.topic IS NOT NULL AND sites.topic != ''
              AND sites.status = TRUE AND factories.status = TRUE
        `, (err, res) => {
            if (err) {
                console.error('Error fetching topics from database:', err);
                return;
            }

            res.rows.forEach(row => {
                client.subscribe(row.topic);
                console.log('Subscribed to topic:', row.topic);
                // Initialize topicData
                topicData[row.topic] = { site_code: row.site_code, factory_code: row.factory_code, data: {} };
            });
        });

        console.log('Connected to MQTT broker');
    });
}

module.exports = { startSubscriber };
