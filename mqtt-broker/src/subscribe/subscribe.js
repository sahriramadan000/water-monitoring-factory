let mqtt = require('mqtt');
let { Pool } = require('pg');
let moment = require('moment-timezone');
const io = require('socket.io-client');
const socket = io(process.env.SOCKET_URL);
const schedule = require('node-schedule');

// PostgreSQL connection setup
const pool = new Pool({
    host: process.env.DB_HOST,
    port: process.env.DB_PORT,
    database: process.env.DB_DATABASE,
    user: process.env.DB_USERNAME,
    password: process.env.DB_PASSWORD,
});

// Store data and last save times for each site
let topicData = {};

// Function to save data to the database
function saveToDatabase(siteCode, factoryCode, data) {
    const jakartaTime = moment().tz('Asia/Jakarta').format('YYYY-MM-DD HH:mm:ss');

    const query = `
        INSERT INTO sensor_histories (site_code, factory_code, ph, flow, total_debit, total_credit, created_at, updated_at)
        VALUES ($1, $2, $3, $4, $5, $6, $7, $7)
    `;

    const values = [
        siteCode,
        factoryCode,
        data.ph ?? -1,
        data.flow ?? -1,
        data.total_debit ?? -1,
        data.total_credit ?? -1,
        jakartaTime,
    ];

    pool.query(query, values, (err, res) => {
        if (err) {
            console.error('Error saving to database:', err);
            return;
        }
        console.log(`Data saved successfully for site ${siteCode}:`, data);

        // Mark the data as saved
        if (topicData[siteCode]) {
            topicData[siteCode].dataChanged = false;
        }
    });
}

// Function to check and save data every minute
function checkAndSaveData() {
    console.log('Current topicData:', topicData);

    for (const [siteCode, message] of Object.entries(topicData)) {
        const { site_code, factory_code, data, dataChanged } = message;

        if (site_code && factory_code && dataChanged) {
            saveToDatabase(site_code, factory_code, data);
        } else {
            console.error(`No new data for site: ${siteCode}`);
        }
    }
}

// Schedule a job to run every minute
schedule.scheduleJob('* * * * *', () => {
    console.log('Running scheduled job to save data...');
    checkAndSaveData();
});

function startSubscriber() {
    let client = mqtt.connect(process.env.MQTT_BROKER);

    client.on('message', (topic, message) => {
        message = message.toString();
        console.log('===> Message from Client (Message)', topic, message);
        console.log('===================================================');

        try {
            let jsonData = JSON.parse(message);

            // Ensure topicData[site_code] exists before updating
            if (jsonData.site_code) {
                if (!topicData[jsonData.site_code]) {
                    topicData[jsonData.site_code] = {
                        site_code: jsonData.site_code,
                        factory_code: jsonData.factory_code,
                        data: jsonData,  // Store the data immediately
                        dataChanged: true, // Mark new data as changed
                    };
                } else {
                    // Update existing data and mark as changed
                    topicData[jsonData.site_code].data = jsonData;
                    topicData[jsonData.site_code].dataChanged = true;
                }

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

                // Initialize topicData with default values
                topicData[row.site_code] = {
                    site_code: row.site_code,
                    factory_code: row.factory_code,
                    data: {},
                    dataChanged: false, // Initially mark data as not changed
                };
            });
        });

        console.log('Connected to MQTT broker');
    });
}

module.exports = { startSubscriber };
