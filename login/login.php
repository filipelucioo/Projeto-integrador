<?php
require_once '../includes/functions.php';
session_start();

$erro = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $usuario = consultar_user($conexao, $_POST['email']);

    if ($usuario && password_verify($_POST['senha'], $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        header("Location: /Projeto-integrador/index.php");
        exit;
    } else {
        $erro = "E-mail ou senha incorretos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Página de Login</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h1>Login</h1>
    <form action="" method="post">
        <label for="email">E-mail: </label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="senha">Senha: </label>
        <input type="password" name="senha" id="senha" required><br><br>

        <input type="submit" value="Entrar">
    </form>

    <p><?= h($erro) ?></p>
    <p>Ainda não tem conta? <a href="cadastrar.php">Cadastre-se</a></p>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
