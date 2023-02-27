const Question = require('../classes/Question');
const Group = require('../classes/Group');
const Role = require('../classes/Role');
const Room = require('../classes/Room');
const User = require('../classes/User');
const express = require('express');
const router = express();

const genericQuestionBody = {
    include: [
        {
            model: User,
            include: {
                model: Role,
                attributes: {
                    exclude: ["createdAt", "updatedAt"]
                }
            },
            attributes: {
                exclude: ["role_idrole", "group_idgroup", "createdAt", "updatedAt"]
            }
        },
        {
            model: Room,
            include: {
                model: Group,
                attributes: {
                    exclude: ["createdAt", "updatedAt"]
                }
            },
            attributes: {
                exclude: ["group_idgroup", "createdAt", "updatedAt"]
            }
        }
    ],
    attributes: {
        exclude:  ["room_idroom", "user_iduser", "createdAt", "updatedAt"]
    }
}

/** GET ALL QUESTIONS **/
router.get('/', (req, res) => {
    Question.findAll({
        where: req.query.iduser ? { solved: false } : {},
        include: [
            {
                model: User,
                where: req.query.iduser ? {iduser: req.query.iduser} : {},
                include: {
                    model: Role,
                    attributes: {
                        exclude: ["createdAt", "updatedAt"]
                    }
                },
                attributes: {
                    exclude: ["role_idrole", "group_idgroup", "createdAt", "updatedAt"]
                }
            },
            {
                model: Room,
                where: req.query.idroom ? {idroom: req.query.idroom} : {},
                include: {
                    model: Group,
                    attributes: {
                        exclude: ["createdAt", "updatedAt"]
                    }
                },
                attributes: {
                    exclude: ["group_idgroup", "createdAt", "updatedAt"]
                }
            }
        ],
        attributes: {
            exclude:  ["room_idroom", "user_iduser", "createdAt", "updatedAt"]
        }
    })
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

/** SOLVE OR UNSOLVE A QUESTION **/
router.get('/:idquestion/solved', (req, res) => {
    var value =  req.query.value == 'true' 
        ? true 
        : req.query.value.toLowerCase() == 'false'
            ? false
            : null

    Question.findOne({
        ...genericQuestionBody,
        where: {
            idquestion: req.params.idquestion
        }
    })
    .then(question => {
        return question.update({solved: value || !question.solved})
    })
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

/** DELETE QUESTION BY ID **/
router.get('/delete/:idquestion', (req, res) => {
    Question.delete({
        where: {
            idquestion: req.params.idquestion
        }
    })
    .then(() => res.sendStatus(200))
    .catch(error => res.send(error).status(500))
})

/** CREATE QUESTION **/
router.get('/create/:title/:description/:iduser/:idroom', (req, res) => {
    Question.create({
        title: req.params.title,
        description: req.params.description,
        user_iduser: req.params.iduser,
        room_idroom: req.params.idroom
    })
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

module.exports = router;