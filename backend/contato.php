<?php

// exibe todos os dados recebidos via $_POST
// var_dump($_POST);

// pega e junta um arqivo esterno
include 'conexao.php';

// tentar incerir
try {

    // vai conferir se veio todos os dados
    // $ cria uma variavel, e os valores vem do _POST
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $tipo = $_POST['tipo'];
    $msg = $_POST['msg'];
    
    // se veio tudo ele vai pegar e guardar no banco de dados (DB)
    $sql = 'INSERT INTO tb_contato(nome,email,telefone,tipo,msg)VALUES(:nome,:email,:telefone,:tipo,:msg)';

    // prepara para executar o comando
    $stmt = $conn->prepare($sql);

    // protege o banco de dados
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':msg', $msg);

    // executa o comando
    $stmt->execute();

    // se deu tudo certo avisa
    $resposta = array('STATUS'=>'1','MSG'=>'Obrigado, aguarde nosso contato em breve!');

    $json = json_encode($resposta, JSON_UNESCAPED_UNICODE);

    echo $json;

} 

// retorna mensagem
catch (PDOException $e) {
    $resposta = array('STATUS'=>'0','MSG'=>'Erro ao registrar seu contato!'.$e->getMessage().'');

    $json = json_encode($resposta, JSON_UNESCAPED_UNICODE);

    echo $json;

}

?>