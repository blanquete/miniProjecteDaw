const express = require('express');
const Group = require('../classes/Group');
const Role = require('../classes/Role');
const User = require('../classes/User');
const router = express();

const genericUserBody = {
    include: [
        {
            model: Role,
            attributes: {
                exclude: ["createdAt", "updatedAt"]
            }
        },
        {
            model: Group,
            attributes: {
                exclude: ["createdAt", "updatedAt"]
            }
        }
    ],
    attributes: {
        exclude: ["role_idrole", "group_idgroup", "createdAt", "updatedAt"]
    }
}

/** GET ALL USERS **/
router.get('/', (req, res) => {
    User.findAll(genericUserBody)
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

/** GET USER BY ID */
router.get('/iduser/:iduser', (req, res) => {
    User.findOne({
        ...genericUserBody,
        where: {
            iduser: req.params.iduser
        }
    })
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

/** GET USER BY ID */
router.get('/email/:email', (req, res) => {
    User.findOne({
        ...genericUserBody,
        where: {
            email: req.params.email
        }
    })
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

/** CREATE USER **/
router.get('/create/:name/:email/:idrole/:idgroup', (req, res) => {
    User.create({
        name: req.params.name,
        email: req.params.email,
        role_idrole: req.params.idrole,
        group_idgroup: req.params.idgroup
    })
    .then(user => res.json(user))
    .catch(error => res.send(error).status(500))
})

module.exports = router;