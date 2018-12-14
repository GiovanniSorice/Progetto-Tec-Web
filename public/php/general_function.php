<?php 
include_once 'DBConnection.php';
    /*Utilizzato per le query con output esterni*/
    function executeQuery($connection,$query, $parameters, $type ){
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
    
    function printPageEsplora($output){
        global $connection;
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
            
            $query="select id,immagine,titolo, consigliato from serie a join serie_genere b on a.id=b.id_serie where b.id_genere=$genere_id";
            //Seleziono la lista delle serie tv di un determinato genere già in una tabella
            $series=resultQueryToTable($connection->query($query));
            
            //Scrivo le serie tv
            $show="<!-- Successiva -->";
            
            /*if (count($series)>1) {
             $show=$show_page;
             }*/
            for ($j = 0; $j < count($series); $j++) {
                
                $show=preg_replace("/<!-- Successiva -->/i",$show_page." <!-- Successiva -->" , $show );
                $show=preg_replace("/<!-- Immagine -->/i",$series[$j]["immagine"] , $show );
                $show=preg_replace("/<!-- Id -->/i",$series[$j]["id"] , $show );
                $show=preg_replace("/<!-- Titolo -->/i",$series[$j]["titolo"] , $show );
                $show=preg_replace("/<!-- Consigliato -->/i",$series[$j]["consigliato"] , $show );
                
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
        
        return $output;
        
    }
    
    ?>