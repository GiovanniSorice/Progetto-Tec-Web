<?php

include_once 'general_function.php';

//get the q parameter from URL
$serie_id=$_GET["serie_id"];
$stagione_numero=$_GET["stagione_numero"];
//lookup all links from the xml file if length of q>0


$hint="";

$query="select b.id, b.titolo,b.descrizione, b.numero,b.data,b.visualizzato from serie a join episodio b on a.id=b.id_serie where b.stagione=?  and a.id=?";

$stmt=executeQuery($query,array(&$stagione_numero,&$serie_id),array("ii"));
$episodi=resultQueryToTable($stmt->get_result());
$stmt->close();

$episodio_collect="<tbody>
                        <tr>
							<th>Numero Episodio</th>
							<th>Nome Episodio</th>
							<th>Data Rilascio</th>
							<th>Visto</th>
						</tr>"."<!-- Successivo -->";

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
$episodio_collect=$episodio_collect."</tbody>";


//output the response
echo $episodio_collect;
?>