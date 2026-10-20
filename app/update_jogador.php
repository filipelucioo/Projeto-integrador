<?php
$page_title = "Atualizar Jogador";
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../login/verifica_user.php';
include __DIR__ . '/../includes/header.php';
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2>✏️ Atualizar Dados do Jogador</h2>
    <hr style="margin: 1rem 0;">

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        atualizar_jogador($conexao, $_POST['id'], $_POST['nometime'], $_POST['nomejogador'], $_POST['cpf'], $_POST['nasc'], $_POST['telefone'], $_POST['nomeresp'], $_POST['telresp']);
    }
    ?>

    <form action="" method="post">
        <div class="form-group">
            <label for="id">ID do Jogador que deseja alterar:</label>
            <input type="number" name="id" id="id" required min="1" placeholder="Insira o ID">
        </div>

        <div class="form-group">
            <label for="nometime">Nome do Time: </label>
            <input type="text" name="nometime" id="nometime" required placeholder="Insira o Nome do Time">
        </div>

        <div class="form-group">
            <label for="nomejogador">Nome do Jogador: </label>
            <input type="text" name="nomejogador" id="nomejogador" required placeholder="Insira o Nome">
        </div>

        <div class="form-group">
            <label for="cpf">CPF: </label>
            <input type="text" name="cpf" id="cpf" required placeholder="Somente números" maxlength="14">
        </div>

        <div class="form-group">
            <label for="nasc">Nascimento: </label>
            <input type="date" name="nasc" id="nasc" required>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone: </label>
            <input type="text" name="telefone" id="telefone" required placeholder="DDD + número">
        </div>

        <div class="form-group">
            <label for="nomeresp">Nome do Responsável: </label>
            <input type="text" name="nomeresp" id="nomeresp">
        </div>

        <div class="form-group">
            <label for="telresp">Telefone do Responsável: </label>
            <input type="text" name="telresp" id="telresp">
        </div>

        <div class="form-actions">
            <input type="reset" value="Limpar">
            <input type="submit" value="Atualizar Jogador">
        </div>
    </form>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
