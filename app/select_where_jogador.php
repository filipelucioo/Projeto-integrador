<?php
$page_title = "Consulta de Jogador";
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../login/verifica_user.php';
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <h1>🔍 Consultar Jogador por ID</h1>
</div>

<div class="card" style="max-width: 500px; margin: 0 auto 2rem auto;">
    <form action="" method="post">
        <div class="form-group">
            <label for="id">ID do Jogador: </label>
            <input type="number" name="id" id="id" required min="1" placeholder="Ex: 1">
        </div>
        <input type="submit" value="Consultar Jogador">
    </form>
</div>

<?php if ($_SERVER['REQUEST_METHOD'] == "POST"): ?>
    <div class="card" style="max-width: 500px; margin: 0 auto;">
        <?php consultar_jogador($conexao, $_POST['id']); ?>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../includes/footer.php'; ?>
