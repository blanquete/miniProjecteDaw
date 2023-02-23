const Question = require('../classes/Question');
const Group = require('../classes/Group');
const Role = require('../classes/Role');
const Room = require('../classes/Room');
const User = require('../classes/User');
const express = require('express');
const _ = require('lodash');
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
    Question.findOne(genericQuestionBody)
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

/** GET A QUESTION BY ID **/
router.get('/:idquestion', (req, res) => {
    Question.findOne(_.merge(
        {
            where: {
                idquestion: req.params.idquestion
            }
        }, 
        genericQuestionBody
    ))
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

/** SOLVE OR UNSOLVE A QUESTION **/
router.put('/:idquestion/solved', (req, res) => {
    console.log(req.query.value.toLowerCase() == 'true')
    var value =  req.query.value.toLowerCase() == 'true' 
        ? true 
        : req.query.value.toLowerCase() == 'false'
            ? false
            : null

    Question.findOne(_.merge(
        {
            where: {
                idquestion: req.params.idquestion
            }
        }, 
        genericQuestionBody
    ))
    .then(question => {
        return question.update({solved: value || !question.solved})
    })
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

/** GET ALL QUESTIONS FROM USER **/
router.get('/user/:iduser', (req, res) => {
    Question.findOne(_.merge(
        {
            where: {
                user_iduser: req.params.iduser
            }
        }, 
        genericQuestionBody
    ))
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

/** GET ALL QUESTIONS FROM ROOM **/
router.get('/room/:idroom', (req, res) => {
    Question.findOne(_.merge(
        {
            where: {
                room_idroom: req.params.idroom
            }
        }, 
        genericQuestionBody
    ))
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

/** DELETE QUESTION BY ID **/
router.delete('/:idquestion', (req, res) => {
    Question.delete({
        where: {
            idquestion: req.params.idquestion
        }
    })
    .then(() => res.sendStatus(200))
    .catch(error => res.send(error).status(500))
})

/** CREATE QUESTION **/
router.post('/', (req, res) => {
    Question.create({
        title: req.body.title,
        description: req.body.description,
        solved: req.body.solved,
        user_iduser: req.body.user_iduser,
        room_idroom: req.body.room_idroom
    })
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

module.exports = router;