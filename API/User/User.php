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

    include("../conection.php");
    
        //Arquvio connection.php
        $host = "127.0.0.1";
        $name = "root";
        $pass = "";
        $database = "SICORE";
        try{
            $cone = new mysqli($host,$name,$pass,$database);
        }
        catch(Exception $e){
            echo("Error: ".$e);
        }

    include("createUser.php"); 
        //Arquvio CreateUser.php
        $stmt = $cone->prepare("INSERT INTO Usuarios(cpf, nome, senha, email, tipo, Numero_Celular, Data_Nascimento, Ativo) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssi", $cpf, $nome, $senha, $email, $tipo, $numphone, $datanasc, $status);
        
            if ($stmt->execute()) {	
                $output = "{\"cpf\" : \"" . $cpf . "\"}";
            } else {
                $output = "{\"cpf\" : \"vazio\"}";
                echo($cone->error);
            }
        
        echo ($output);
    
    include("createAddress.php");
        //Arquvio CreatAddress.php
        $result = $cone->query("SELECT * FROM usuarios WHERE cpf = '$cpf'");
        $linha = $result->fetch_assoc();
        $id = $linha["id"];
        
        $stmt = $cone->prepare("INSERT INTO Enderecos(id_usuario,rua, numero, cidade, estado, pais, cep) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("issssss", $id, $rua, $numero, $cidade, $estado, $pais, $cep);
        
        $stmt->execute();

        //Arquvio ReadUser.php
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

        //Arquvio UpdateUser.php
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
        
        //Arquvio DeleteUser.php
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



