<?php 
require_once '/./includes/functions.php';
require_once '/./login/verifica_user.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Times</title>
</head>
<body>
    <?php 
    include '/./includes/header.php';
    ?>
    <div style="width: 30%; margin:auto; text-align:center; border:lpx solid black; border-radius:5px;">
     <h3>Lista completa de alunos:</h3>
     <?php 
     listar($conexao);
     ?>

    </div>
    <?php 
    include '/./includes/footer.php';
    ?>
</body>
</html>