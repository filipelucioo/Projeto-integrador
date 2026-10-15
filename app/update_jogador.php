<?php
include './includes/functions.php'; 
include './login/verifica_user.php';
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
        <input type="number" name="id" id="id" required placeholder="Insira o ID:"> <br> <br>

        <label for="nometime">Nome do time: </label>
        <input type="text"name="nometime" id="nometime" required placeholder="Insira o Nome do Time:"><br> <br> 

        <label for="nome">Nome do Jogador: </label>
        <input type="text"name="nome" id="nome" required placeholder="Insira o Nome:"><br><br>

        <label for="cpf">CPF: </label>
        <input type="number"name="cpf" id="cpf" required placeholder="Insira o CPF:"> <br><br>

        <label for="nasc">Nascimento: </label>
        <input type="date"name="nasc" id="nasc"> <br> <br>

        <label for="ativo">Ativo?: </label>  <br>
        <label for="ativo">SIM</label>

        <input type="radio" name="ativo" id="ativo" value="true">
        <label for="ativo" required>NÃO</label>
        <input type="radio" name="ativo" id="ativo" value="false"><br>
        <input type="reset" value="Limpar"><br>
        <input type="submit" value="Cadastrar"> <br><br>
    </form>
    <?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){   
        atualizar($conexao, $_POST['id'], $_POST['nometime'], $_POST['nome'], $_POST['cpf'], $_POST['nasc'], $_POST['ativo']);
    }
    include '/includes/footer.php';
    ?>
</body>
</html>