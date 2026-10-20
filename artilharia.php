<?php
$page_title = "Artilharia";
require_once __DIR__ . '/includes/functions.php';

$artilheiros = listar_artilheiros($conexao);

include __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <h1>🥇 Ranking de Artilheiros</h1>
    <p>Confira os principais goleadores da Copa Bololô em tempo real</p>
</div>

<div class="card shadow">
    <table class="data-table">
        <thead>
            <tr>
                <th>Posição</th>
                <th>Jogador</th>
                <th>Time</th>
                <th>Gols Marcados</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($artilheiros)): ?>
                <tr><td colspan="4" style="text-align:center;">Nenhum gol registrado até o momento. Registre partidas para pontuar!</td></tr>
            <?php else: ?>
                <?php foreach ($artilheiros as $index => $artilheiro): ?>
                    <tr>
                        <td>
                            <?php
                            if ($index == 0) echo "🥇 1º Lugar";
                            else if ($index == 1) echo "🥈 2º Lugar";
                            else if ($index == 2) echo "🥉 3º Lugar";
                            else echo ($index + 1) . "º Lugar";
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

<?php include __DIR__ . '/includes/footer.php'; ?>
