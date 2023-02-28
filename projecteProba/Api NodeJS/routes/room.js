const express = require('express');
const Room = require('../classes/Room');
const Group = require('../classes/Group');
const User = require('../classes/User');
const router = express();

/** GET ALL ROOMS BY USER (TEACHER) **/
router.get("/user/:iduser", (req, res) => {
    Room.findAll({
        where: {
            user_iduser: req.params.iduser
        },
        include: [
            {
                model: User,
                attributes: ["iduser", "name"]
            },
            {
                model: Group,
                attributes: ["idgroup", "name"]
            }
        ],
        attributes: ["idroom", "name"]
    })
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

/** GET ALL ROOMS BY GROUP (STUDENT) **/
router.get("/group/:idgroup", (req, res) => {
    Room.findAll({
        where: {
            group_idgroup: req.params.idgroup
        },
        include: {
            model: User,
            attributes: ["iduser", "name"]
        },
        attributes: ["idroom", "name"]
    })
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

router.get("/create/:name/:iduser/:idgroup", (req, res) => {
    Room.create({
        name: req.params.name,
        user_iduser: req.params.iduser,
        group_idgroup: req.params.idgroup
    })
    .then(result => res.sendStatus(200))
    .catch(error => res.send(error).status(500))
})

module.exports = router;