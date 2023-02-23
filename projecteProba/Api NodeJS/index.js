const express = require('express');
const app = express();
const morgan = require('morgan');

//Configuració
app.set('port', 3000);
app.set('json spaces', 2)

/* GET home page. */
app.get('/', (req, res, next) => {
    res.render('index', { title: 'Express' });
});
  
module.exports = app;