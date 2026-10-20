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
    <title>Consulta Time</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h3>Consulta de Time</h3>
    <form action="" method="post">
        <label for="id">Time ID: </label>
        <input type="number" name="id" id="id" required min="1">
        <input type="submit" value="Consultar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        consultar_time($conexao, $_POST['id']);
    }
    include '../includes/footer.php';
    ?>
</body>
</html>
