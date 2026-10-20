<?php
require_once '../includes/functions.php';
require_once '../login/verifica_user.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Cadastrar Time</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h1>Cadastrar Time</h1>
    <hr>
    <form action="" method="POST">
        <label for="nome">Nome do Time: </label>
        <input type="text" name="nome" id="nome" required placeholder="Insira o Nome do Time:"><br>

        <label for="nometec">Nome do Técnico: </label>
        <input type="text" name="nometec" id="nometec" required placeholder="Insira o Nome do Técnico:"><br>

        <label for="cpf">CPF do Técnico: </label>
        <input type="text" name="cpf" id="cpf" required placeholder="Somente números" maxlength="11" pattern="[0-9]{11}" title="Digite os 11 números do CPF"><br>

        <label for="nasc">Nascimento: </label>
        <input type="date" name="nasc" id="nasc" required><br>

        <label for="telefone">Telefone: </label>
        <input type="text" name="telefone" id="telefone" required placeholder="DDD + número" maxlength="11" pattern="[0-9]{10,11}" title="Digite DDD + número"><br><br>

        <input type="reset" value="Limpar">
        <input type="submit" value="Cadastrar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        cadastrar_time($conexao, $_POST['nome'], $_POST['nometec'], $_POST['cpf'], $_POST['nasc'], $_POST['telefone']);
    }
    include '../includes/footer.php';
    ?>
</body>
</html>
