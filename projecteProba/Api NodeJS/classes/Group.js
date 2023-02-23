const Sequelize = require('sequelize')
const db = require('../connection')

const Group = db.define('group', {
    idgroup: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    name: {
        type: Sequelize.STRING
    }
}, {tableName: "group"})

module.exports = Group