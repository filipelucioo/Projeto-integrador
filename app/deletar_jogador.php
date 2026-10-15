<?php 
require_once '/./includes/functions.php';
require_once '/./login/verifica_user.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Document</title>
</head>
<body>
    <?php 
    include '/./includes/header.php';
    ?>
    <h1>Pagina Para Deletar Jogadores</h1>

<form action="" method="post">
    <label for="id">ID: </label>
    <input type="number" name="id" id="id" required placeholder="Insira o ID do Jogador">
    <input type="submit" value="Apagar">
</form>

<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    deletar($conexao, $_POST['id']);
}
?>

<?php 
__DIR__.'/../includes/footer.php';
?>



</body>
</html>