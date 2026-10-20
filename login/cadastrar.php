<?php
$page_title = "Cadastrar Usuário";
require_once __DIR__ . '/../includes/functions.php';
include __DIR__ . '/../includes/header.php';
?>

<div class="card" style="max-width: 450px; margin: 2rem auto;">
    <h2 style="text-align: center; margin-bottom: 1.5rem;">👤 Criar Nova Conta</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        cadastrar_user($conexao, $_POST['email'], $_POST['senha']);
    }
    ?>

    <form action="" method="post">
        <div class="form-group">
            <label for="email">E-mail: </label>
            <input type="email" name="email" id="email" required placeholder="seuemail@dominio.com">
        </div>

        <div class="form-group">
            <label for="senha">Senha: </label>
            <input type="password" name="senha" id="senha" required minlength="6" placeholder="Mínimo de 6 caracteres">
        </div>

        <input type="submit" value="Cadastrar">
    </form>

    <p style="text-align: center; margin-top: 1.5rem;">
        Já possui uma conta? <a href="login.php" style="color: var(--primary); font-weight: 600;">Voltar para o login</a>
    </p>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
