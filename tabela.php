<?php
$page_title = "Tabela & Classificação";
require_once __DIR__ . '/includes/functions.php';

$classificacao = obter_tabela_classificacao($conexao);
$jogos_historico = listar_historico_jogos($conexao);
$goleadores_por_jogo = listar_goleadores_por_jogo($conexao);

include __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <h1>🏆 Classificação do Campeonato</h1>
    <p>Acompanhe em tempo real os pontos, saldo de gols e histórico de partidas</p>
</div>

<div class="card shadow">
    <h2>📊 Tabela de Classificação</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>Pos</th>
                <th>Time</th>
                <th>P</th>
                <th>J</th>
                <th>V</th>
                <th>E</th>
                <th>D</th>
                <th>GP</th>
                <th>GC</th>
                <th>SG</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($classificacao)): ?>
                <tr><td colspan="10" style="text-align:center;">Nenhum time cadastrado ainda.</td></tr>
            <?php else: ?>
                <?php foreach ($classificacao as $idx => $t): ?>
                    <tr>
                        <td><strong><?= ($idx + 1) ?>º</strong></td>
                        <td><strong><?= h($t['nome']) ?></strong></td>
                        <td><span class="badge badge-success"><?= $t['P'] ?> pts</span></td>
                        <td><?= $t['J'] ?></td>
                        <td><?= $t['V'] ?></td>
                        <td><?= $t['E'] ?></td>
                        <td><?= $t['D'] ?></td>
                        <td><?= $t['GP'] ?></td>
                        <td><?= $t['GC'] ?></td>
                        <td><strong><?= ($t['SG'] > 0 ? '+' . $t['SG'] : $t['SG']) ?></strong></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="card shadow" style="margin-top: 2rem;">
    <h2>📅 Histórico de Partidas Realizadas</h2>
    <?php if (empty($jogos_historico)): ?>
        <p class="text-muted" style="margin-top: 1rem;">Nenhuma partida foi realizada ainda. Use a página <a href="<?= BASE_URL ?>app/partidas.php" style="color:var(--primary); font-weight:600;">Registrar Partida</a> para inserir jogos.</p>
    <?php else: ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Data</th>
                    <th style="text-align:right;">Mandante</th>
                    <th style="text-align:center;">Placar</th>
                    <th>Visitante</th>
                    <th>Autores dos Gols</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jogos_historico as $jogo): ?>
                    <?php $goleadores = $goleadores_por_jogo[$jogo['id']] ?? []; ?>
                    <tr>
                        <td style="font-size:0.85rem; color:var(--text-muted);"><?= h(date('d/m/Y', strtotime($jogo['data_jogo']))) ?></td>
                        <td style="text-align:right;"><strong><?= h($jogo['time_casa']) ?></strong></td>
                        <td style="text-align:center;">
                            <span class="badge badge-team" style="font-size:1rem; padding: 0.4rem 0.8rem;">
                                <?= h($jogo['gols_casa']) ?> x <?= h($jogo['gols_fora']) ?>
                            </span>
                        </td>
                        <td><strong><?= h($jogo['time_fora']) ?></strong></td>
                        <td style="font-size:0.85rem;">
                            <?php if (empty($goleadores)): ?>
                                <span class="text-muted">Sem registro de autores</span>
                            <?php else: ?>
                                <?php foreach ($goleadores as $g): ?>
                                    <div>⚽ <?= h($g['nome']) ?> (<?= h($g['quantidade']) ?>)</div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
