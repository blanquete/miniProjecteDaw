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
if (!isset($_SESSION['access_token'])) {//Si no estem loguinats preparem el boto de LOGIN
    $login_button = '<a href="' . $google_client->createAuthUrl() . '" style=" background: #dd4b39; border-radius: 5px; color: white; display: block; font-weight: bold; padding: 20px; text-align: center; text-decoration: none; width: 200px;">Login With Google</a>';
}
else
{//Si ens loguinem correctament mirem on volem anar i carreguem la informacio necessaria
    $email = $_SESSION['user_email_address'];


    if(isset($_POST["desti"]))
    {
        $desti = $_POST["desti"];
        if($desti == "llistaModuls")
        {   
            

            //Amb l'id de l'usuari obtenim aquesta llista
            $moduls = array(
                array("modul" => "M01", "profe" => "Angel", "idSala" => "1"),
                array("modul" => "M02", "profe" => "Ruben", "idSala" => "2"),
                array("modul" => "M03", "profe" => "Francesc", "idSala" => "3"),
                array("modul" => "M04", "profe" => "Quim", "idSala" => "4"),
                array("modul" => "M05", "profe" => "Jordi", "idSala" => "5"),
                array("modul" => "M06", "profe" => "Nicolau", "idSala" => "6"),
                array("modul" => "M07", "profe" => "Lluis", "idSala" => "7"),
                array("modul" => "M08", "profe" => "Gloria", "idSala" => "8"),
                array("modul" => "M09", "profe" => "Alex", "idSala" => "9")
            );
            //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
        }
        else if($desti == "formulariPreguntes")
        {
            if(isset($_POST["idModul"]))
            {
                $modul = $_POST["idModul"];
            }


            if(isset($_POST["accio"]))
            {
                $accio = $_POST["accio"];

                switch($accio)
                {
                    case "enviarPregunta":

                        print_r($_POST);


                        break;

                    case "resoldre":

                        break;

                    case "eliminar":

                        break;

                }
            }



            //carregar preguntes
            $preguntesAlumne = array(
                array("title" => "Titol Pregunta 1", "pregunta" => "Descripcio Pregunta 1"),
                array("title" => "Titol Pregunta 2", "pregunta" => "Descripcio Pregunta 2"),
                array("title" => "Titol Pregunta 3", "pregunta" => "Descripcio Pregunta 3"),
                array("title" => "Titol Pregunta 4", "pregunta" => "Descripcio Pregunta 4"),
                array("title" => "Titol Pregunta 5", "pregunta" => "Descripcio Pregunta 5"),
                array("title" => "Titol Pregunta 6", "pregunta" => "Descripcio Pregunta 6"),
                array("title" => "Titol Pregunta 7", "pregunta" => "Descripcio Pregunta 7"),
                array("title" => "Titol Pregunta 8", "pregunta" => "Descripcio Pregunta 8"),
                array("title" => "Titol Pregunta 9", "pregunta" => "Descripcio Pregunta 9"),
                array("title" => "Titol Pregunta 10", "pregunta" => "Descripcio Pregunta 10"),
                array("title" => "Titol Pregunta 11", "pregunta" => "Descripcio Pregunta 11"),
                array("title" => "Titol Pregunta 12", "pregunta" => "Descripcio Pregunta 12")
            );
            //^^^^^^^^^^^^^^^^^^^^
        }
    }
    else
    {
        $desti = "llistaModuls";

        //Amb l'id de l'usuari obtenim aquesta llista
        $moduls = array(
            array("modul" => "M01", "profe" => "Angel", "idSala" => "1"),
            array("modul" => "M02", "profe" => "Ruben", "idSala" => "2"),
            array("modul" => "M03", "profe" => "Francesc", "idSala" => "3"),
            array("modul" => "M04", "profe" => "Quim", "idSala" => "4"),
            array("modul" => "M05", "profe" => "Jordi", "idSala" => "5"),
            array("modul" => "M06", "profe" => "Nicolau", "idSala" => "6"),
            array("modul" => "M07", "profe" => "Lluis", "idSala" => "7"),
            array("modul" => "M08", "profe" => "Gloria", "idSala" => "8"),
            array("modul" => "M09", "profe" => "Alex", "idSala" => "9")
        );
        //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    }

    
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

                pageFormulariPreguntes($email, $preguntesAlumne, $modul);

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


