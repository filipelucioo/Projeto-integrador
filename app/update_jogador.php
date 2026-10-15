<?php
require_once __DIR__ . '/../login/verifica_user.php';
require_once __DIR__ . '/../includes/functions.php';

$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $alterados = atualizar_jogador(
            $conexao,
            $_POST['id'],
            $_POST['time_id'],
            trim($_POST['nome']),
            $_POST['cpf'],
            $_POST['nasc'],
            $_POST['telefone'],
            trim($_POST['nome_responsavel']),
            $_POST['telefone_responsavel']
        );
        $mensagem = $alterados
            ? "Jogador atualizado com sucesso!"
            : "Nenhum jogador encontrado com esse ID.";
    } catch (PDOException $e) {
        $mensagem = mensagem_erro_bd($e);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Atualizar Jogador</title>
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <h1>Atualizar Jogador</h1>
    <p>Informe o ID do jogador e preencha os novos dados (todos os campos são substituídos).</p>
    <?php if ($mensagem): ?><p><strong><?= h($mensagem) ?></strong></p><?php endif; ?>

    <form action="" method="post">
        <label for="id">ID do jogador: </label>
        <input type="number" name="id" id="id" required min="1"><br>

        <label for="time_id">Time: </label>
        <select name="time_id" id="time_id" required>
            <option value="">Selecione o time</option>
            <?php opcoes_times($conexao); ?>
        </select><br>

        <label for="nome">Nome do jogador: </label>
        <input type="text" name="nome" id="nome" required><br>

        <label for="cpf">CPF: </label>
        <input type="text" name="cpf" id="cpf" required inputmode="numeric" pattern="\d{11}" maxlength="11" title="Digite os 11 números do CPF"><br>

        <label for="nasc">Data de nascimento: </label>
        <input type="date" name="nasc" id="nasc" required><br>

        <label for="telefone">Telefone: </label>
        <input type="text" name="telefone" id="telefone" inputmode="numeric" pattern="\d{10,11}" maxlength="11"><br>

        <label for="nome_responsavel">Nome do responsável: </label>
        <input type="text" name="nome_responsavel" id="nome_responsavel"><br>

        <label for="telefone_responsavel">Telefone do responsável: </label>
        <input type="text" name="telefone_responsavel" id="telefone_responsavel" inputmode="numeric" pattern="\d{10,11}" maxlength="11"><br><br>

        <input type="reset" value="Limpar">
        <input type="submit" value="Atualizar">
        <a href="../index.php">Voltar</a>
    </form>

    <h3>Jogadores cadastrados (para consultar o ID)</h3>
    <?php exibir_tabela_jogadores(listar_jogadores($conexao)); ?>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
