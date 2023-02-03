<?php

//config.php

//start session on web page
session_start();

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('790978550684-4q9o5rqb1qvf2gocqgdeuualrugpmr1a.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/miniProjecteDaw/projecteProba/TH-1/index.php');

//print_r($google_client);

$google_client->addScope('email');

$google_client->addScope('profile');

//print_r($google_client);

?>