const Sequelize = require('sequelize')
const db = require('../connection')
const Group = require('./Group')
const Question = require('./Question')
const Role = require('./Role')

const User = db.define('user', {
    iduser: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    name: {
        type: Sequelize.STRING
    },
    email: {
        type: Sequelize.STRING
    }
}, {tableName: 'user'})


/** Relation User-Role **/
User.belongsTo(Role, {
    foreignKey: "role_idrole",
})

Role.hasMany(User, {
    foreignKey: "role_idrole"
})

/** Relation User-Group **/
User.belongsTo(Group, {
    foreignKey: "group_idgroup"
})

Group.hasMany(User, {
    foreignKey: "group_idgroup",
    as: "GroupUsers"
})

module.exports = User