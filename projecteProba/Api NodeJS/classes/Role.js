const Sequelize = require('sequelize')
const db = require('../connection')

const Role = db.define('role', {
    idrole: {
        type: Sequelize.STRING,
        primaryKey: true,
        autoIncrement: true
    },
    name: {
        type: Sequelize.STRING
    }
}, {tableName: 'role'})

module.exports = Role