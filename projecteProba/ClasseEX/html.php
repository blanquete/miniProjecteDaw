<?php


include_once("../Classes/assignatura.php");
include_once("../Classes/grup.php");
include_once("../Classes/questio.php");
include_once("../Classes/rol.php");
include_once("../Classes/tipusQuestio.php");
include_once("../Classes/user.php");
include_once("config.php");
include_once("index.php");
include_once("logout.php");


class Html
{
    private $doctype;

    private $openHtml;

    private $openHead;
    private $head;
    private $closeHead;

    private $openBody;
    private $body;
    private $closeBody;

    private $closeHtml;


    function __construct($lang = "es")
    {
        $this->doctype = "<!DOCTYPE html>";
    
        $this->openHtml = "<html lang=" . $lang . ">";

        $this->openHead = "<head>";
        $this->head = "";
        
        $this->openBody = "<body>";
        $this->body = "";
    }

    //GETTERS & SETTERS

    public function getDoctype(){return $this->doctype;}
    public function setDoctype($value){$this->doctype = $value;}

    public function getOpenHtml(){return $this->openHtml;}
    public function setOpenHtml($value){$this->openHtml = $value;}

    public function getOpenHead(){return $this->openHead;}
    public function setOpenHead($value){$this->openHead = $value;}

    public function getHead(){return $this->head;}
    public function setHead($value){$this->head = $value;}

    public function getOpenBody(){return $this->openBody;}
    public function setOpenBody($value){$this->openBody = $value;}

    public function getBody(){return $this->body;}
    public function setBody($value){$this->body = $value;}


//FUNCTIONS

    //AFEGIR CONTINGUT

    public function afegirBody($value)
    {
        $this->body .= $value;
    }

    public function afegirHead($value)
    {
        $this->head .= $value;
    }

    

    //ACCEDIR ALS COMPONENTS

    public function llegirComponent($nomFitxer)
    {
        $f = fopen($nomFitxer, "r");

        $component = "";
        
        while(!feof($f))
        {
            $linea = fgets($f);
            $component .= $linea; 
        }

        return $component;
    }

    //MODULS

    public function capcaleraPagina(User $user = null)
    {

        if(isset($user))
        {
            $cap = str_replace("str_email_str", $user->getEmail(), llegirComponent("header.html"));
        }
        else
        {
            $login_button = '<a href="'.$google_client->createAuthUrl().'">Iniciar Sessio</a>';

            //$cap = str_replace("str_email_str", $login_button, llegirComponent("header.html"));
        }

        return $cap;
    }






    public function moduls($mods)
    {
        $componentModuls = "<div class='containerModules'>";

        foreach($mods as $m)
        {
            $modTxt = str_replace("str_nom_assignatura_str", $m->getValor(), $this->llegirComponent("btnAssignatura.html"));

            $componentModuls .= $modTxt;
        }

        $componentModuls .= "</div>";

        return $componentModuls;
    }

    //IMPRIMIR CONTINGUT
    
    public function imprimirPagina()
    {
        echo $this->getDoctype();
        echo $this->getOpenHtml();
        echo $this->getOpenHead();
        echo $this->getHead();
        echo "</head>";
        echo $this->getOpenBody();
        echo $this->getBody();
        echo "</body>";
        echo "</html>";
    }
}

?>