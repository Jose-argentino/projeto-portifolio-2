<?php

// exibe todos os dados recebidos via $_POST
// var_dump($_POST);
include 'conexao.php';

try {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $tipo = $_POST['tipo'];
    $msg = $_POST['msg'];
   
    
    $sql = 'INSERT INTO tb_contato(nome,email,telefone,tipo,msg)VALUES(:nome,:email,:telefone,:tipo,:msg)';

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':msg', $msg);

    $stmt->execute();

    $resposta = array('STATUS'=>'1','MSG'=>'Obrigado, aguarde nosso contato em breve!');

    $json = json_encode($resposta, JSON_UNESCAPED_UNICODE);

    echo $json;


} catch (PDOException $e) {
    $resposta = array('STATUS'=>'0','MSG'=>'Erro ao registrar seu contato!'.$e->getMessage().'');

    $json = json_encode($resposta, JSON_UNESCAPED_UNICODE);

    echo $json;

}

?>