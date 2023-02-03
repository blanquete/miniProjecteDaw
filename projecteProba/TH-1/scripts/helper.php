<?php


?>
<?php

    function llegirComponent($nomFitxer)
    {
        $component = file_get_contents($nomFitxer);

        return $component;
    }

    function getHeader($e)
    {
        $header = file_get_contents("./pages/components/header.html");
        
        $header = str_replace("str_email", $e, $header);

        return $header;
    }

    //Pagina Login

    function pageLogin()
    {
        return file_get_contents("./pages/login.html");
    }
    

    //Pagina Moduls

    function pageLlistaModuls($email, $moduls)
    {
        //Textos a canviar 
            //moduls []
                //[]
                    //str_nom_modul
                    //str_nom_professor
                    //str_idSala
            //str_header

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
    
            if($key % 3 == 0){
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

    function pageFormulariPreguntes($e, $ps, $m)
    {
        //Textos a canviar 
            //str_email
            //str_header
                //str_email
            //str_llistat_preguntes
                // str_title_question
                // str_txt_question
            //str_modul

        $page = llegirComponent("pages/formulariPreguntes.html");


        $header = getHeader($e);
        $llistatPreguntes = crearLlistatPreguntes($ps);

        $page = str_replace("str_email", $e, $page);
        $page = str_replace("str_header", $header, $page);
        $page = str_replace("str_llistat_preguntes", $llistatPreguntes, $page);
        $page = str_replace("str_modul", $m, $page);

        
        echo $page;
    }

    function crearLlistatPreguntes($preguntes)
    {
        // str_title_question
        // str_txt_question

        $divPregunta = file_get_contents("./pages/components/containerPregunta.html");
        $llistatPreguntes = "";



        foreach ($preguntes as $key => $value) {
            $pregunta = str_replace("str_title_question", $value["title"], $divPregunta);
            $pregunta = str_replace("str_txt_question", $value["pregunta"], $pregunta);
    
            $llistatPreguntes .=  $pregunta;
        }
        return $llistatPreguntes;
    }
?>