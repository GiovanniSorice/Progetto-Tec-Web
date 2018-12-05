<?php
include_once 'general_function.php';

//TODO: aggiustare password con md5password
$username=$_GET['username'];
$password=hash("sha256",$_GET['password']);
$email=$_GET['email'];
$nome=$_GET['nome'];
$cognome=$_GET['cognome'];
$datanascita=$_GET['datanascita'];

$datanascita= date("Y-m-d",strtotime($datanascita));

$query="insert into utente (username,password,email,nome,cognome,data_nascita) values (?,?,?,?,?,?)";
$stmt=executeQuery($connection,$query,array(&$username,&$password,&$email,&$nome,&$cognome,&$datanascita),array("ssssss"));
if($stmt->errno===0){     
    $stmt->close();
    $query="select id,tipo from utente where username=?";
    $stmt=executeQuery($connection,$query,array(&$username),array("s"));
    $result=$stmt->get_result();
    $stmt->close();
    if($result->num_rows==1){
        //Inizializzo la sessione
        $row = $result->fetch_array(MYSQLI_ASSOC);
        session_start();
        $_SESSION['user_id']=$row['id'];
        $_SESSION['user_username']=$username;
        $_SESSION['user_tipo']=$row['tipo'];
        echo 'user_id '.$_SESSION['user_id'].' user_username '.$_SESSION['user_username'].' user_tipo '.$_SESSION['user_tipo'];
    }
    //TODO : aggiungere rinvio a pagina principale
    echo "username has registered. You are npw logged in.";
}else{
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;    
}
    

?>