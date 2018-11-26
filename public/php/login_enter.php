<?php 
include_once 'DBConnection.php';
//TODO: aggiustare password con md5password
$query="select * from utente where username='".$_GET['username']."' and password='".$_GET['password']."'";
$finded=$connection->query($query);
if(!$finded) echo "falso";
if(count($finded)==1){
    //Inizializzo la sessione
    $row = $finded->fetch_array(MYSQLI_ASSOC);
    session_start();
    $_SESSION['user_id']=$row['id'];
    $_SESSION['user_username']=$row['username'];
    $_SESSION['user_tipo']=$row['tipo'];
    echo 'user_id '.$_SESSION['user_id'].' user_username '.$_SESSION['user_username'].' user_tipo '.$_SESSION['user_tipo'];
}

?>