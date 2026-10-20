<?php
require_once __DIR__ . '/../login/verifica_user.php';
require_once __DIR__ . '/../includes/functions.php';

$jogador = null;
$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $jogador = consultar_jogador($conexao, $_POST['id']);
    if (!$jogador) {
        $mensagem = "Nenhum jogador encontrado com esse ID.";
    }}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Consulta Jogador</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h3>Consulta de Jogador</h3>
    <form action="" method="post">
        <label for="id">Jogador ID: </label>
        <input type="number" name="id" id="id" required min="1">
        <input type="submit" value="Consultar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        consultar_jogador($conexao, $_POST['id']);
    }
    include '../includes/footer.php';
    ?>
</body>
</html>
