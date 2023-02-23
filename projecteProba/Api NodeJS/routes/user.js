const express = require('express');
const _ = require('lodash');
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
router.get('/:iduser', (req, res) => {
    User.findOne(_.merge(
        {
            where: {
                iduser: req.params.iduser
            }
        },
        genericUserBody
    ))
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

/** CREATE USER **/
router.post('/', (req, res) => {
    User.create({
        name: req.body.name,
        email: req.body.email,
        role_idrole: req.body.role_idrole,
        group_idgroup: req.body.group_idgroup
    })
    .then(user => res.json(user))
    .catch(error => res.send(error).status(500))
})

module.exports = router;