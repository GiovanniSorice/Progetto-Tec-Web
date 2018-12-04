<?php
include_once 'general_function.php';

//TODO: aggiustare password con md5password
$username=$_GET['username'];
$password=$_GET['password'];

$query="select * from utente where username=? and password=?";
$result=executeQuery($connection,$query,array(&$username,&$password),array("ss"));
if($result!=null){    
    if($result->num_rows==1){
        //Inizializzo la sessione
        $row = $result->fetch_array(MYSQLI_ASSOC);
        session_start();
        $_SESSION['user_id']=$row['id'];
        $_SESSION['user_username']=$row['username'];
        $_SESSION['user_tipo']=$row['tipo'];
        echo 'user_id '.$_SESSION['user_id'].' user_username '.$_SESSION['user_username'].' user_tipo '.$_SESSION['user_tipo'];
    }else{
        echo $result->num_rows;
    }
}else{
    echo "result vuoto";
}
    

?>