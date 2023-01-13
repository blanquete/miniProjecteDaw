<?php

//Include Configuration File
include('config.php');

$login_button = '';

if (isset($_GET["code"])) {

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    if (!isset($token['error'])) {

        $google_client->setAccessToken($token['access_token']);

        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);

        $data = $google_service->userinfo->get();

        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }

        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if (!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
        }

        if (!empty($data['gender'])) {
            $_SESSION['user_gender'] = $data['gender'];
        }

        if (!empty($data['picture'])) {
            $_SESSION['user_image'] = $data['picture'];
        }
    }
}

//Ancla para iniciar sesión
if (!isset($_SESSION['access_token'])) {
    $login_button = '<a href="' . $google_client->createAuthUrl() . '" style=" background: #dd4b39; border-radius: 5px; color: white; display: block; font-weight: bold; padding: 20px; text-align: center; text-decoration: none; width: 200px;">Login With Google</a>';
}
else
{
    $nom = $_SESSION['user_first_name'];
    $cognom = $_SESSION['user_last_name'];
    $email = $_SESSION['user_email_address'];
}


?>


<?php
    if ($login_button == '')
    {
        pageFormulariPreguntes($email);
        
        /*switch($page)
        {
            case "llistaModuls":

                pageLlistaModuls();

                break;
            case "formulariPreguntes":

                pageFormulariPreguntes();

                break;
            case "perfilUsuari":

                pagePerfilUsuari();

                break;

            // case "formulariPreguntes":


            //     break;
            // case "formulariPreguntes":


            //     break;
        }*/


    }
    else
    {
        echo '<div align="center">' . $login_button . '</div>';
    }
?>


<?php

    function llegirComponent($nomFitxer)
    {
        $component = file_get_contents($nomFitxer);

        return $component;
    }

    function replaceTxt($nomFitxer, $search, $replacement)
    {
        $component = llegirComponent($nomFitxer);

        $component = str_replace($search, $replacement, $component);

        return $component;
    }

    function pageLlistaModuls($nomModul, $nomProfessor)
    {
        //Textos a canviar 
            //str_nom_modul
            //str_nom_professor
            //str_idSala

        $page = llegirComponent("pages/llistaModuls.html");


        $page = str_replace("str_exemple", $XXXXXX, $page);

        
        echo $page;
    }

    function pageFormulariPreguntes($e)
    {
        //Textos a canviar 
            //str_email

        $page = llegirComponent("pages/formulariPreguntes.html");


        $page = str_replace("str_email", $e, $page);

        
        echo $page;
    }

    function pagePerfilUsuari()
    {

        $page = llegirComponent("pages/formulariPreguntes.html");


        $page = str_replace("str_exemple", $XXXXXX, $page);

        
        echo $page;
    }

?>