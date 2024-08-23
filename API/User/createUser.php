<?php

include("../conection.php");

$stmt = $cone->prepare("INSERT INTO Usuarios(cpf, nome, senha, email, tipo, Numero_Celular, Data_Nascimento, Ativo) VALUES (?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssssi", $cpf, $nome, $senha, $email, $tipo, $numphone, $datanasc, $status);

	if ($stmt->execute()) {	
		$output = "{\"cpf\" : \"" . $cpf . "\"}";
	} else {
		$output = "{\"cpf\" : \"vazio\"}";
		echo($cone->error);
	}

echo ($output);
