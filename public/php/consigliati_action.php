<?php
include_once 'general_function.php';

global $connection;
$serie_id = $_GET['serie_id'];
$id_utente = $_GET["user_id"];
$consigliato = $_GET["consigliato"];


$query="insert into consiglio (id_serie, id_utente,consigliato) values (?,?,?)";
$stmt=executeQuery($query,array(&$serie_id,&$id_utente,&$consigliato),array("sss"));

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'serie.php';
header("Location: http://$host$uri/$extra?serie_id=".$serie_id);   

?>