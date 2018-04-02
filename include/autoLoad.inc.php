<?php
function  __autoload($className)
{
	$repClasses='classes/';
	require $repClasses.$className.'.class.php';
}// l'idee c'est de faire un classes/Produit.class.php
?>
