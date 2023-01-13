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

    function getHeader($e)
    {
        $header = file_get_contents("./pages/components/header.html");
        
        $header = str_replace("str_email", $e, $header);

        return $header;
    }

    //Pagina Moduls

    function pageLlistaModuls($email, $moduls)
    {
        //Textos a canviar 
            //str_nom_modul
            //str_nom_professor
            //str_idSala

        $page = llegirComponent("./pages/llistaModuls.html");

        $header = getHeader($email);

        $btns = crearBtnsModul($moduls);


        
        $page = str_replace("str_btns_assignatura", $btns, $page);
        $page = str_replace("str_header", $header, $page);

        
        echo $page;
    }

    function crearBtnsModul($moduls)
    {
        $btnSala = file_get_contents("./pages/components/btnModul.html");
        $btnModul = "";



        foreach ($moduls as $key => $value) {
            $btn = str_replace("str_idSala", $value["idSala"], $btnSala);
            $btn = str_replace("str_nom_professor", $value["profe"], $btn);
            $btn = str_replace("str_nom_modul", $value["modul"], $btn);
    
            if($key%3==0){
                $aux = "<div class='row'>";
    
                $btn = $aux . $btn;
            }
    
            if($key%3==2){
                $aux2 = "</div>";
    
                $btn .= $aux2;
    
            }
            $btnModul .=  $btn;
        }
        return $btnModul;
    
    }


    //Pagina Formulari Preguntes

    function pageFormulariPreguntes($e)
    {
        //Textos a canviar 
            //str_email

        $page = llegirComponent("pages/formulariPreguntes.html");


        $page = str_replace("str_email", $e, $page);

        
        echo $page;
    }


    //Pagina Perfil

    // function pagePerfilUsuari()
    // {

    //     $page = llegirComponent("pages/formulariPreguntes.html");


    //     $page = str_replace("str_exemple", $XXXXXX, $page);

        
    //     echo $page;
    // }

?>