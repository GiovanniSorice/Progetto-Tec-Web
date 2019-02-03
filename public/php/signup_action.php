<?php
include_once 'general_function.php';

//TODO: aggiustare password con sha256password
$username=$_GET['username'];
$password=hash("sha256",$_GET['password']);
$email=$_GET['email'];
$nome=$_GET['nome'];
$cognome=$_GET['cognome'];
$datanascita=$_GET['datanascita'];

$datanascita= date("Y-m-d",strtotime($datanascita));

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
        session_start();
        $_SESSION['user_id']=$row['id'];
        $_SESSION['user_username']=$username;
        $_SESSION['user_tipo']=$row['tipo'];
        
    }
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'esplora.php';
    
    header("Location: http://$host$uri/$extra");
    }else{
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;    
}
    

?>