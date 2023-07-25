<?php
// Inicia a sessão
session_start();

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Conexão com o banco de dados
    $host = "localhost"; // Endereço do servidor MySQL
    $usuario = "root"; // Nome de usuário do banco de dados
    $senhaBD = ""; // Senha do banco de dados
    $bancoDeDados = "projetinho"; // Nome do banco de dados

    // Estabelece a conexão com o banco de dados usando MySQLi
    $conexao = new mysqli($host, $usuario, $senhaBD, $bancoDeDados);

    // Verifica se houve algum erro na conexão
    if ($conexao->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
    }

    // Prepara a consulta SQL para verificar o usuário no banco de dados
    $sql = "SELECT id, nome FROM usuarios WHERE email = ? AND senha = ?";

    // Prepara a declaração SQL usando prepared statements para evitar SQL Injection
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);

    // Executa a declaração SQL
    $stmt->execute();

    // Armazena o resultado da consulta em variáveis
    $stmt->bind_result($idUsuario, $nomeUsuario);
    $stmt->fetch();

    // Verifica se o usuário foi encontrado no banco de dados
    if ($idUsuario) {
        // Usuário encontrado, realizar o login
        $_SESSION["id"] = $idUsuario; // Definindo a variável de sessão "id"
        $_SESSION["nome"] = $nomeUsuario; // Definindo a variável de sessão "nome"
        header("Location: login.php"); // Redireciona para a página de "bem vindo" após o login bem-sucedido
    } else {
        // Usuário não encontrado, exibir mensagem de erro
        echo "Usuário não cadastrado ou credenciais inválidas.";
    }

    // Fecha a declaração e a conexão
    $stmt->close();
    $conexao->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bem-vindo</title>
</head>
<body>
    <h1>Bem-vindo!</h1>
    <?php
    
    // Verifica se o usuário está logado (após o login bem-sucedido)
    if (isset($_SESSION["id"])) {
        echo '<p>Login bem-sucedido! Bem-vindo ao seu perfil!</p>';
        echo '<a href="perfil.php">Acessar o Perfil</a>';
    } else {
        echo '<p>Faça o login para acessar seu perfil.</p>';
        echo '<a href="login.html">Fazer Login</a>';
    }
    ?>
</body>
</html>





