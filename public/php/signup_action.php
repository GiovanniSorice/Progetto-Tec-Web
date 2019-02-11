<?php
include_once 'general_function.php';

//TODO: aggiustare password con sha256password
$username=$_POST['username'];
$password=hash("sha256",$_POST['password']);
$email=$_POST['email'];
$nome=$_POST['nome'];
$cognome=$_POST['cognome'];
$datanascita=$_POST['datanascita'];

$datanascita= date("Y-m-d",strtotime($datanascita));
session_start();

$query="insert into utente (username,password,email,nome,cognome,data_nascita) values (?,?,?,?,?,?)";
$stmt=executeQuery($query,array(&$username,&$password,&$email,&$nome,&$cognome,&$datanascita),array("ssssss"));
if($stmt->errno===0){     
    $stmt->close();
    $query="select id,tipo from utente where username=?";
    echo $username;
    $stmt=executeQuery($query,array(&$username),array("s"));
    $result=$stmt->get_result();
    $stmt->close();
    if($result->num_rows==1){
        //Inizializzo la sessione
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $_SESSION['user_id']=$row['id'];
        $_SESSION['user_username']=$username;
        $_SESSION['user_tipo']=$row['tipo'];
        
    }
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'esplora.php';
    
    header("Location: http://$host$uri/$extra");
    }else{
        $_SESSION['errore_signup']="Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'signup.php';
        
        header("Location: http://$host$uri/$extra");
    }
    

?>