<?php
include_once 'general_function.php';

global $connection;
session_start();
$post_id = $_GET['post_id'];
$id_utente = $_SESSION["user_id"];

$query="insert into segnalazione (id_ref, id_utente,tipo) values (?,$id_utente,1)";
$stmt=executeQuery($query,array(&$post_id),array("s"));

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'serie.php';
header("Location: http://$host$uri/$extra?serie_id=".$_SESSION["serie_id"]);



?>