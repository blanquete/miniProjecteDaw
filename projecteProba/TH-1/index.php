<?php

//Include Configuration File
include('config.php');
include('./scripts/helper.php');

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
    if(isset($_POST["desti"]))
    {
        $desti = $_POST["desti"];
        if($desti == "formulariPreguntes")
        {
            //carregar preguntes

            //^^^^^^^^^^^^^^^^^^^^
        }
    }
    else
    {
        $desti = "llistaModuls";

        //Amb l'id de l'usuari obtenim aquesta llista
        $moduls = array(
            array("modul" => "m01", "profe" => "Angel", "idSala" => "1"),
            array("modul" => "m02", "profe" => "Angel", "idSala" => "2"),
            array("modul" => "m03", "profe" => "Angel", "idSala" => "3"),
            array("modul" => "m04", "profe" => "Angel", "idSala" => "4"),
            array("modul" => "m05", "profe" => "Angel", "idSala" => "5"),
            array("modul" => "m06", "profe" => "Angel", "idSala" => "6"),
            array("modul" => "m07", "profe" => "Angel", "idSala" => "7"),
            array("modul" => "m08", "profe" => "Angel", "idSala" => "8"),
            array("modul" => "m09", "profe" => "Angel", "idSala" => "9")
        );
        //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    }





    $nom = $_SESSION['user_first_name'];
    $cognom = $_SESSION['user_last_name'];
    $email = $_SESSION['user_email_address'];

    
}


// $page = "llistaModuls";
// $page = "formulariPreguntes";
// $page = "mostrarSession";


?>




<?php
    if ($login_button == '')
    {
        
        switch($desti)
        {
            case "llistaModuls":

                pageLlistaModuls($email, $moduls);

                break;
            case "formulariPreguntes":

                pageFormulariPreguntes($email);

                break;
            case "perfilUsuari":

                pagePerfilUsuari();

                break;

            case "mostrarSession":

                print_r($_SESSION);
                echo '<a class="btn btn-danger" href="logout.php">Logout</h3></a>';

                break;
            // case "formulariPreguntes":


            //     break;
        }


    }
    else
    {
        echo '<div align="center">' . $login_button . '</div>';
    }
?>


