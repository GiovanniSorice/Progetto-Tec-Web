<?php
include_once 'general_function.php';

global $connection;
$serie_id = $_GET['serie_id'];
$id_utente = $_GET["user_id"];

$query="delete from preferiti where id_serie = ? and id_utente = ?";
$stmt=executeQuery($query,array(&$serie_id,&$id_utente),array("ss"));

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'serie.php';
header("Location: http://$host$uri/$extra?serie_id=".$serie_id);
    

?>