<?php

require_once "conn.php";
session_start();
// Verifica se o usuário está logado
if (isset($_SESSION["id"])) {
    

    $conexao = new mysqli($host, $usuario, $senhaBD, $bancoDeDados);

    // Verifica se houve algum erro na conexão
    if ($conexao->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
    }

    // Verifica se a foto de perfil foi enviada e atualiza no banco de dados
    if (isset($_FILES["foto_perfil"]) && $_FILES["foto_perfil"]["error"] === UPLOAD_ERR_OK) {
        $pastaUploads = "uploads/"; // Diretório onde as fotos de perfil serão armazenadas
        $nomeArquivo = uniqid() . "-" . $_FILES["foto_perfil"]["name"];
        move_uploaded_file($_FILES["foto_perfil"]["tmp_name"], $pastaUploads . $nomeArquivo);

        // Atualiza o campo "foto_perfil" na tabela "usuarios"
        $idUsuario = $_SESSION["id"];
        $sql = "UPDATE usuarios SET foto_perfil = ? WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("si", $nomeArquivo, $idUsuario);
        $stmt->execute();
        $stmt->close();
    }

    // Verifica se a biografia foi enviada e atualiza no banco de dados
    if (isset($_POST["biografia"])) {
        $biografia = $_POST["biografia"];

        // Atualiza o campo "biografia" na tabela "usuarios"
        $idUsuario = $_SESSION["id"];
        $sql = "UPDATE usuarios SET biografia = ? WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("si", $biografia, $idUsuario);
        $stmt->execute();
        $stmt->close();
    }

    // Redireciona de volta para a página de perfil após a atualização
    header("Location: perfil.php");
} else {
    // Redireciona para a página de login se o usuário não estiver logado
    header("Location: login.html");
}
?>
