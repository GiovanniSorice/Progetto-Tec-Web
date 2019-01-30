<?php 
include_once 'DBConnection.php';
    /*Utilizzato per le query con output esterni*/
    function executeQuery($query, $parameters, $type ){
        
        global $connection;
        
        if ($stmt = $connection->prepare($query)) {
    
            $params=array_merge($type, $parameters);
            // Bind a variable to the parameter as a string.
            call_user_func_array(array($stmt, "bind_param"), $params);            
            // Execute the statement.
            $stmt->execute();
                
            if($stmt) return $stmt;
            }
            return null;
        }
                   
    /*Ritorna il risultato di una query come tabella con la prima riga = all'intestazione delle colonne*/
    function resultQueryToTable($result){
        
        $table = array();
                
        while ($row = mysqli_fetch_assoc($result)) {
            $table[] = $row;
        }
        
        return $table;
    }


    function printNavbar($currentPage){  
        $nav = implode("",file("../txt/nav.txt"));
        switch ($currentPage) {
            case "esplora":
                $nav = preg_replace("/<!-- refEsplora -->/i", "#", $nav);
                break;

            case "profilo":
                $nav = preg_replace("/<!-- refProfilo -->/i", "#", $nav);
                break;

            case "preferiti":
                $nav = preg_replace("/<!-- refPreferiti -->/i", "#", $nav);
                break;

            case "impostazioni":
                $nav = preg_replace("/<!-- refImpostazioni -->/i", "#", $nav);
                break;

            case "faq":
                $nav = preg_replace("/<!-- refFaq -->/i", "#", $nav);
                break;

            case "supporto":
                $nav = preg_replace("/<!-- refSupporto -->/i", "#", $nav);
                break;

            case "privacy":
                $nav = preg_replace("/<!-- refPrivacy -->/i", "#", $nav);
                break;

            case "about":
                $nav = preg_replace("/<!-- refAbout -->/i", "#", $nav);
                break;
            
            default:
                break;
        }

        $nav = preg_replace("/<!-- refEsplora -->/i", "esplora.php", $nav);
        $nav = preg_replace("/<!-- refProfilo -->/i", "profilo.php", $nav);
        $nav = preg_replace("/<!-- refPreferiti -->/i", "preferiti.php", $nav);
        $nav = preg_replace("/<!-- refImpostazioni -->/i", "impostazioni.php", $nav);
        $nav = preg_replace("/<!-- refFaq -->/i", "faq.php", $nav);
        $nav = preg_replace("/<!-- refSupporto -->/i", "supporto.php", $nav);
        $nav = preg_replace("/<!-- refPrivacy -->/i", "privacy.php", $nav);
        $nav = preg_replace("/<!-- refAbout -->/i", "about.php", $nav);
        return $nav;
    }
    
    function printPageEsplora($output){
        global $connection;
        
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'serie.php?serie_id=';

        $head_page = implode("",file("../txt/pagehead.txt"));
        $genere_page = implode("",file("../txt/genere.txt"));
        $show_page = implode("",file("../txt/show.txt"));
        $query="select distinct id, nome from genere a join serie_genere b on a.id=b.id_genere";
        //Seleziono la lista dei generi già in una tabella
        $generi=resultQueryToTable($connection->query($query));
        $genere_show_collect="<!-- Successivo -->";
        /*if (count($generi)>1) {
         $genere_show_collect=$genere_page;
         }*/
        for ($i = 0; $i < count($generi); $i++) {
            
            $genere_id=$generi[$i]["id"];
            $genere_nome=$generi[$i]["nome"];
            
            $query="select id,miniatura,titolo, consigliato from serie a join serie_genere b on a.id=b.id_serie where b.id_genere=$genere_id";
            //Seleziono la lista delle serie tv di un determinato genere già in una tabella
            $series=resultQueryToTable($connection->query($query));
            
            //Scrivo le serie tv
            $show="<!-- Successiva -->";
            
            /*if (count($series)>1) {
             $show=$show_page;
             }*/
            for ($j = 0; $j < count($series); $j++) {
                
                $show=preg_replace("/<!-- Successiva -->/i",$show_page." <!-- Successiva -->" , $show );
                $show=preg_replace("/<!-- Immagine -->/i",$series[$j]["miniatura"] , $show );
                $show=preg_replace("/<!-- Id -->/i",$series[$j]["id"] , $show );
                $show=preg_replace("/<!-- Titolo -->/i",$series[$j]["titolo"] , $show );
                $show=preg_replace("/<!-- Consigliato -->/i",$series[$j]["consigliato"] , $show );
                $show=preg_replace("/<!-- Url_Show -->/i","http://$host$uri/$extra".$series[$j]["id"] , $show );
                
                
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
        $output = preg_replace("/<!-- Page_Head -->/i", $head_page, $output );
        $output = preg_replace("/<!-- Contenuto_Effettivo -->/i", $genere_show_collect, $output );
        
        return $output;
        
    }
    
    function printPageSerie($output){
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'esplora.php';
        
        if(!array_key_exists('serie_id',$_GET) && empty($_GET['serie_id'])) { 
            /* Redirect to a different page in the current directory that was requested */
            header("Location: http://$host$uri/$extra");
            
        }
        
        global $connection;
        $side_block = implode("",file("../txt/side_bar.txt"));
        $side_serie_block = implode("",file("../txt/serie/side_bar_serie.txt"));
        $attore_block = implode("",file("../txt/serie/attore.txt"));
        $post_block = implode("",file("../txt/serie/post.txt"));
        $serie_block = implode("",file("../txt/serie/serie.txt")); 
        $title = implode("",file("../txt/serie/pagehead_serie.txt"));
        

        //Imposta immagine di background personalizzata

        $query = "select background from serie where id=".$_GET["serie_id"];
        $result = resultQueryToTable($connection->query($query));
        $title = preg_replace("/<--! Url_Back -->/i", $result[0]["background"], $title);
        $output = preg_replace("/<!-- Page_Head -->/i", $title, $output );
        
        //Parte side-bar        
        
        $query="select a.id, a.nome, a.cognome, a.miniatura from attore a join serie_attore b on a.id=b.id_attore where id_serie=?";

        $stmt=executeQuery($query,array(&$_GET["serie_id"]),array("i"));
        $attori=resultQueryToTable($stmt->get_result());
        $stmt->close();
        
        $attore_collect="<!-- Successivo -->";
        
        
        foreach ($attori as $attore) {
            $attore_collect=preg_replace("/<!-- Successivo -->/i",$attore_block." <!-- Successivo -->" , $attore_collect );
            $attore_collect=preg_replace("/<!-- Immagine -->/i",$attore["miniatura"] , $attore_collect );
            $attore_collect=preg_replace("/<!-- Nome_Cognome_Attore -->/i",$attore["nome"]." ".$attore["cognome"] , $attore_collect );      
        }
        $attore_collect=preg_replace("/<!-- Successivo -->/i","" , $attore_collect );
        $side_serie_block=preg_replace("/<!-- Attore -->/i",$attore_collect , $side_serie_block );
        $side_block = preg_replace("/<!-- Side_Bar_Contnent -->/i", $side_serie_block, $side_block );
        $output = preg_replace("/<!-- Side_Bar -->/i", $side_block, $output );
        
        //Titolo, voto e consiglio

        $output = preg_replace("/<!-- Page_Head -->/i", $title, $output );
        $query = "select titolo,voto,consigliato,non_consigliato,preferiti from serie where id=".$_GET["serie_id"];
        $result = resultQueryToTable($connection->query($query));
        $output = preg_replace("/<!-- Titolo -->/i",$result[0]["titolo"] , $output );
        $output = preg_replace("/<!-- Voto -->/i",$result[0]["voto"] , $output );

        if (($result[0]["consigliato"] + $result[0]["non_consigliato"]) == 0)
            $percentuale = 0;
        else
            $percentuale = ($result[0]["consigliato"] / ($result[0]["consigliato"] + $result[0]["non_consigliato"])) * 100;

        $output = preg_replace("/<!-- Percentuale_Consigliati -->/i",$percentuale , $output );

        //Parte centro stagioni ed episodi 
        $query="select miniatura,titolo,distribuzione,descrizione,creatore,consigliato,non_consigliato,voto from serie where id=".$_GET["serie_id"];
        $serie=resultQueryToTable($connection->query($query));
        
        $serie_block=preg_replace("/<!-- Descrizione -->/i",$serie[0]["descrizione"] , $serie_block );
        
        $numero_stagioni=mysqli_fetch_assoc(
            $connection->query(
                "select count(*) as totale_stagioni from (select distinct b.stagione from serie a join episodio b on a.id=b.id_serie
                 where a.id=".$_GET["serie_id"].") as stagioni"
                )
            )["totale_stagioni"];
        
        $stagione_collect="<!-- Successivo -->";
        
        $extra="stagione.php?serie_id="; 
        for ($i = 1; $i <= $numero_stagioni; $i++) {
                
            $link=(string)"http://".$host.$uri."/".$extra.$_GET["serie_id"]."&stagione_numero=".($i);
            $stagione_collect=preg_replace("/<!-- Successivo -->/i","<a href=javascript:episodi('$link') >Stagione".($i)."</a>"." <!-- Successivo -->" , $stagione_collect );
            
            }
        $stagione_collect=preg_replace("/<!-- Successivo -->/i","" , $stagione_collect );
            
        $serie_block=preg_replace("/<!-- Stagione -->/i",$stagione_collect , $serie_block );
        
        $query="select b.id, b.titolo,b.descrizione, b.numero,b.data,b.visualizzato from serie a join episodio b on a.id=b.id_serie where b.stagione=1  and a.id=".$_GET["serie_id"];
        
        $episodi=resultQueryToTable($connection->query($query));

        $episodio_collect="<!-- Successivo -->";
        
        foreach ($episodi as $episodio) {
            $episodio_collect=preg_replace("/<!-- Successivo -->/i", 
            '<tr> '
            .'<td>'.$episodio["numero"].'</td>'
                .'<td><a xml:lang="EN" href="">'.$episodio["titolo"].'</a></td>' //TODO: agggiungere href episodio
            .'<td>'.date("d-m-Y", strtotime($episodio["data"])).'</td>'
            .'<td>'.($episodio["titolo"]==1?'Si':'NO').'</td>'
            .'</tr>'
            .'<!-- Successivo -->'
                , $episodio_collect );
        }
        $episodio_collect=preg_replace("/<!-- Successivo -->/i","" , $episodio_collect );
        $serie_block=preg_replace("/<!-- Episodio -->/i",$episodio_collect, $serie_block );
        
        //parte centro post per ogni serie
        
        $query="select b.testo, c.username from (serie a join post b on a.id=b.id_serie) join utente c on b.id_utente=c.id where a.id=".$_GET["serie_id"];
        $posts=resultQueryToTable($connection->query($query));
        
        $post_collect="<!-- Successivo -->";
        
        foreach ($posts as $post) {
            $post_collect=preg_replace("/<!-- Successivo -->/i",$post_block."<!-- Successivo -->", $post_collect );
            $post_collect=preg_replace("/<!-- Username_Autore -->/i",$post["username"], $post_collect );
            $post_collect=preg_replace("/<!-- Testo -->/i",$post["testo"], $post_collect );
            
            
        }
        $post_collect=preg_replace("/<!-- Successivo -->/i","" , $post_collect );
        $serie_block=preg_replace("/<!-- Post -->/i",$post_collect, $serie_block );
        
        
        $output = preg_replace("/<!-- Nome_Pagina -->/i", "show-page", $output );
        $output = preg_replace("/<!-- Contenuto_Effettivo -->/i", $serie_block, $output );
        
        
        return $output;
        
    }

    function printPageAbout($output){
        global $connection;
        
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

        $head_page = implode("", file("../txt/pagehead.txt"));
        $about = implode("", file("../txt/about.txt"));

        $output = preg_replace("/<!-- Nome_Pagina -->/i", "about", $output );
        $output = preg_replace("/<!-- Page_Head -->/i", $head_page, $output );
        $output = preg_replace("/<!-- Contenuto_Effettivo -->/i", $about , $output );

        return $output;
    }
    
    
    ?>