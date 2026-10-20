<?php
require_once '../includes/functions.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Cadastrar Usuário</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h1>Cadastrar Usuário</h1>
    <form action="" method="post">
        <label for="email">E-mail: </label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="senha">Senha: </label>
        <input type="password" name="senha" id="senha" required minlength="6"><br><br>

        <input type="submit" value="Cadastrar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        Cadastrar_user($conexao, $_POST['email'], $_POST['senha']);
    }
    ?>
    <p><a href="login.php">Voltar para o login</a></p>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
