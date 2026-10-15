<?php 
require_once '/./includes/functions.php';
require_once '/./login/verifica_user.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta Jogadores</title>
</head>
<body>
    <?php 
    include '/./includes/header.php';
    ?>
    <h3>Consulta de Jogadores</h3>
    <form action=""method="post">
        <label for="id">Jogador ID: </label>
        <input type="number" name="id" id="id">
        <input type="submit" value="Consultar">
    </form>
    <?php 
    if($_SERVER['REQUEST_METHOD'] =="POST"){
        consultar($conexao, $_POST['id']);
    }
    include '/./includes/footer.php';
    ?>
</body>
</html>


<?php 


?>