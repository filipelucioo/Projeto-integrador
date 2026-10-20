<?php
$page_title = "Deletar Jogador";
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../login/verifica_user.php';
include __DIR__ . '/../includes/header.php';
?>

<div class="card" style="max-width: 500px; margin: 0 auto;">
    <h2 style="color: #ef4444;">🗑️ Deletar Jogador</h2>
    <p class="text-muted" style="margin-bottom: 1rem;">Atenção: esta ação apaga permanentemente o registro do jogador.</p>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        deletar_jogador($conexao, $_POST['id']);
    }
    ?>

    <form action="" method="post">
        <div class="form-group">
            <label for="id">ID do Jogador: </label>
            <input type="number" name="id" id="id" required min="1" placeholder="Insira o ID do Jogador">
        </div>

        <input type="submit" value="Apagar Jogador" class="btn btn-danger">
    </form>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
