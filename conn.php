<?php

// Conexão com o banco de dados
$host = "localhost"; // Endereço do servidor MySQL (geralmente é "localhost" se for local)
$usuario = "root"; // Nome de usuário do banco de dados
$senhaBD = ""; // Senha do banco de dados
$bancoDeDados = "projetinho"; // Nome do banco de dados

// Estabelece a conexão com o banco de dados usando MySQLi
$conexao = new mysqli($host, $usuario, $senhaBD, $bancoDeDados);

// Verifica se houve algum erro na conexão
if ($conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

?>


