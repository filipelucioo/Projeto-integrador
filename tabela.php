<?php
$page_title = "Tabela de Jogos";
require_once __DIR__ . '/includes/functions.php';
include __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <h1>📅 Tabela e Classificação</h1>
    <p>Acompanhe os jogos e a pontuação das equipes</p>
</div>

<?php if (!$conexao): ?>
    <div class="alert alert-danger">Servidor de banco de dados indisponível no momento.</div>
<?php else: ?>
    <div class="grid-2">
        <div class="card">
            <h3>Classificação Geral</h3>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Técnico</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $conexao->query("SELECT * FROM times ORDER BY nome ASC");
                    $times = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (empty($times)): ?>
                        <tr><td colspan="3">Nenhum time cadastrado.</td></tr>
                    <?php else: ?>
                        <?php foreach ($times as $t): ?>
                            <tr>
                                <td><strong><?= h($t['nome']) ?></strong></td>
                                <td><?= h($t['tecnico']) ?></td>
                                <td><span class="badge badge-success">Inscrito</span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="card">
            <h3>Últimas Partidas</h3>
            <p class="text-muted" style="margin-top:1rem;">A tabela oficial de confrontos da fase de grupos será sorteada em breve.</p>
        </div>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
