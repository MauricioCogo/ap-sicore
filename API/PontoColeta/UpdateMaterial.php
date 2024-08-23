<?php

include("../conection.php");

$id_lixeira = $_POST["id_lixeira"];
$cpf = $_POST["cpf"];
date_default_timezone_set("America/Sao_Paulo");
$data_ret = date("Ymd");
$hora_ret = date("h:i:sa");

$result = $cone->query("SELECT * FROM Usuarios WHERE cpf = '$cpf'");
$linha = $result->fetch_assoc();
$id_cat = $linha["id"];

$sql = "UPDATE Controle SET id_catador = '$id_cat', vazia = 1, data_retirada = '$data_ret', hora_retirada = '$hora_ret' WHERE id_ponto = '$id_lixeira'";
$result = $cone->query($sql);

if ($cone->query($sql) === TRUE){
    $output = "{\"cpf\" : \"isSuccessful\"}";
} else {
    $output = "{\"cpf\" : \"vazio\"}";
}
echo ($output);
