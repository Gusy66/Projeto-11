<!DOCTYPE html>
<html>
<head>
    <title>Seu Perfil</title>
</head>
<body>
    <h1>Seu Perfil</h1>
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

        // Consulta para obter os dados do usuário logado
        $idUsuario = $_SESSION["id"];
        $sql = "SELECT nome, email, telefone, endereco, foto_perfil, biografia FROM usuarios WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $stmt->bind_result($nomeUsuario, $emailUsuario, $telefoneUsuario, $enderecoUsuario, $fotoPerfilUsuario, $biografiaUsuario);
        $stmt->fetch();
        $stmt->close();

        // Exibe os dados do usuário
        echo "<p>Nome: " . $nomeUsuario . "</p>";
        echo "<p>Email: " . $emailUsuario . "</p>";
        echo "<p>Telefone: " . $telefoneUsuario . "</p>";
        echo "<p>Endereço: " . $enderecoUsuario . "</p>";
        echo "<p>Biografia: " . $biografiaUsuario . "</p>";
        echo '<img src="' . $fotoPerfilUsuario . '" alt="Foto de Perfil" width="100" height="100">';
    } else {
        // Redireciona para a página de login se o usuário não estiver logado
        header("Location: login.html");
    }
    ?>
    <h2>Editar Perfil</h2>
    <form action="atualizar_perfil.php" method="post" enctype="multipart/form-data">
        <label for="foto_perfil">Foto de Perfil:</label>
        <input type="file" id="foto_perfil" name="foto_perfil"><br>

        <label for="biografia">Biografia:</label>
        <textarea id="biografia" name="biografia"><?php echo $biografiaUsuario; ?></textarea><br>

        <input type="submit" value="Salvar Alterações">
    </form>
</body>
</html>
