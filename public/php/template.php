<?php 
    include_once 'general_function.php';

    //Parte standard per tutte le pagine
    function createPage($namePage){
        readfile('../txt/head.txt');
        readfile('../txt/nav.txt');//TODO: sistemare link navbar
        
        session_start();
        
        $file_content = implode("",file("../txt/pagecenter.txt"));
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        if(array_key_exists('user_username',$_SESSION) && !empty($_SESSION['user_username'])) {
            $extra="logout_action.php";
            $output = preg_replace("/<!-- Name -->/i",$_SESSION["user_username"], $file_content);
            $output = preg_replace("/<!-- Log -->/i", "Logout", $output );
            $output = preg_replace("/<!-- url_log -->/i", "http://$host$uri/$extra", $output );
        }else{
            $extra="login.php";
            $output = preg_replace("/<!-- Log -->/i", "Login", $file_content );
            $output = preg_replace("/<!-- url_log -->/i", "http://$host$uri/$extra", $output );
        }
        
        //Parte personalizzata per tutte le pagine
        switch ($namePage) {
            case "esplora":
                echo printPageEsplora($output);
            break;
            
            default:
                ;
            break;
        }
        
        
        //Parte standard per tutte le pagine
        
        readfile('../txt/footer.txt');
    }
?>