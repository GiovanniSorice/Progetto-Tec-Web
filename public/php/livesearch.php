
<?php
include_once 'general_function.php';

//get the q parameter from URL
$q=$_GET["q"];

//lookup all links from the xml file if length of q>0

if (strlen($q)>0) {
    $hint="";       
    
    $query="select id, titolo from serie where titolo like concat('%',?,'%')";
    //Seleziono la lista dei generi già in una tabella
    $stmt=executeQuery($query,array(&$q),array("s"));
    $series=resultQueryToTable($stmt->get_result());
    $stmt->close();
    foreach ($series as $serie) {
        //find a link matching the search text
            if ($hint=="") {
                $hint="<a href='" .
                    $serie["id"] .
                    "' target='_blank'>" .
                    $serie["titolo"]. "</a>";
            } else {
                $hint=$hint . "<br /><a href='" .
                    $serie["id"] .
                    "' target='_blank'>" .
                    $serie["titolo"] . "</a>";
            }
    }
}


// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint=="") {
  $response="no suggestion";
} else {
  $response=$hint;
}

//output the response
echo $response;
?> 