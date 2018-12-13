<?php
/*
  blocco dei parametri di connessione
*/
// nome di host
$host = "localhost";
// nome del database
$db = "db_tecweb";
// username dell'utente in connessione
$username = "root";
// password dell'utente
$password = "";
global $connection;
$connection=new mysqli($host,$username,$password,$db);

if($connection->connect_errno){
    throw new Exception("Connessione fallita (".$connection->connect_errno."):".$connection->connect_error);
}
?>
