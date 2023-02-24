const express = require('express');
const Group = require('../classes/Group');
const router = express();

/** GET ALL USERS **/
router.get('/', (req, res) => {
    Group.findAll({ attributes: { exclude: ["createdAt", "updatedAt"] } })
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

module.exports = router;