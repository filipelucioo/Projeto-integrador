<?php
$page_title = "Atualizar Time";
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../login/verifica_user.php';
include __DIR__ . '/../includes/header.php';
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2>✏️ Atualizar Dados do Time</h2>
    <hr style="margin: 1rem 0;">

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        atualizar_time($conexao, $_POST['id'], $_POST['nome'], $_POST['nometec'], $_POST['cpf'], $_POST['nasc'], $_POST['telefone']);
    }
    ?>

    <form action="" method="post">
        <div class="form-group">
            <label for="id">ID do Time que deseja alterar:</label>
            <input type="number" name="id" id="id" required min="1" placeholder="Insira o ID">
        </div>

        <div class="form-group">
            <label for="nome">Novo Nome do Time: </label>
            <input type="text" name="nome" id="nome" required placeholder="Insira o Nome do Time">
        </div>

        <div class="form-group">
            <label for="nometec">Novo Nome do Técnico: </label>
            <input type="text" name="nometec" id="nometec" required placeholder="Insira o Nome do Técnico">
        </div>

        <div class="form-group">
            <label for="cpf">CPF do Técnico: </label>
            <input type="text" name="cpf" id="cpf" required placeholder="Somente números" maxlength="14">
        </div>

        <div class="form-group">
            <label for="nasc">Nascimento do Técnico: </label>
            <input type="date" name="nasc" id="nasc" required>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone: </label>
            <input type="text" name="telefone" id="telefone" required placeholder="DDD + número">
        </div>

        <div class="form-actions">
            <input type="reset" value="Limpar">
            <input type="submit" value="Atualizar Time">
        </div>
    </form>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
