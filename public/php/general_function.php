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
                $nav = preg_replace("/refEsplora/i", "selezionato", $nav);
                break;

            case "profilo":
                $nav = preg_replace("/refProfilo/i", "selezionato", $nav);
                break;

            case "preferiti":
                $nav = preg_replace("/refPreferiti/i", "selezionato", $nav);
                break;

            case "impostazioni":
                $nav = preg_replace("/refImpostazioni/i", "selezionato", $nav);
                break;

            case "faq":
                $nav = preg_replace("/refFaq/i", "selezionato", $nav);
                break;

            case "supporto":
                $nav = preg_replace("/refSupporto/i", "selezionato", $nav);
                break;

            case "privacy":
                $nav = preg_replace("/refPrivacy/i", "selezionato", $nav);
                break;

            case "about":
                $nav = preg_replace("/refAbout/i", "selezionato", $nav);
                break;

            case "home":
                $nav = preg_replace("/refHome/i", "#", $nav);
                break;
            
            default:
                break;
        }

        $nav = preg_replace("/refEsplora/i", "", $nav);
        $nav = preg_replace("/refProfilo/i", "", $nav);
        $nav = preg_replace("/refPreferiti/i", "", $nav);
        $nav = preg_replace("/refImpostazioni/i", "", $nav);
        $nav = preg_replace("/refFaq/i", "", $nav);
        $nav = preg_replace("/refSupporto/i", "", $nav);
        $nav = preg_replace("/refPrivacy/i", "", $nav);
        $nav = preg_replace("/refAbout/i", "", $nav);
        $nav = preg_replace("/refHome/i", "home.php", $nav);

        return $nav;
    }


    function printPageHome($output){
        global $connection;
        
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'serie.php?serie_id=';

        $head_page = implode("", file("../txt/pagehead.txt"));
        $home = implode("", file("../txt/home.txt"));
        $show = implode("", file("../txt/show_home.txt"));

        $output = preg_replace("/<!-- Nome_Pagina -->/i", "home", $output );
        $output = preg_replace("/<!-- Page_Head -->/i", $head_page, $output );


        $query="select id,titolo,miniatura,descrizione,consigliato,non_consigliato, CAST((consigliato)/(consigliato+non_consigliato)*100 AS int) AS perc_consigliato from serie order by perc_consigliato DESC LIMIT 3";
            //Seleziono la lista delle serie tv del momento
            $shows=resultQueryToTable($connection->query($query));
            
            //Scrivo le serie tv
            $show_collect ="<!-- Successiva -->";
            $first = 1;

            foreach ($shows as $shows) {
                $show_collect=preg_replace("/<!-- Successiva -->/i",$show." <!-- Successiva -->" , $show_collect );
                $show_collect=preg_replace("/<!-- Immagine -->/i",$shows["miniatura"] , $show_collect );
                $show_collect=preg_replace("/<!-- Titolo -->/i",$shows["titolo"] , $show_collect );
                $show_collect=preg_replace("/<!-- Descrizione -->/i",$shows["descrizione"] , $show_collect );
                $show_collect=preg_replace("/<!-- Consigliato -->/i", $shows["perc_consigliato"] , $show_collect );
                $show_collect=preg_replace("/<!-- Url_Show -->/i","http://$host$uri/$extra".$shows["id"] , $show_collect );  
                if($first == 1){
                    $show_collect=preg_replace("/<!-- Div_Consigliati -->/i", "<div class=\"consigliati__show\" id=\"first-show-anchor\">" , 
                        $show_collect );
                    $first = 0;
                }
                else{
                    $show_collect=preg_replace("/<!-- Div_Consigliati -->/i", "<div class=\"consigliati__show\">" , 
                        $show_collect );
                }
            }
            $show=preg_replace("/<!-- Successiva -->/i","" , $show );
            $output = preg_replace("/<!-- Contenuto_Effettivo -->/i", $home , $output );
            $output = preg_replace("/<!-- Titoli_Momento -->/i" , $show_collect , $output);
            
            if(array_key_exists('user_username',$_SESSION) && !empty($_SESSION['user_username'])){
                $output = preg_replace("/<!-- Registrati -->/i", "" , $output );
            }
            else{
                $Registrati =  
                "<div class=\"iscriviti\">
                    <p>
                        Per interagire con la community, per votare le tue serie TV preferite e molto altro <a href=\"signup.php\" title=\"registrati\">REGISTRATI</a> oppure <a href=\"login.php\" title=\"accedi\">EFFETTUA IL <span lang=\"EN\">LOGIN</span></a>
                    </p>
                </div>";
                $output = preg_replace("/<!-- Registrati -->/i", $Registrati , $output );
            }

        return $output;
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
            $genere_show_collect=preg_replace("/<!-- Mostra_Tutto_Genere -->/i",'<a href="http://'.$host.$uri.'/genere.php?genere_id='.$genere_id.'"><h3 id="mostra-tutto">mostra tutto</h3></a>' , $genere_show_collect );
            $genere_show_collect=preg_replace("/<!-- Genere_Titolo -->/i",$genere_nome , $genere_show_collect );
            $genere_show_collect=preg_replace("/<!-- Show -->/i",$show , $genere_show_collect );
            
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
        $extra2 = 'preferiti_action.php?serie_id=';
        $extra3 = 'rimuoviPref_action.php?serie_id=';
        $extra4 = 'consigliati_action.php?serie_id=';
        $extra5 = 'rimuoviCons_action.php?serie_id=';
        $extra6 = 'modificaCons_action.php?consigliato=';
        
        
        if(!array_key_exists('serie_id',$_GET) && empty($_GET['serie_id'])) { 
            /* Redirect to a different page in the current directory that was requested */
            header("Location: http://$host$uri/$extra");
        }
        
        $_SESSION['serie_id']=$_GET['serie_id'];
        
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



        if(array_key_exists('user_username',$_SESSION) && !empty($_SESSION['user_username'])){
            $id_utente = $_SESSION["user_id"];
            $query = "select * from preferiti where id_serie=".$_GET["serie_id"]." and id_utente=".$id_utente;
            $isPreferito = resultQueryToTable($connection->query($query));
            if(empty($isPreferito)){
                $side_serie_block=preg_replace("/<!-- Add-Rem -->/i", "Aggiungi ai preferiti" , $side_serie_block );
                $side_serie_block=preg_replace("/<!-- Add_Preferitio -->/i", "http://$host$uri/$extra2".$_GET["serie_id"] , 
                $side_serie_block );
            }
            else{
                $side_serie_block=preg_replace("/<!-- Add-Rem -->/i", "Rimuovi dai preferiti" , $side_serie_block );
                $side_serie_block=preg_replace("/<!-- Add_Preferitio -->/i", "http://$host$uri/$extra3".$_GET["serie_id"] , 
                $side_serie_block );
            }


            $query = "select * from consiglio where id_serie=".$_GET["serie_id"]." and id_utente=".$id_utente;
            $isPresent = resultQueryToTable($connection->query($query));
            if(empty($isPresent)){
                $side_serie_block=preg_replace("/<!-- Consigliato -->/i", "http://$host$uri/$extra4".$_GET["serie_id"]."&consigliato=1" , $side_serie_block );
                $side_serie_block=preg_replace("/<!-- Sconsigliato -->/i", "http://$host$uri/$extra4".$_GET["serie_id"]."&consigliato=0" , $side_serie_block );
            }
            else{
                $query = "select * from consiglio where id_serie=".$_GET["serie_id"]." and id_utente=".$id_utente." and consigliato=1";
                $isConsigliato = resultQueryToTable($connection->query($query));

                if(empty($isConsigliato)){
                    $side_serie_block=preg_replace("/<!-- Scons_Color -->/i", "#fac100" , $side_serie_block );
                    $side_serie_block=preg_replace("/<!-- Consigliato -->/i", "http://$host$uri/$extra6"."1"."&serie_id=".$_GET["serie_id"] , $side_serie_block );
                    $side_serie_block=preg_replace("/<!-- Sconsigliato -->/i", "http://$host$uri/$extra5".$_GET["serie_id"] , 
                        $side_serie_block );
                }
                else{
                    $side_serie_block=preg_replace("/<!-- Cons_Color -->/i", "#fac100" , $side_serie_block );
                    $side_serie_block=preg_replace("/<!-- Consigliato -->/i", "http://$host$uri/$extra5".$_GET["serie_id"] , 
                        $side_serie_block );
                    $side_serie_block=preg_replace("/<!-- Sconsigliato -->/i", "http://$host$uri/$extra6"."0"."&serie_id=".
                        $_GET["serie_id"] , $side_serie_block );
                }
            }
        }
        else{
            $side_serie_block=preg_replace("/<!-- Add-Rem -->/i", "Aggiungi ai preferiti" , $side_serie_block );
            $side_serie_block=preg_replace("/<!-- Add_Preferitio -->/i", "http://$host$uri/login.php", $side_serie_block );

            $side_serie_block=preg_replace("/<!-- Consigliato -->/i", "http://$host$uri/login.php" , $side_serie_block );
            $side_serie_block=preg_replace("/<!-- Sconsigliato -->/i", "http://$host$uri/login.php" , $side_serie_block );
        }

        $side_serie_block=preg_replace("/<!-- Attore -->/i",$attore_collect , $side_serie_block );
        $side_block = preg_replace("/<!-- Side_Bar_Contnent -->/i", $side_serie_block, $side_block );
        $output = preg_replace("/<!-- Side_Bar -->/i", $side_block, $output );
        
        //Titolo, voto e consiglio

        $output = preg_replace("/<!-- Page_Head -->/i", $title, $output );
        $query = "select titolo,voto,consigliato,non_consigliato,preferiti,CAST((consigliato)/(consigliato+non_consigliato)*100 AS int) AS perc_consigliato from serie where id=".$_GET["serie_id"];
        $result = resultQueryToTable($connection->query($query));
        $output = preg_replace("/<!-- Titolo -->/i",$result[0]["titolo"] , $output );
        $output = preg_replace("/<!-- Voto -->/i",$result[0]["voto"] , $output );

        if ($result[0]["perc_consigliato"] > 0)
            $output = preg_replace("/<!-- Percentuale_Consigliati -->/i",$result[0]["perc_consigliato"] , $output );
        else
            $output = preg_replace("/<!-- Percentuale_Consigliati -->/i", '0' , $output );

        

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
            $stagione_collect=preg_replace("/<!-- Successivo -->/i","<a href=\"javascript:episodi('$link')\" >Stagione".($i)."</a>"." <!-- Successivo -->" , $stagione_collect );
            $stagione_collect=preg_replace("/<!-- SuccessivoNS -->/i","<a href='$link' >Stagione".($i)."</a>"." <!-- SuccessivoNS -->" , $stagione_collect );           
            }
        $stagione_collect=preg_replace("/<!-- Successivo -->/i","" , $stagione_collect );
            
        $serie_block=preg_replace("/<!-- Stagione -->/i",$stagione_collect , $serie_block );
        
        $stagione_collect="<!-- Successivo -->";
        
        $extra="serie.php?serie_id=";
        for ($i = 1; $i <= $numero_stagioni; $i++) {
            
            $link=(string)"http://".$host.$uri."/".$extra.$_GET["serie_id"]."&stagione_numero=".($i);
            $stagione_collect=preg_replace("/<!-- Successivo -->/i","<a href='$link' >Stagione".($i)."</a>"." <!-- Successivo -->" , $stagione_collect );
        }
        $stagione_collect=preg_replace("/<!-- Successivo -->/i","" , $stagione_collect );
        
        $serie_block=preg_replace("/<!-- StagioneNS -->/i",$stagione_collect , $serie_block );
        
        if(array_key_exists('stagione_numero',$_GET) && !empty($_GET['stagione_numero'])){
            $query="select b.id, b.titolo,b.descrizione, b.numero,b.data,b.visualizzato from serie a join episodio b on a.id=b.id_serie where b.stagione=?  and a.id=?";
            $stmt=executeQuery($query,array(&$_GET['stagione_numero'],&$_GET['serie_id']),array("ss"));
            
        }else{
            $query="select b.id, b.titolo,b.descrizione, b.numero,b.data,b.visualizzato from serie a join episodio b on a.id=b.id_serie where b.stagione=1  and a.id=?";
            $stmt=executeQuery($query,array(&$_GET['serie_id']),array("s"));
            
        }
        $episodi=resultQueryToTable($stmt->get_result());
        $stmt->close();
        $episodio_collect="<!-- Successivo -->";
        
        foreach ($episodi as $episodio) {
            $episodio_collect=preg_replace("/<!-- Successivo -->/i", 
            '<tr> '
            .'<td>'.$episodio["numero"].'</td>'
                .'<td><a lang="EN" href="">'.$episodio["titolo"].'</a></td>' //TODO: aggiungere href episodio
            .'<td>'.date("d-m-Y", strtotime($episodio["data"])).'</td>'
            .'<td>'.($episodio["titolo"]==1?'Si':'NO').'</td>'
            .'</tr>'
            .'<!-- Successivo -->'
                , $episodio_collect );
        }
        $episodio_collect=preg_replace("/<!-- Successivo -->/i","" , $episodio_collect );
        $serie_block=preg_replace("/<!-- Episodio -->/i",$episodio_collect, $serie_block );
        
        //parte centro post per ogni serie
        
        
        if(!array_key_exists('user_id',$_SESSION) && empty($_SESSION['user_id'])){
            
            $query="select b.id, b.testo, c.username from (serie a join post b on a.id=b.id_serie) join utente c on b.id_utente=c.id where a.id=".$_GET["serie_id"]." and b.id not in 
            (select id_ref from segnalazione where tipo=1)";
        }else{
            $query="select b.id, b.testo, c.username from (serie a join post b on a.id=b.id_serie) join utente c on b.id_utente=c.id where a.id=".$_GET["serie_id"]." and b.id not in
            (select id_ref from segnalazione where tipo=1 and id_utente=".$_SESSION["user_id"].")";            
        }
        $posts=resultQueryToTable($connection->query($query));
        
        $post_collect="<!-- Successivo -->";
        
        foreach ($posts as $post) {
            $post_collect=preg_replace("/<!-- Successivo -->/i",$post_block."<!-- Successivo -->", $post_collect );
            $post_collect=preg_replace("/<!-- Username_Autore -->/i",$post["username"], $post_collect );
            $post_collect=preg_replace("/<!-- Testo -->/i",$post["testo"], $post_collect );
            $post_collect=preg_replace("/<!-- Segnala -->/i","http://$host$uri/segnala_action.php?post_id=".$post["id"], $post_collect );
            
            
        }
        $post_collect=preg_replace("/<!-- Successivo -->/i","" , $post_collect );
        $serie_block=preg_replace("/<!-- Post -->/i",$post_collect, $serie_block );
        
        
        $output = preg_replace("/<!-- Nome_Pagina -->/i", "show-page", $output );
        $output = preg_replace("/<!-- Contenuto_Effettivo -->/i", $serie_block, $output );
        
        
        return $output;
        
    }

    function printPagePreferiti($output){

        global $connection;

        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'serie.php?serie_id=';

        $head_page = implode("", file("../txt/pagehead.txt"));
        $output = preg_replace("/<!-- Nome_Pagina -->/i", "preferiti", $output );
        $output = preg_replace("/<!-- Page_Head -->/i", $head_page, $output );
        $preferiti = implode("", file("../txt/preferiti.txt"));
        
        if(array_key_exists('user_username',$_SESSION) && !empty($_SESSION['user_username'])){

            $show = implode("", file("../txt/show_preferiti.txt"));

            $id_utente = $_SESSION["user_id"];

            $query="select distinct serie.id,serie.titolo,serie.miniatura from (serie JOIN preferiti ON serie.id = preferiti.id_serie) JOIN utente ON utente.id = preferiti.id_utente and utente.id=".$id_utente;

            $shows=resultQueryToTable($connection->query($query));

            $show_collect ="<!-- Successiva -->";

            foreach ($shows as $shows) {
                $show_collect=preg_replace("/<!-- Successiva -->/i",$show." <!-- Successiva -->" , $show_collect );
                $show_collect=preg_replace("/<!-- Immagine -->/i",$shows["miniatura"] , $show_collect );
                $show_collect=preg_replace("/<!-- Titolo -->/i",$shows["titolo"] , $show_collect );
                $show_collect=preg_replace("/<!-- Url_Show -->/i","http://$host$uri/$extra".$shows["id"] , $show_collect );  
            }

            $show=preg_replace("/<!-- Successiva -->/i","" , $show );
            $output = preg_replace("/<!-- Contenuto_Effettivo -->/i", $preferiti , $output );
            $output = preg_replace("/<!-- Registrati -->/i", "" , $output );
            $output = preg_replace("/<!-- Preferiti_Show -->/i" , $show_collect , $output);

        }

        else{
                $Registrati =  
                "<div class=\"iscriviti\">
                    <p>
                        Per vedere l'elenco delle tue serie TV preferite <a href=\"signup.php\" title=\"registrati\">REGISTRATI</a> oppure <a href=\"login.php\" title=\"accedi\">EFFETTUA IL <span lang=\"EN\">LOGIN</span></a>
                    </p>
                </div>";

            $preferiti = preg_replace("/<!-- Registrati -->/i", $Registrati , $preferiti );
            $output = preg_replace("/<!-- Contenuto_Effettivo -->/i", $preferiti , $output );
        }

        return $output;  
    }

    function printPageProfilo($output){

        global $connection;

        $host  = $_SERVER['HTTP_HOST'];

        $head_page = implode("", file("../txt/pagehead.txt"));
        $output = preg_replace("/<!-- Nome_Pagina -->/i", "profilo", $output );
        $output = preg_replace("/<!-- Page_Head -->/i", $head_page, $output );
        $profilo = implode("", file("../txt/profilo.txt"));
        
        if(array_key_exists('user_username',$_SESSION) && !empty($_SESSION['user_username'])){

            $id_utente = $_SESSION["user_id"];

            $query="select foto_profilo, nome, cognome, data_nascita, email, username from utente WHERE id = ".$id_utente."";

            $info=resultQueryToTable($connection->query($query));

            $profilo=preg_replace("/<!-- Foto -->/i",$info[0]["foto_profilo"] , $profilo );
            $profilo=preg_replace("/<!-- Nome -->/i", $info[0]["nome"] , $profilo );
            $profilo=preg_replace("/<!-- Cognome -->/i", $info[0]["cognome"] , $profilo );
            $datanascita= date("d-m-Y",strtotime($info[0]["data_nascita"]));
            $profilo=preg_replace("/<!-- Data -->/i", $datanascita , $profilo );
            $profilo=preg_replace("/<!-- User -->/i", $info[0]["username"] , $profilo );
            $profilo=preg_replace("/<!-- Email -->/i", $info[0]["email"] , $profilo );


            $output = preg_replace("/<!-- Registrati -->/i", "" , $output );
            $output = preg_replace("/<!-- Contenuto_Effettivo -->/i", $profilo , $output );
        }

        else{
                $Registrati =  
                "<div class=\"iscriviti\">
                    <p>
                        Per accedere alla tua area personale <a href=\"signup.php\" title=\"registrati\">REGISTRATI</a> oppure <a href=\"login.php\" title=\"accedi\">EFFETTUA IL <span lang=\"EN\">LOGIN</span></a>
                    </p>
                </div>";

            $profilo = preg_replace("/<!-- Registrati -->/i", $profilo , $Registrati );
            $output = preg_replace("/<!-- Contenuto_Effettivo -->/i", $profilo , $output );
        }

        return $output;  
    }


    function printPagePrivacy($output){
        global $connection;
        
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

        $head_page = implode("", file("../txt/pagehead.txt"));
        $privacy = implode("", file("../txt/privacy.txt"));

        $output = preg_replace("/<!-- Nome_Pagina -->/i", "privacy", $output );
        $output = preg_replace("/<!-- Page_Head -->/i", $head_page, $output );
        $output = preg_replace("/<!-- Contenuto_Effettivo -->/i", $privacy , $output );

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

    function printPageLogin($output){
        global $connection;
        
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        
        $head_page = implode("", file("../txt/pagehead.txt"));
        $login = implode("", file("../txt/login.txt"));
        
        $output = preg_replace("/<!-- Nome_Pagina -->/i", "login", $output );
        $output = preg_replace("/<!-- Page_Head -->/i", $head_page, $output );
        if(array_key_exists('errore_login',$_SESSION) && !empty($_SESSION['errore_login'])){
            $login = preg_replace("/<!-- Errore -->/i", "Errore login, reinserisci i dati. ", $login );
            unset($_SESSION['errore_login']);
        }
        
        
        $output = preg_replace("/<!-- Contenuto_Effettivo -->/i", $login , $output );
        
        return $output;
    }
    
    function printPageSignUp($output){
        global $connection;
        
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        
        $head_page = implode("", file("../txt/pagehead.txt"));
        $signup = implode("", file("../txt/signup.txt"));
        
        $output = preg_replace("/<!-- Nome_Pagina -->/i", "signup", $output );
        $output = preg_replace("/<!-- Page_Head -->/i", $head_page, $output );
        
        if(array_key_exists('errore_signup',$_SESSION) && !empty($_SESSION['errore_signup'])){
            $signup = preg_replace("/<!-- Errore -->/i", "Usename gi&agrave; in uso, cambiare username. ", $signup );
            unset($_SESSION['errore_signup']);
        }
        $output = preg_replace("/<!-- Contenuto_Effettivo -->/i", $signup , $output );
        
        return $output;
    }
    
    function printPageGenere($output){
        global $connection;
        
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'serie.php?serie_id=';
        
        $head_page = implode("", file("../txt/pagehead.txt"));
        $genere_page = implode("",file("../txt/genere.txt"));
        $show_page = implode("",file("../txt/show.txt"));
        $query="select distinct id, nome from genere where id=".$_GET["genere_id"];
        //Seleziono la lista dei generi già in una tabella
        $generi=resultQueryToTable($connection->query($query));
        if(count($generi)<=0){
            $output = preg_replace("/<!-- Nome_Pagina -->/i", "genere", $output );
            $output = preg_replace("/<!-- Page_Head -->/i", $head_page, $output );
            $output = preg_replace("/<!-- Contenuto_Effettivo -->/i", "Nessun genere esistente", $output );
            
            return $output;
        }
        $genere_show_collect="<!-- Successivo -->";
        
            $genere_id=$generi[0]["id"];
            $genere_nome=$generi[0]["nome"];
            
            $query="select id,miniatura,titolo, consigliato from serie a join serie_genere b on a.id=b.id_serie where b.id_genere=$genere_id";
            //Seleziono la lista delle serie tv di un determinato genere già in una tabella
            $series=resultQueryToTable($connection->query($query));
            
            //Scrivo le serie tv
            $show="<!-- Successiva -->";
            
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
            
        $genere_show_collect=preg_replace("/<!-- Successivo -->/i","" , $genere_show_collect );
        
        $output = preg_replace("/<!-- Nome_Pagina -->/i", "genere", $output );
        $output = preg_replace("/<!-- Page_Head -->/i", $head_page, $output );
        $output = preg_replace("/<!-- Contenuto_Effettivo -->/i", $genere_show_collect, $output );
        
        return $output;
        }

        function printPage404($output){
        global $connection;
        
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

        $head_page = implode("", file("../txt/pagehead.txt"));
        $error = implode("", file("../txt/404.txt"));

        $output = preg_replace("/<!-- Nome_Pagina -->/i", "404", $output );
        $output = preg_replace("/<!-- Page_Head -->/i", $head_page, $output );
        $output = preg_replace("/<!-- Contenuto_Effettivo -->/i", $error , $output );

        return $output;
    }
    
    ?>