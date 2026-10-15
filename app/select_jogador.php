<?php 
require_once '/./includes/functions.php';
require_once '/./login/verifica_user.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Jogadores</title>
</head>
<body>
    <?php 
    include '/./includes/header.php';
    ?>
    <div style="width: 30%; margin:auto; text-align:center; border:lpx solid black; border-radius:5px;">
     <h3>Lista completa de Jogadores:</h3>
     <?php 
     listar($conexao);
     ?>

    </div>
    <?php 
    include '/./includes/footer.php';
    ?>
</body>
</html>