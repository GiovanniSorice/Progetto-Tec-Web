<?php
include_once 'general_function.php';

//TODO: aggiustare password con md5password
$username=$_GET['username'];
$password=hash("sha256",$_GET['password']);

$query="select * from utente where username=? and password=?";
$stmt=executeQuery($connection,$query,array(&$username,&$password),array("ss"));
if($stmt!=null){   
    $result=$stmt->get_result();
    $stmt->close();
    if($result->num_rows==1){
        //Inizializzo la sessione
        $row = $result->fetch_array(MYSQLI_ASSOC);
        session_start();
        $_SESSION['user_id']=$row['id'];
        $_SESSION['user_username']=$row['username'];
        $_SESSION['user_tipo']=$row['tipo'];
        echo 'user_id '.$_SESSION['user_id'].' user_username '.$_SESSION['user_username'].' user_tipo '.$_SESSION['user_tipo'];
    }else{
        //TODO : se entra qui non ha trovato nessuna corrispondenza tra username e passward, dire di reinserire i dati
        echo $result->num_rows;
    }
}else{
    echo "result vuoto";
}
    

?>