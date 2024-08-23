<?php

include("../conection.php");

$lat = $_POST["latitude"];
$long = $_POST["longitude"];

$result = $cone->query("SELECT * FROM PontoDeColeta WHERE latitude = '$lat' AND longitude = '$long'");
$linha = $result->fetch_assoc();
$id_point = $linha["id"];

$result = $cone->query("SELECT id, id_material, quantidade FROM Controle WHERE id_ponto = '$id_point' AND vazia = 0");

$output = "[ ";

while($linha = $result->fetch_row()){
    $categoria_result = $cone->query("SELECT material FROM Materiais WHERE id = '$linha[1]'");
    $categoria = $categoria_result->fetch_assoc();

    //id da lixeira = $linha[0]
    //material = $categoria["categoria"]
    //quantidade = $linha[2]

    $output .= "{";
    $output .= "\"id\" : ".$linha[0].",";
    $output .= "\"material\" : \"".$categoria["material"]."\",";
    $output .= "\"quantidade\" : ".$linha[2];
    $output .= "},";

} 

$output=substr($output,0,strlen($output)-1)." ]";

echo($output);
?>
