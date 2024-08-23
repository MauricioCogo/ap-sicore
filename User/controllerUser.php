<!-- Recebe os dados dos usuarios do Android Studio -->
<?php

	$cpf = $_POST["cpf"];
	$nome = $_POST["nome"];
	$senha = $_POST["senha"];
    $confSenha = $_POST["confSenha"];
	$email = $_POST["email"];
	$confEmail = $_POST["confEmail"];
	$tipo = $_POST["tipo"];
	$datanasc = $_POST["dataNasc"];
	$numphone = $_POST["numPhone"];
	$status = '1';

	$rua = $_POST["rua"];
	$numero = $_POST["numero"];
	$cidade = $_POST["cidade"];
	$estado = $_POST["estado"];
	$pais = $_POST["pais"];	
	$cep = $_POST["cep"];

    include("createUser.php");
    
    include("createAddress.php");
?>

