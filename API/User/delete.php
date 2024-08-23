<?php

include("../conection.php");


$cpf = $_POST["cpf"];
$senha = $_POST["senha"];

$sql = "update Usuarios set Ativo = 0 where cpf = '$cpf' and senha = '$senha'";
$result = $cone->query($sql);

if ($cone->affected_rows==1){
	$output = "{
		\"cpf\" : \"sucesso\"}";
}else{
	$output = "{
	\"cpf\" : \"vazio\"}";
	}

echo $output;


echo $output;
exit;
