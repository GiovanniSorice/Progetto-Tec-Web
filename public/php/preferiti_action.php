<?php
include_once 'general_function.php';

global $connection;
$serie_id = $_GET['serie_id'];
$id_utente = $_GET["user_id"];

$query="insert into preferiti (id_serie, id_utente) values (?,?)";
$stmt=executeQuery($query,array(&$serie_id,&$id_utente),array("ss"));
header("Location: http://localhost/public/php/serie.php?serie_id=".$serie_id);
    

?>