<?php

//Include Configuration File
include('config.php');
include('./scripts/helper.php');

$apiUrl = "http://localhost:4000/";

$login_button = '';

if (isset($_GET["code"])) {

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    if (!isset($token['error'])) {

        $google_client->setAccessToken($token['access_token']);

        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);
        //print_r($google_service);


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
if (!isset($_SESSION['access_token']))
{//Si no estem loguinats preparem el boto de LOGIN
    //Boto simple predefinit
    //$login_button = '<a href="' . $google_client->createAuthUrl() . '" style=" background: #dd4b39; border-radius: 5px; color: white; display: block; font-weight: bold; padding: 20px; text-align: center; text-decoration: none; width: 200px;">Login With Google</a>';

    //Pagina Login Custom
    $login_button = pageLogin($google_client->createAuthUrl());
}
else
{//Si ens loguinem correctament mirem on volem anar i carreguem la informacio necessaria
    $email = $_SESSION['user_email_address'];

    $user = getBackendCall($apiUrl . "users/email/$email");
    $iduser = $user["iduser"];
    //print_r($user);

    if(isset($_POST["accio"]))
    {
        $accio = $_POST["accio"];

        switch($accio)
        {
            case "enviarPregunta":

                //print_r($_POST);

                $title = $_POST["titlePregunta"];
                $description = $_POST["txtPregunta"];
                $iduser;
                $idroom = $_POST["idSala"];

                getBackendCall($apiUrl . "questions/create/$title/$description/$iduser/$idroom", "GET");


                break;

            case "resoldre":

                $idPregunta = $_REQUEST["idPregunta"];

                getBackendCall($apiUrl . "questions/$idPregunta/solved", "PUT");

                break;

            case "crearSala":

                $nomSala = $_POST["nomSala"];
                $idGroup = $_POST["selectGrup"];
                $iduser;

                getBackendCall($apiUrl . "rooms/create/$nomSala/$iduser/$idGroup", "GET");

                break;
        }
    }


    if(isset($_POST["desti"]))
    {
        $desti = $_POST["desti"];
        if($desti == "llistaModuls")
        {   


            if($user["role"]["name"] == "student")
            {
                $idgroup = $user["group"]["idgroup"];
                $moduls = getBackendCall($apiUrl . "rooms/group/$idgroup");

                //print_r($moduls);
            }
            else if($user["role"]["name"] == "teacher")
            {
                $iduser = $user["iduser"];
                $moduls = getBackendCall($apiUrl . "rooms/user/$iduser");
                //agafar sales professor by iduser
            }

            //Amb l'id de l'usuari obtenim aquesta llista
            /*$moduls = array(
                array("name" => "M01", "user" => array("name" => "Angel"), "idroom" => "1"),
                array("name" => "M02", "user" => array("name" => "Ruben"), "idroom" => "2"),
                array("name" => "M03", "user" => array("name" => "Francesc"), "idroom" => "3"),
                array("name" => "M04", "user" => array("name" => "Quim"), "idroom" => "4"),
                array("name" => "M05", "user" => array("name" => "Jordi"), "idroom" => "5"),
                array("name" => "M06", "user" => array("name" => "Nicolau"), "idroom" => "6"),
                array("name" => "M07", "user" => array("name" => "Lluis"), "idroom" => "7"),
                array("name" => "M08", "user" => array("name" => "Gloria"), "idroom" => "8"),
                array("name" => "M09", "user" => array("name" => "Alex"), "idroom" => "9")
            );
            //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
        }
        else if($desti == "formulariPreguntes")
        {
            if(isset($_POST["idModul"]))
            {
                $modul = $_POST["idModul"];
            }

            $idroom = $_POST["idSala"];


            if($user["role"]["name"] == "student")
            {
                $preguntes = getBackendCall($apiUrl . "questions/?iduser=$iduser&idroom=$idroom");
            }
            else if($user["role"]["name"] == "teacher")
            {
                $preguntes = getBackendCall($apiUrl . "questions/?idroom=$idroom");
            }

            //carregar preguntes
            /*$preguntes = array(
                array("title" => "Titol Pregunta 1","user" => array("name" => "Angel"), "idquestion" => 1, "description" => "Descripcio Pregunta 1"),
                array("title" => "Titol Pregunta 2","user" => array("name" => "Ruben"), "idquestion" => 2, "description" => "Descripcio Pregunta 2"),
                array("title" => "Titol Pregunta 3","user" => array("name" => "Francesc"), "idquestion" => 3, "description" => "Descripcio Pregunta 3"),
                array("title" => "Titol Pregunta 4","user" => array("name" => "Quim"), "idquestion" => 4, "description" => "Descripcio Pregunta 4"),
                array("title" => "Titol Pregunta 5","user" => array("name" => "Jordi"), "idquestion" => 5, "description" => "Descripcio Pregunta 5"),
                array("title" => "Titol Pregunta 6","user" => array("name" => "Nicolau"), "idquestion" => 6, "description" => "Descripcio Pregunta 6"),
                array("title" => "Titol Pregunta 7","user" => array("name" => "Lluis"), "idquestion" => 7, "description" => "Descripcio Pregunta 7"),
                array("title" => "Titol Pregunta 8","user" => array("name" => "Gloria"), "idquestion" => 8, "description" => "Descripcio Pregunta 8"),
                array("title" => "Titol Pregunta 9","user" => array("name" => "Alex"), "idquestion" => 9, "description" => "Descripcio Pregunta 9")
            );
            //^^^^^^^^^^^^^^^^^^^^*/
        }
    }
    else
    {
        $desti = "llistaModuls";

        $groups = [];

        if($user["role"]["name"] == "student")
        {
            $idgroup = $user["group"]["idgroup"];
            $moduls = getBackendCall($apiUrl . "rooms/group/$idgroup");
        }
        else if($user["role"]["name"] == "teacher")
        {
            $iduser = $user["iduser"];
            $moduls = getBackendCall($apiUrl . "rooms/user/$iduser");

            $groups = getBackendCall($apiUrl . "groups");
        }


        //Amb l'id de l'usuari obtenim la llista de moduls o sales
            /*$moduls = array(
                array("name" => "M01", "user" => array("name" => "Angel"), "idroom" => "1"),
                array("name" => "M02", "user" => array("name" => "Ruben"), "idroom" => "2"),
                array("name" => "M03", "user" => array("name" => "Francesc"), "idroom" => "3"),
                array("name" => "M04", "user" => array("name" => "Quim"), "idroom" => "4"),
                array("name" => "M05", "user" => array("name" => "Jordi"), "idroom" => "5"),
                array("name" => "M06", "user" => array("name" => "Nicolau"), "idroom" => "6"),
                array("name" => "M07", "user" => array("name" => "Lluis"), "idroom" => "7"),
                array("name" => "M08", "user" => array("name" => "Gloria"), "idroom" => "8"),
                array("name" => "M09", "user" => array("name" => "Alex"), "idroom" => "9")
            );
            //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/

            /*$groups = array(
                array("name" => "M01", "idgroup" => 1),
                array("name" => "M02", "idgroup" => 2),
                array("name" => "M03", "idgroup" => 3),
                array("name" => "M04", "idgroup" => 4),
                array("name" => "M05", "idgroup" => 5),
                array("name" => "M06", "idgroup" => 6),
                array("name" => "M07", "idgroup" => 7),
                array("name" => "M08", "idgroup" => 8),
                array("name" => "M09", "idgroup" =>  9)
            );*/


    }

    
}

?>




<?php
    if ($login_button == '')
    {
        
        switch($desti)
        {
            case "llistaModuls":

                pageLlistaModuls($email, $moduls, $groups, $user["role"]["name"] == "student");

                break;
            case "formulariPreguntes":

                pageFormulariPreguntes($email, $preguntes, $modul, $idroom, $user["role"]["name"] == "student");

                break;
            case "perfilUsuari":

                pagePerfilUsuari();

                break;

            case "mostrarSession":

                print_r($_SESSION);
                echo '<a class="btn btn-danger" href="logout.php">Logout</h3></a>';

                break;
            default:



                break;
            // case "formulariPreguntes":


            //     break;
        }


    }
    else
    {
        echo $login_button;
    }
?>


