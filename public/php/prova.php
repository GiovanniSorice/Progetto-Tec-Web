<?php 
    include_once 'general_function.php';

    //Parte standard per tutte le pagine

    readfile('../views/head.html');
    readfile('../views/nav.html');
    session_start();
    $file_content = implode("",file("../views/pagecenter.html"));
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
    $genere_page = implode("",file("../views/genere.html"));
    $show_page = implode("",file("../views/show.html"));
    $query="select distinct id, nome from genere a join serie_genere b on a.id=b.id_genere";
    //Seleziono la lista dei generi già in una tabella
    $generi=resultQueryToTable($connection->query($query),array("id","nome"));
    $genere_show_collect="<!-- Successivo -->";
    /*if (count($generi)>1) {
        $genere_show_collect=$genere_page;
    }*/
    for ($i = 1; $i < count($generi); $i++) {
       
        $genere_id=$generi[$i][$generi[0][0]];
        $genere_nome=$generi[$i][$generi[0][1]];
        
        $query="select id,immagine,titolo, consigliato from serie a join serie_genere b on a.id=b.id_serie where b.id_genere=$genere_id";
        //Seleziono la lista delle serie tv di un determinato genere già in una tabella
        $series=resultQueryToTable($connection->query($query),array("id","immagine","titolo","consigliato"));
        
        //Scrivo le serie tv
        $show="<!-- Successiva -->";
        
        /*if (count($series)>1) {
            $show=$show_page;
        }*/
        for ($j = 1; $j < count($series); $j++) {
                        
            $show=preg_replace("/<!-- Successiva -->/i",$show_page." <!-- Successiva -->" , $show );                
            $show=preg_replace("/<!-- Immagine -->/i",$series[$j][$series[0][1]] , $show );
            $show=preg_replace("/<!-- Id -->/i",$series[$j][$series[0][0]] , $show );
            $show=preg_replace("/<!-- Titolo -->/i",$series[$j][$series[0][2]] , $show );
            $show=preg_replace("/<!-- Consigliato -->/i",$series[$j][$series[0][3]] , $show );
            
        }        
        $show=preg_replace("/<!-- Successiva -->/i","" , $show );
        
        //Inserisco le serie nel div del genere e completo il div con le informazioni mancanti
        $genere_show_collect=preg_replace("/<!-- Successivo -->/i",$genere_page." <!-- Successivo -->" , $genere_show_collect );
        $genere_show_collect=preg_replace("/<!-- Genere -->/i",$genere_nome , $genere_show_collect );
        $genere_show_collect=preg_replace("/<!-- Genere_Titolo -->/i",$genere_nome , $genere_show_collect );
        $genere_show_collect=preg_replace("/<!-- Show -->/i",$show , $genere_show_collect );   
        //echo " genere_show_collect /n ".$genere_show_collect." /n ";
        
    }    
    $genere_show_collect=preg_replace("/<!-- Successivo -->/i","" , $genere_show_collect );
    
    $output = preg_replace("/<!-- Nome_Pagina -->/i", "esplora", $output );
    $output = preg_replace("/<!-- Contenuto_Effettivo -->/i", $genere_show_collect, $output );
    
    echo $output;
    
    //Parte standard per tutte le pagine
    
    readfile('../views/footer.html');

?>