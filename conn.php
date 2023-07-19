<?php

// Configurações do banco de dados

$host = "localhost"; 
$usuario = "root"; 
$senha = ""; 
$bancoDeDados = "projetinho"; 

// Conexão com o banco de dados usando MySQLi
$conexao = new mysqli($host, $usuario, $senha, $bancoDeDados);

// Verifica se houve algum erro na conexão
if ($conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}
?>
