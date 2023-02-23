var express = require('express');

var app = express();

var indexController = require('./index');
var questionController = require('./routes/question')
var userController = require('./routes/user')

app.use('/', indexController);
app.use('/questions', questionController);
app.use('/users/', userController)

module.exports = app;