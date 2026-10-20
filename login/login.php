<?php
$page_title = "Área Restrita - Login";
require_once __DIR__ . '/../includes/functions.php';
if (session_status() === PHP_SESSION_NONE) { session_start(); }

$erro = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $usuario = consultar_user($conexao, $_POST['email']);

    if ($usuario && password_verify($_POST['senha'], $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        header("Location: " . BASE_URL . "index.php");
        exit;
    } else {
        $erro = "E-mail ou senha incorretos.";
    }
}
include __DIR__ . '/../includes/header.php';
?>

<div class="card" style="max-width: 450px; margin: 2rem auto;">
    <h2 style="text-align: center; margin-bottom: 1.5rem;">🔒 Entrar no Sistema</h2>

    <?php if ($erro): ?>
        <div class="alert alert-danger"><?= h($erro) ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <div class="form-group">
            <label for="email">E-mail: </label>
            <input type="email" name="email" id="email" required placeholder="seuemail@dominio.com">
        </div>

        <div class="form-group">
            <label for="senha">Senha: </label>
            <input type="password" name="senha" id="senha" required placeholder="Digite sua senha">
        </div>

        <input type="submit" value="Entrar">
    </form>

    <p style="text-align: center; margin-top: 1.5rem;">
        Ainda não tem conta? <a href="cadastrar.php" style="color: var(--primary); font-weight: 600;">Cadastre-se</a>
    </p>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
