<?php
include("../conection.php");

$cpf = $_POST["cpf"];
$senha = $_POST["senha"];
$novasenha = $_POST["novasenha"];

$sql = "UPDATE Usuarios set senha = '$novasenha' where cpf = '$cpf' and senha = '$senha'";

if ($cone->query($sql) === TRUE) {
	$output = "{
			\"cpf\" : \"sucesso\"}";
} else {
	$output = "{
		\"cpf\" : \"vazio\"}";
}

echo $output;

exit;
