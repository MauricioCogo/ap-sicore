<?php
include("../conection.php");

$cpf = $_POST["cpf"];
$senha = $_POST["senha"];

$sql = "SELECT * FROM Usuarios WHERE cpf = '$cpf' AND senha = '$senha' AND Ativo = 1";

$result = mysqli_query($cone, $sql);
if (mysqli_num_rows($result) > 0) {
	$output = "{
			\"cpf\" : \"" . $cpf . "\",
			\"senha\" : \"" . $senha . "\"}";
} else {
	$output = "{
		\"cpf\" : \"vazio\",
		\"senha\" : \"vazio\"}";
}

echo $output;

exit;
