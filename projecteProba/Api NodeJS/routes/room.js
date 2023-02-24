const express = require('express');
const _ = require('lodash');
const Room = require('../classes/Room');
const User = require('../classes/User');
const router = express();

// GET ALL ROOMS BY USER (TEACHER)
router.get("/user/:iduser", (req, res) => {
    Room.findAll({
        where: {
            user_iduser: req.params.iduser
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

// GET ALL ROOMS BY GROUP (STUDENT)
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

module.exports = router;