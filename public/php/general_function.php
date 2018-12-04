<?php 
include_once 'DBConnection.php';
function executeQuery($connection,$query, $parameters, $type ){
    if ($stmt = $connection->prepare($query)) {

        $params=array_merge($type, $parameters);
        // Bind a variable to the parameter as a string.
        call_user_func_array(array($stmt, "bind_param"), $params);            
        // Execute the statement.
        $stmt->execute();
            
        // Return the result of the query in a statement
        $finded=$stmt->get_result();
            
        $stmt->close();
            
        if($finded) return $finded;
        }
        return null;
    }
?>