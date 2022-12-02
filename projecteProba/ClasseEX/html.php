<?php

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


    function __constructor($lang = "es")
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

    public function afegirBody($value)
    {
        $this->body .= $value;
    }

    public function afegirHead($value)
    {
        $this->head .= $value;
    }

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

$ht = new Html();

$head = '<link rel="stylesheet" type="text/css" href="../estilPaginaModuls.css" media="screen"><script src="../module.js"></script>;';

$body = "<div class=\"containerModules\"><div class=\"module\" onclick='moduleClicked(\"M01\")'>    <h1>M01</h1></div><div class=\"module\" onclick='moduleClicked(\"M02\")'>    <h1>M02</h1></div><div class=\"module\" onclick='moduleClicked(\"M03\")'>    <h1>M03</h1></div><div class=\"module\" onclick='moduleClicked(\"M04\")'>    <h1>M04</h1></div><div class=\"module\" onclick='moduleClicked(\"M04\")'>    <h1>M04</h1></div><div class=\"module\" onclick='moduleClicked(\"M04\")'>    <h1>M04</h1></div><div class=\"module\" onclick='moduleClicked(\"M04\")'>    <h1>M04</h1></div></div>";

$ht->afegirHead($head);
$ht->afegirBody($body);

$ht->imprimirPagina();

?>