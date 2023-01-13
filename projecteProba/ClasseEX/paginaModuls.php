<?php
include_once("html.php");

$ht = new Html();

$head = '<link rel="stylesheet" type="text/css" href="../estilPaginaModuls.css" media="screen">';


$assignatures = [new Assignatura(1, "M01"), new Assignatura(1, "M02"), new Assignatura(1, "M03") ];


$ht->afegirHead($head);
$ht->afegirBody($ht->capcaleraPagina());
$ht->afegirBody($ht->moduls($assignatures));

$ht->imprimirPagina();

?>