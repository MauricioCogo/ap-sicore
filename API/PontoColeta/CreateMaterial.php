<?php

include("../conection.php");

$cpf = $_POST["cpf"];
$lat = $_POST["latitude"];
$long = $_POST["longitude"];
$material = $_POST["material"];

$qnt = $_POST["quantidade"];
date_default_timezone_set("America/Sao_Paulo");
$data_en = date("d/m/Y");
$hora_en = date("h:i:sa");
$vazia = 0;

$result = $cone->query("SELECT * FROM Usuarios WHERE cpf = '$cpf' AND Ativo = 1");
$linha = $result->fetch_assoc();
$id_dep = $linha["id"];

$result = $cone->query("SELECT * FROM PontoDeColeta WHERE latitude = '$lat' AND longitude = '$long'");
$linha = $result->fetch_assoc();
$id_point = $linha["id"];

$result = $cone->query("SELECT id FROM Materiais WHERE material = '$material'");
$linha = $result->fetch_assoc();
$id_mat = $linha["id"];


$stmt = $cone->prepare("INSERT INTO Controle(id_depositor, id_ponto, id_material, quantidade, data_entrada, hora_entrada, vazia) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("iiiissi", $id_dep, $id_point, $id_mat, $qnt, $data_en, $hora_en, $vazia);

if ($stmt->execute()) {
    //COLOCAR CONTROLERMATERIAL NO ANDROID
    $output = "{\"nome\" : \"isSuccessful\"}";
} else {
    $output = "{\"nome\" : \"vazio\"}";
    echo($cone->error);
}

echo ($output);
