<?php
$page_title = "Deletar Time";
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../login/verifica_user.php';
include __DIR__ . '/../includes/header.php';
?>

<div class="card" style="max-width: 500px; margin: 0 auto;">
    <h2 style="color: #ef4444;">🗑️ Deletar Time</h2>
    <p class="text-muted" style="margin-bottom: 1rem;">Atenção: esta ação não pode ser desfeita.</p>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        deletar_time($conexao, $_POST['id']);
    }
    ?>

    <form action="" method="post">
        <div class="form-group">
            <label for="id">ID do Time: </label>
            <input type="number" name="id" id="id" required min="1" placeholder="Insira o ID do Time">
        </div>

        <input type="submit" value="Apagar Time" class="btn btn-danger">
    </form>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
