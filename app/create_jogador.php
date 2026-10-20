<?php
$page_title = "Cadastrar Jogador";
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../login/verifica_user.php';
include __DIR__ . '/../includes/header.php';
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2>🏃 Cadastrar Jogador</h2>
    <hr style="margin: 1rem 0;">

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        cadastrar_jogador($conexao, $_POST['nometime'], $_POST['nomejogador'], $_POST['cpf'], $_POST['nasc'], $_POST['telefone'], $_POST['nomeresp'], $_POST['telresp']);
    }
    ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="nometime">Nome do Time:</label>
            <input type="text" name="nometime" id="nometime" required placeholder="Digite o nome exato do time">
        </div>

        <div class="form-group">
            <label for="nomejogador">Nome do Jogador:</label>
            <input type="text" name="nomejogador" id="nomejogador" required placeholder="Nome completo do atleta">
        </div>

        <div class="form-group">
            <label for="cpf">CPF do Jogador:</label>
            <input type="text" name="cpf" id="cpf" required placeholder="Somente números" maxlength="14">
        </div>

        <div class="form-group">
            <label for="nasc">Data de Nascimento:</label>
            <input type="date" name="nasc" id="nasc" required>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" required placeholder="DDD + Número">
        </div>

        <div class="form-group">
            <label for="nomeresp">Nome do Responsável (se menor):</label>
            <input type="text" name="nomeresp" id="nomeresp" placeholder="Opcional">
        </div>

        <div class="form-group">
            <label for="telresp">Telefone do Responsável:</label>
            <input type="text" name="telresp" id="telresp" placeholder="Opcional">
        </div>

        <div class="form-actions">
            <input type="reset" value="Limpar">
            <input type="submit" value="Salvar Jogador">
        </div>
    </form>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
