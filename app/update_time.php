<?php
require_once '/./includes/functions.php'; 
require_once '/./login/verifica_user.php';   
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualiza Jogador</title>
</head>
<body>
    <?php include './includes/header.php';?>
    <form action="" method="post">
        <label for="id">ID:</label>
        <input type="number" name="id" id="id"> <br><br>
        <label for="nome">Nome: </label>
        <input type="text"name="nome" id="nome" required placeholder="Insira o Nome do Time:"><br> <br>

        <label for="nometec">Nome do Tecnico: </label>
        <input type="nometec"name="nometec" id="nometec"> <br>

        <label for="nasc">Nascimento: </label>
        <input type="date"name="nasc" id="nasc"> <br>

        <label for="ativo">Ativo?: </label>  <br>
        <label for="ativo">SIM</label>

        <input type="radio" name="ativo" id="ativo" value="true">
        <label for="ativo">NÃO</label>
        <input type="radio" name="ativo" id="ativo" value="false"><br>
        <input type="reset" value="Limpar"><br>
        <input type="submit" value="Cadastrar"> <br>
    </form>
    <?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){   
        atualizar($conexao, $_POST['id'], $_POST['nome'], $_POST['turma'], $_POST['nasc'], $_POST['ativo']);
    }
    include './includes/footer.php';
    ?>
</body>
</html>

