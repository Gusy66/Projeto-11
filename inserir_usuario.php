<?php

require_once 'conn.php';


// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];

    // Prepara a consulta SQL para inserção dos dados
    $sql = "INSERT INTO usuarios (nome, email, senha, telefone, endereco) VALUES (?, ?, ?, ?, ?)";

    // Prepara a declaração SQL usando prepared statements para evitar SQL Injection
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssss", $nome, $email, $senha, $telefone, $endereco);

    // Executa a declaração SQL
    if ($stmt->execute()) {
        // Inserção bem-sucedida
        echo "Usuário cadastrado com sucesso!";
    } else {
        // Erro na inserção
        echo "Erro ao cadastrar o usuário: " . $conexao->error;
    }

    // Fecha a declaração e a conexão
    $stmt->close();
    $conexao->close();
}
?>
