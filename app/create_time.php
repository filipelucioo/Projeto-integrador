<?php
$page_title = "Cadastrar Time";
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../login/verifica_user.php';
include __DIR__ . '/../includes/header.php';
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2>🛡️ Cadastrar Time</h2>
    <hr style="margin: 1rem 0;">

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        cadastrar_time($conexao, $_POST['nome'], $_POST['nometec'], $_POST['cpf'], $_POST['nasc'], $_POST['telefone']);
    }
    ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="nome">Nome do Time:</label>
            <input type="text" name="nome" id="nome" required placeholder="Ex: FC Barcelona">
        </div>

        <div class="form-group">
            <label for="nometec">Nome do Técnico:</label>
            <input type="text" name="nometec" id="nometec" required placeholder="Ex: Pep Guardiola">
        </div>

        <div class="form-group">
            <label for="cpf">CPF do Técnico:</label>
            <input type="text" name="cpf" id="cpf" required placeholder="Somente números (11 dígitos)" maxlength="14">
        </div>

        <div class="form-group">
            <label for="nasc">Data de Nascimento do Técnico:</label>
            <input type="date" name="nasc" id="nasc" required>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone de Contato:</label>
            <input type="text" name="telefone" id="telefone" required placeholder="DDD + Número">
        </div>

        <div class="form-actions">
            <input type="reset" value="Limpar">
            <input type="submit" value="Salvar Cadastro">
        </div>
    </form>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
