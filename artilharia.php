<?php
$page_title = "Artilharia";
require_once __DIR__ . '/includes/functions.php';
include __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <h1>🥇 Ranking de Artilheiros</h1>
    <p>Confira os principais goleadores da Copa Bololô</p>
</div>

<?php if (!$conexao): ?>
    <div class="alert alert-danger">Servidor de banco de dados indisponível no momento.</div>
<?php else: ?>
    <?php
    $sql = "SELECT j.nome, j.gols, t.nome AS time_nome 
            FROM jogadores j 
            JOIN times t ON t.id = j.time_id 
            ORDER BY j.gols DESC, j.nome ASC LIMIT 20";
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $artilheiros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="card shadow">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Posição</th>
                    <th>Jogador</th>
                    <th>Time</th>
                    <th>Gols</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($artilheiros)): ?>
                    <tr><td colspan="4" style="text-align:center;">Nenhum gol registrado até o momento.</td></tr>
                <?php else: ?>
                    <?php foreach ($artilheiros as $index => $artilheiro): ?>
                        <tr>
                            <td>
                                <?php 
                                if ($index == 0) echo "🥇 1º";
                                else if ($index == 1) echo "🥈 2º";
                                else if ($index == 2) echo "🥉 3º";
                                else echo ($index + 1) . "º";
                                ?>
                            </td>
                            <td><strong><?= h($artilheiro['nome']) ?></strong></td>
                            <td><span class="badge badge-team"><?= h($artilheiro['time_nome']) ?></span></td>
                            <td><span class="badge badge-goals"><?= h($artilheiro['gols']) ?> Gols</span></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
