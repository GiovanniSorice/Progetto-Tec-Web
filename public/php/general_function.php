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
    function resultQueryToTable($result,$columnName){
        
        $table = array();
        
        $table[0]=$columnName;
        
        while ($row = mysqli_fetch_assoc($result)) {
            $table[] = $row;
        }
        
        return $table;
    }
?>