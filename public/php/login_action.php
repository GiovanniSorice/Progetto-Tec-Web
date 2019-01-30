<?php
include_once 'general_function.php';

//TODO: aggiustare password con md5password
$username=$_GET['username'];
$password=hash("sha256",$_GET['password']);

$query="select * from utente where username=? and password=?";
$stmt=executeQuery($query,array(&$username,&$password),array("ss"));
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
        
        /* Redirect to a different page in the current directory that was requested */
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'esplora.php';
        header("Location: http://$host$uri/$extra");
    }else{
        //TODO : se entra qui non ha trovato nessuna corrispondenza tra username e passward, dire di reinserire i dati
        echo $result->num_rows;
    }
}else{
    echo "result vuoto";
}
    

?>