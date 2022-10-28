<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('790978550684-jdj9t7dvpt6ldqhlplk0up3j81lbbo0a.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
// $google_client->setRedirectUri('http://localhost:3030');
$google_client->setRedirectUri('http://localhost/miniProjecteDaw/projecteProba/signIn%20PHP/index.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
session_start();

?>