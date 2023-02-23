const Sequelize = require('sequelize')
const db = require('../connection')
const Room = require('./Room')
const User = require('./User')

const Question = db.define("question", {
    idquestion: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    title: {
        type: Sequelize.STRING
    },
    description: {
        type: Sequelize.STRING
    },
    solved: {
        type: Sequelize.BOOLEAN
    }
}, {tableName: 'question'})


/** Relation User-Question **/
Question.belongsTo(User, {
    foreignKey: "user_iduser",
})

User.hasMany(Question, {
    foreignKey: "user_iduser"
})

/** Relation Question-Room **/
Question.belongsTo(Room, {
    foreignKey: "room_idroom"
})

Room.hasMany(Question, {
    foreignKey: "room_idroom"
})

module.exports = Question