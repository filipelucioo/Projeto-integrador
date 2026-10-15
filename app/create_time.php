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
    <title>Cadastrar</title>
</head>
<body>
    <h1>Cadastrar Time</h1>
    <hr>
    <form action="" method="POST">
        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome" required placeholder="Insira o Nome do Time:"><br>
        
        <label for="nometec">Nome do Tecnico: </label>
        <input type="text" name="nometec" id="nometec" required placeholder="Insria o Nome do Tecnico:"><br>

        <label for="cpf">CPF do Tecnico: </label>
        <input type="number" name="cpf" id="cpf" required placeholder="Insira o CPF do Técnico:" min="11" max="11"><br>
        
        <label for="nasc">Nascimento: </label>
        <input type="date" name="nasc" id="nasc" required><br>
        
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