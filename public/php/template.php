<?php 
    include_once 'general_function.php';

    //Parte standard per tutte le pagine
    session_start();
    function createPage($namePage){
        readfile('../txt/head.txt');
        echo printNavbar($namePage);

        
        
        $file_content = implode("",file("../txt/pagecenter.txt"));
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        
        if(array_key_exists('user_username',$_SESSION) && !empty($_SESSION['user_username'])) {
            $extra="logout_action.php";
            $output = preg_replace("/<!-- Nome -->/i",'<a href="#">'.$_SESSION["user_username"].'</a>', $file_content);//TODO: aggiungere il link al profilo            
            $output = preg_replace("/<!-- Log -->/i", "Logout", $output );
            $output = preg_replace("/<!-- Url_Log -->/i", "http://$host$uri/$extra", $output );
        }else{
            $extra="login.php";
            $output = preg_replace("/<!-- Nome -->/i","Accesso non effettuato.", $file_content);            
            $output = preg_replace("/<!-- Log -->/i", "Login", $output );
            $output = preg_replace("/<!-- Url_Log -->/i", "http://$host$uri/$extra", $output );
            
        }
        
        //Parte personalizzata per tutte le pagine
        $script="";
        switch ($namePage) {
            case "esplora":
                echo printPageEsplora($output);
            break;
            
            case "serie":
                echo printPageSerie($output);
                $script = implode("",file("../javascript/serie.js"));                
                break;
                
            case "about":
                echo printPageAbout($output);
                break;

            case "home":
                echo printPageHome($output);
                break;

            case "privacy":
                echo printPagePrivacy($output);
                break;

            case "login":
                echo printPageLogin($output);
                break;

            case "signup":
                echo printPageSignUp($output);
                break;

            case "preferiti":
                echo printPagePreferiti($output);
                break;

             case "profilo":
                echo printPageProfilo($output);
                break;

             case "genere":
                 echo printPageGenere($output);
                 break;

            case "404":
                 echo printPage404($output);
                 break;
                 

            default:
                
            break;
        }
        
        
        //Parte standard per tutte le pagine
        
        $footer = implode("",file("../txt/footer.txt"));
        $footer = preg_replace("/<!-- Script -->/i", $script, $footer );
        
        echo $footer;
    }
?>