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
    <title>Atualizar Jogador</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h1>Atualizar Jogador</h1>
    <form action="" method="post">
        <label for="id">ID do Jogador:</label>
        <input type="number" name="id" id="id" required min="1" placeholder="Insira o ID:"><br><br>

        <label for="nometime">Nome do Time: </label>
        <input type="text" name="nometime" id="nometime" required placeholder="Insira o Nome do Time:"><br><br>

        <label for="nomejogador">Nome do Jogador: </label>
        <input type="text" name="nomejogador" id="nomejogador" required placeholder="Insira o Nome:"><br><br>

        <label for="cpf">CPF: </label>
        <input type="text" name="cpf" id="cpf" required placeholder="Somente números" maxlength="11" pattern="[0-9]{11}" title="Digite os 11 números do CPF"><br><br>

        <label for="nasc">Nascimento: </label>
        <input type="date" name="nasc" id="nasc" required><br><br>

        <label for="telefone">Telefone: </label>
        <input type="text" name="telefone" id="telefone" required placeholder="DDD + número" maxlength="11" pattern="[0-9]{10,11}" title="Digite DDD + número"><br><br>

        <label for="nomeresp">Nome do Responsável: </label>
        <input type="text" name="nomeresp" id="nomeresp"><br><br>

        <label for="telresp">Telefone do Responsável: </label>
        <input type="text" name="telresp" id="telresp" maxlength="11" pattern="[0-9]{10,11}" title="Digite DDD + número"><br><br>

        <input type="reset" value="Limpar">
        <input type="submit" value="Atualizar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        atualizar_jogador($conexao, $_POST['id'], $_POST['nometime'], $_POST['nomejogador'], $_POST['cpf'], $_POST['nasc'], $_POST['telefone'], $_POST['nomeresp'], $_POST['telresp']);
    }
    include '../includes/footer.php';
    ?>
</body>
</html>
