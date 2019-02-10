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
        $footer = implode("",file("../txt/footer.txt"));
        
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

        if(array_key_exists('user_tipo',$_SESSION) && !empty($_SESSION['user_tipo']) && $_SESSION['user_tipo']=="admin"){
            $footer = preg_replace("/<!-- Amministrazione -->/i", '<li refAdmin><a href="amministrazione.php" title="Amministrazione">Amministrazione</a></li>', $footer);
        }

        //Parte personalizzata per tutte le pagine
        $script="";

        switch ($namePage) {
            case "esplora":
                $footer = preg_replace("/refEsplora/i", "class=\"selezionato\"", $footer );
                echo printPageEsplora($output);
            break;
            
            case "serie":
                echo printPageSerie($output);
                $script = implode("",file("../javascript/serie.js"));                
                break;
                
            case "about":
                $footer = preg_replace("/refAbout/i", "class=\"selezionato\"", $footer );
                echo printPageAbout($output);
                break;

            case "home":
                echo printPageHome($output);
                break;

            case "privacy":
                $footer = preg_replace("/refPrivacy/i", "class=\"selezionato\"", $footer );
                echo printPagePrivacy($output);
                break;

            case "login":
                echo printPageLogin($output);
                break;

            case "signup":
                echo printPageSignUp($output);
                break;

            case "preferiti":
                $footer = preg_replace("/refPreferiti/i", "class=\"selezionato\"", $footer );
                echo printPagePreferiti($output);
                break;

             case "profilo":
                $footer = preg_replace("/refProfilo/i", "class=\"selezionato\"", $footer );
                echo printPageProfilo($output);
                break;

             case "genere":
                 echo printPageGenere($output);
                 break;
                 
             case "amministrazione":
                 $footer = preg_replace("/refAdmin/i", "class=\"selezionato\"", $footer );
                 echo printPageAmministrazione($output);
                 break;
             case "faq":
                 $footer = preg_replace("/refFaq/i", "class=\"selezionato\"", $footer );
                 echo printPageFAQ($output);
                 break;
                 
            case "404":
                 echo printPage404($output);
                 break;
                 
            case "supporto":
                $footer = preg_replace("/refSupporto/i", "class=\"selezionato\"", $footer );
                echo printPageSupporto($output);
                break;
                

            default:
                
            break;
        }
        
        
        //Parte standard per tutte le pagine
        
        $footer = preg_replace("/<!-- Script -->/i", $script, $footer );
        
        echo $footer;
    }
?>