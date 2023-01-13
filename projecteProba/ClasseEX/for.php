<?php

//array moduls/nom profe/idModul

    // $moduls = array(
    //     array("modul" => "m01", "profe" => "Angel", "idSala" => "1"),
    //     array("modul" => "m02", "profe" => "Angel", "idSala" => "2"),
    //     array("modul" => "m03", "profe" => "Angel", "idSala" => "3"),
    //     array("modul" => "m04", "profe" => "Angel", "idSala" => "4"),
    //     array("modul" => "m05", "profe" => "Angel", "idSala" => "5"),
    //     array("modul" => "m06", "profe" => "Angel", "idSala" => "6"),
    //     array("modul" => "m07", "profe" => "Angel", "idSala" => "7"),
    //     array("modul" => "m08", "profe" => "Angel", "idSala" => "8"),
    //     array("modul" => "m09", "profe" => "Angel", "idSala" => "9")
    // );
    
    function crearButons($moduls)
    {
        $btnSala = " <div class='col'>
            <button class='btn btn-light shadow p-3 mb-5 bg-body rounded  border-success' value='str_idSala'><h5>str_nom_modul</h5><br>Professor(a): str_nom_professor</button>
            </div>";
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
        
?>