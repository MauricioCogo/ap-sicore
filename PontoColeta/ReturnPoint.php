<?php

include("../conection.php");

$result = $cone->query("SELECT * FROM PontoDeColeta");

$output = "[ ";

while($linha = $result->fetch_row()){
    //id da lixeira = $linha[0]
    //material = $categoria["categoria"]
    //quantidade = $linha[2]

    $output .= "{";
    $output .= "\"nome\" : \" ".$linha[1]."\" , ";
    $output .= "\"latitude\" : \"".$linha[2]."\" , ";
    $output .= "\"longitude\" : \"".$linha[3]."\" , ";
    $output .= "\"descricao\" : \"".$linha[4]."\"";
    $output .= "},";

} 

$output=substr($output,0,strlen($output)-1)." ]";

echo($output);
?>
