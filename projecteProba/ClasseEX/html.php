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


    function __constructor()
    {
        $this->doctype = "<!DOCTYPE html>";
    
        $this->openHtml = "<html lang=" . $lang . ">";
    
        $this->openHead = "<head>";
        $this->head = "";
        $this->closeHead = "</head>";
    
        $this->openBody = "<body>";
        $this->body = "";
        $this->closeBody = "</body>";
    
        $this->closeHtml = "</html>";
    }
}

?>