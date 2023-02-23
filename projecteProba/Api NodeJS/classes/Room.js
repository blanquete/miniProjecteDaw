const Sequelize = require('sequelize')
const db = require('../connection')
const Group = require('./Group')

const Room = db.define("room", {
    idroom: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    name: {
        type: Sequelize.STRING,
    }
}, {tableName: 'room'})


/** Relation Room-Group **/
Room.belongsTo(Group, {
    foreignKey: "group_idgroup"
})

Group.hasMany(Room, {
    foreignKey: "group_idgroup"
})

module.exports = Room