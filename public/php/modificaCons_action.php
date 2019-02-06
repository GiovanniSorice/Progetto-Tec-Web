<?php
include_once 'general_function.php';

global $connection;
$serie_id = $_GET['serie_id'];
$id_utente = $_GET["user_id"];
$consigliato = $_GET["consigliato"];


$query="update consiglio set consigliato=? where id_serie=? and id_utente=?";
$stmt=executeQuery($query,array(&$consigliato,&$serie_id,&$id_utente),array("sss"));
header("Location: http://localhost/public/php/serie.php?serie_id=".$serie_id);
    

?>