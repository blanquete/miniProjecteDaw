<?php

//index.php

//Include Configuration File
include('config.php');

$login_button = '';

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
 //It will Attempt to exchange a code for an valid authentication token.
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
 if(!isset($token['error']))
 {
  //Set the access token used for requests
  $google_client->setAccessToken($token['access_token']);

  //Store "access_token" value in $_SESSION variable for future use.
  $_SESSION['access_token'] = $token['access_token'];

  //Create Object of Google Service OAuth 2 class
  $google_service = new Google_Service_Oauth2($google_client);

  //Get user profile data from google
  $data = $google_service->userinfo->get();

  //Below you can find Get profile data and store into $_SESSION variable
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}

//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if(!isset($_SESSION['access_token']))
{
 //Create a URL to obtain user authorization
 $login_button = '<a href="'.$google_client->createAuthUrl().'">Iniciar Sessio</a>';
}

?>
<html>
 <head>
    <!-- Requeriments per fer login -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Requeriments customs (crats per nosaltres) -->
    <link rel="icon" href="https://cdn.icon-icons.com/icons2/738/PNG/512/doughnut_icon-icons.com_63187.png">
    <link rel="stylesheet" type="text/css" href="../estilPaginaPrincipal.css" media="screen">
    <link rel="stylesheet" type="text/css" href="../estilInput.css" media="screen">
    <link rel="stylesheet" type="text/css" href="../animacioBoton.css" media="screen">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Teacher Help</title>
  
</head>
<body class="body">

    <script src="click.js"></script>

<div class="containerHeader">
    <!-- Div izquierda-->
    <div class="containerIziquierda">
        <h1 id="time">00:00:00</h1>
    </div>
   
   <?php
   if($login_button == '')//si estem loginats mostrem el contingut del formulari
   {

    echo '<div class="containerDerecha"><p>'.$_SESSION['user_email_address'].'</p></div><h3><a href="logout.php">Logout</a></h3></div>';
    echo '<div class="containerAmbTotaInformacio">';
    
   }
   else//Si no el deixem ocult (Podriem mostrar una pantalla d'inici)
   {
    echo '<div class="containerDerecha"><p>' . $login_button . '</p></div></div>';
    echo '<div class="containerAmbTotaInformacio" style="display:none">';


   }
   ?>
    <br>
    <div class="containerInformació">
        <h1 class="txtTitolH1">Centre de preguntes</h1>
    </div>

    <form>
   
    <div class="containerQuestion">
        <label>Selecciona el teu problema:</label>
        <br>
        <br>
        <select class="seleccio">
            <option value="" hidden selected>Selecciona una opción</option>
            <option value="problemaBBDD">Problemes base de dades</option>
            <option value="errorCompilacio">Error de compilació</option>
            <option value="errorUI">Error amb la interficie</option>
            <option value="altres">Altres</option>
        </select>
    </div>

    <div class="containerQuestion">
        <label>Introdueix el teu error:</label>
        <br>
        <br>
        <input class="subrallat"  name="txtPreguntad" type="text" value="" required>
    </div>
    </form> 
   </div>
    
</body>
</html>

