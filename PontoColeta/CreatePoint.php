<?php

include("../conection.php");


$nome = $_POST["nome"];
$lat = $_POST["latitude"];
$long = $_POST["longitude"];
$desc = $_POST["descricao"];

$stmt = $cone->prepare("INSERT INTO PontoDeColeta(nome, latitude, longitude, descricao) VALUES (?, ?,?,?)");
$stmt->bind_param("ssss",$nome, $lat, $long, $desc);

if ($stmt->execute()) {
    // ALTEREI JSON DAQUI, ALTERAR NO ANDROID STUDIO
    $output = "{\"latitude\" : \"isSuccessful\"}";
} else {
    $output = "{\"longitude\" : \"vazio\"}";
    
}

echo ($output);
