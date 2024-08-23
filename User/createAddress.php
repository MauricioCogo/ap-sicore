<?php

$result = $cone->query("SELECT * FROM usuarios WHERE cpf = '$cpf'");
$linha = $result->fetch_assoc();
$id = $linha["id"];

$stmt = $cone->prepare("INSERT INTO Enderecos(id_usuario,rua, numero, cidade, estado, pais, cep) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("issssss", $id, $rua, $numero, $cidade, $estado, $pais, $cep);

$stmt->execute();


$cone->close();
