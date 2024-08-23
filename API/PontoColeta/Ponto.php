<?php
//Criar a lixeira
    //importar o connection
    include("../conection.php");

    //Inforamções da lixeira
    $nome = $_POST["nome"];
    $lat = $_POST["latitude"];
    $long = $_POST["longitude"];
    $desc = $_POST["descricao"];
    $stmt = $cone->prepare("INSERT INTO PontoDeColeta(nome, latitude, longitude, descricao) VALUES (?, ?,?,?)");
    $stmt->bind_param("ssss",$nome, $lat, $long, $desc);
    if ($stmt->execute()) {
        $output = "{\"latitude\" : \"isSuccessful\"}";
    } else {
        $output = "{\"latitude\" : \"vazio\"}";
        
    }
    echo ($output);

//Listar todas as lixeiras
    $result = $cone->query("SELECT * FROM PontoDeColeta");

    $output = "[ ";

    while($linha = $result->fetch_row()){
        $output .= "{";
        $output .= "\"nome\" : \" ".$linha[1]."\" , ";
        $output .= "\"latitude\" : \"".$linha[2]."\" , ";
        $output .= "\"longitude\" : \"".$linha[3]."\" , ";
        $output .= "\"descricao\" : \"".$linha[4]."\"";
        $output .= "},";

    } 

    $output=substr($output,0,strlen($output)-1)." ]";

    echo($output);

//Retorna todos os materias de uma lixeira especifica
    $lat = $_POST["latitude"];
    $long = $_POST["longitude"];

    $result = $cone->query("SELECT * FROM PontoDeColeta WHERE latitude = '$lat' AND longitude = '$long'");
    $linha = $result->fetch_assoc();
    $id_point = $linha["id"];

    $result = $cone->query("SELECT id, id_material, quantidade FROM Controle WHERE id_ponto = '$id_point' AND vazia = 0");

    $output = "[ ";

    while($linha = $result->fetch_row()){
        $categoria_result = $cone->query("SELECT material FROM Materiais WHERE id = '$linha[1]'");
        $categoria = $categoria_result->fetch_assoc();
        
        $output .= "{";
        $output .= "\"id\" : ".$linha[0].",";
        $output .= "\"material\" : \"".$categoria["material"]."\",";
        $output .= "\"quantidade\" : ".$linha[2];
        $output .= "},";
    } 

    $output=substr($output,0,strlen($output)-1)." ]";

    echo($output);

//Insere os dados na tabela N:N Controller

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

//Altera a linha da controller para tornala vazia e inserir id do catador, data e hora da retirada

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
