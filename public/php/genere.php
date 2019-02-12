<?php 
    include_once 'template.php';

    if(array_key_exists('spazio_ricerca',$_SESSION) && !empty($_SESSION['spazio_ricerca'])){        
         createPage("genere");
    }else{
        createPage("ricerca");        
    }
?>