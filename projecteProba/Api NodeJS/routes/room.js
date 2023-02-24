const express = require('express');
const _ = require('lodash');
const router = express();

// GET ALL ROOMS BY USER
router.get("/:iduser", (req, res) => {
    Room.findAll({
        where: {
            user_iduser: req.params.iduser
        }
    })
})

module.exports = router;