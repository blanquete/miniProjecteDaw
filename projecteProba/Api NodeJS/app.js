var createError = require('http-errors');
var express = require('express');
var path = require('path');

var app = express();

var indexController = require('./index');
var questionController = require('./routes/question')
var userController = require('./routes/user')
var roomController = require('./routes/room')
var groupController = require('./routes/group')

app.use('/', indexController);
app.use('/questions', questionController);
app.use('/users/', userController)
app.use('/rooms/', roomController)
app.use('/groups/', groupController)

// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'jade');

// catch 404 and forward to error handler
app.use(function(req, res, next) {
    next(createError(404));
});
  
// error handler
app.use(function(err, req, res, next) {
    // set locals, only providing error in development
    res.locals.message = err.message;
    res.locals.error = req.app.get('env') === 'development' ? err : {};
  
    // render the error page
    res.status(err.status || 500);
    res.render('error');
});

module.exports = app;