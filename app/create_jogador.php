<?php 
include '/./includes/header.php';
include '/./login/verifica_user.php'; 
include '/./database/conect.php'; 
include '/./includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $ativo = isset($_POST['ativo']) ? $_POST['ativo'] : 'false';
    
    cadastrar($conexao, $_POST['nome'], $_POST['nasc'], $_POST['turma'], $ativo);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Cadastrar Jogador</title>
</head>
<body>
    <h1>Cadastrar Jogador</h1>
    <hr>
    <form action="" method="POST">
        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome" required placeholder="Insira o Nome do Time:"><br>
        
        <label for="nomejogador">Nome do Jogador: </label>
        <input type="text" name="nomejogador" id="nomejogador" required placeholder="Insria o Nome do Jogador:"><br>

        <label for="cpf">CPF do Jogador: </label>
        <input type="number" name="cpf" id="cpf" required placeholder="Insira o CPF do Jogador:" min="11" max="11"><br>
        
        <label for="nasc">Nascimento: </label>
        <input type="date" name="nasc" id="nasc" required><br>

        <label for="telefone">Telefone: </label>
        <input type="number" name="telefone" id="telefone" required min="11" max="11"><br>
        
        <label>Ativo: </label>
    
        <input type="radio" name="ativo" id="sim" value="true" required>
        <label for="sim">SIM</label>

        <input type="radio" name="ativo" id="nao" value="false">
        <label for="nao">NÃO</label>
        <br><br>
        
        <input type="reset" value="Limpar">
        <input type="submit" value="Cadastrar">
    </form>

<?php include '../includes/footer.php'; ?>
</body>
</html>