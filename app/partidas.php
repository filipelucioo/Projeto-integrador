<?php
$page_title = "Registrar Partida";
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../login/verifica_user.php';

// busca times e jogadores para montar os campos
$times = $conexao->query("SELECT id, nome FROM times ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC);
$jogadores = $conexao->query("SELECT id, time_id, nome FROM jogadores ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC);

// organiza os jogadores por time (o JavaScript usa isso)
$jogadores_por_time = [];
foreach ($jogadores as $j) {
    $jogadores_por_time[$j['time_id']][] = $j;
}

include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <h1>🎮 Painel de Partidas</h1>
    <p>Registre confrontos, atribua gols aos atletas e atualize as estatísticas</p>
</div>

<div class="card shadow" style="max-width: 800px; margin: 0 auto 2.5rem auto;">
    <h2>⚽ Registrar Nova Partida</h2>
    <hr style="margin: 1rem 0;">

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        registrar_partida(
            $conexao,
            $_POST['time_casa_id'],
            $_POST['time_fora_id'],
            $_POST['gols_casa'],
            $_POST['gols_fora'],
            $_POST['data_jogo'],
            $_POST['gols_jogadores'] ?? []
        );
    }
    ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="data_jogo">Data da Partida:</label>
            <input type="date" name="data_jogo" id="data_jogo" required value="<?= date('Y-m-d') ?>">
        </div>

        <div class="grid-2" style="gap: 1.5rem; margin: 1rem 0;">
            <div class="card" style="background: #f1f5f9; padding: 1.2rem; margin: 0;">
                <h3>🏠 Time Mandante (Casa)</h3>

                <div class="form-group">
                    <label for="time_casa_id">Selecionar Time:</label>
                    <select name="time_casa_id" id="time_casa_id" required onchange="atualizarJogadores()">
                        <option value="">-- Selecione --</option>
                        <?php foreach ($times as $t): ?>
                            <option value="<?= (int)$t['id'] ?>"><?= h($t['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="gols_casa">Placar (Gols Casa):</label>
                    <input type="number" name="gols_casa" id="gols_casa" required min="0" value="0">
                </div>

                <h4>Gols Marcados por Jogadores:</h4>
                <div id="container_jogadores_casa">
                    <p class="text-muted">Selecione o time para listar os jogadores.</p>
                </div>
            </div>

            <div class="card" style="background: #f1f5f9; padding: 1.2rem; margin: 0;">
                <h3>✈️ Time Visitante (Fora)</h3>

                <div class="form-group">
                    <label for="time_fora_id">Selecionar Time:</label>
                    <select name="time_fora_id" id="time_fora_id" required onchange="atualizarJogadores()">
                        <option value="">-- Selecione --</option>
                        <?php foreach ($times as $t): ?>
                            <option value="<?= (int)$t['id'] ?>"><?= h($t['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="gols_fora">Placar (Gols Fora):</label>
                    <input type="number" name="gols_fora" id="gols_fora" required min="0" value="0">
                </div>

                <h4>Gols Marcados por Jogadores:</h4>
                <div id="container_jogadores_fora">
                    <p class="text-muted">Selecione o time para listar os jogadores.</p>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <input type="reset" value="Limpar" onclick="setTimeout(atualizarJogadores, 100)">
            <input type="submit" value="Salvar Resultado da Partida">
        </div>
    </form>
</div>

<div class="card shadow" style="max-width: 800px; margin: 0 auto 2.5rem auto;">
    <h2>📋 Partidas Registradas</h2>
    <?php listar_partidas($conexao); ?>
</div>

<script>
const jogadoresPorTime = <?= json_encode($jogadores_por_time, JSON_HEX_TAG | JSON_HEX_AMP) ?>;

// mostra os campos de gols dos jogadores do time escolhido
function listaJogadores(selectId, containerId) {
    const timeId = document.getElementById(selectId).value;
    const container = document.getElementById(containerId);
    container.innerHTML = '';

    if (!jogadoresPorTime[timeId]) {
        container.innerHTML = '<p class="text-muted">Nenhum jogador encontrado para este time.</p>';
        return;
    }

    jogadoresPorTime[timeId].forEach(function (j) {
        const linha = document.createElement('div');
        linha.style.cssText = 'display: flex; justify-content: space-between; margin-bottom: 6px;';

        // textContent evita que um nome com HTML seja interpretado
        const nome = document.createElement('span');
        nome.textContent = j.nome;

        const gols = document.createElement('input');
        gols.type = 'number';
        gols.name = 'gols_jogadores[' + j.id + ']';
        gols.min = 0;
        gols.value = 0;
        gols.style.width = '70px';

        linha.appendChild(nome);
        linha.appendChild(gols);
        container.appendChild(linha);
    });
}

function atualizarJogadores() {
    listaJogadores('time_casa_id', 'container_jogadores_casa');
    listaJogadores('time_fora_id', 'container_jogadores_fora');
}
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
