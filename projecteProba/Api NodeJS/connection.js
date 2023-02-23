const mysql = require("mysql");
const Sequelize = require('sequelize');

// PRODUCTION BDD
const mysqlConnection = new Sequelize('teacherhelp', 'root', 'th1234', {
    host: '192.168.170.242',
    dialect:  'mysql'
});

mysqlConnection
    .authenticate()
    .then(() => {
        console.log('Connection has been established successfully.');
    })
    .catch(err => {
        console.error('Unable to connect to the database:', err);
    });

module.exports = mysqlConnection;