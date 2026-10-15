<?php
require_once __DIR__ . '/../database/conect.php';

/* ============================================================
 * UTILITÁRIOS
 * ============================================================ */

// Escapa texto para exibir com segurança no HTML (evita XSS)
function h($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

// Transforma texto vazio em NULL (para campos opcionais do banco)
function vazio_para_null($valor)
{
    $valor = trim((string) $valor);
    return $valor === '' ? null : $valor;
}

// Traduz os erros mais comuns do PostgreSQL para mensagens amigáveis
function mensagem_erro_bd(PDOException $e)
{
    switch ($e->getCode()) {
        case '23503':
            return "Operação não permitida: existem registros vinculados (ex.: time com jogadores) ou o time informado não existe.";
        case '23505':
            return "Já existe um registro com esses dados.";
        case '23502':
            return "Preencha todos os campos obrigatórios.";
        case '22007':
        case '22008':
            return "Data inválida.";
        default:
            return "Erro no banco de dados: " . $e->getMessage();
    }
}

/* ============================================================
 * TIMES
 * ============================================================ */

function cadastrar_time(PDO $conexao, $nome, $tecnico, $cpf_tecnico, $nasc, $telefone)
{
    $sql = "INSERT INTO times (nome, tecnico, cpf_tecnico, data_nascimento, telefone)
            VALUES (:nome, :tecnico, :cpf, :nasc, :telefone)";

    $stmt = $conexao->prepare($sql);
    return $stmt->execute([
        ':nome'     => $nome,
        ':tecnico'  => $tecnico,
        ':cpf'      => $cpf_tecnico,
        ':nasc'     => $nasc,
        ':telefone' => vazio_para_null($telefone),
    ]);
}

function listar_times(PDO $conexao)
{
    $stmt = $conexao->query("SELECT * FROM times ORDER BY nome");
    return $stmt->fetchAll();
}

function consultar_time(PDO $conexao, $id)
{
    $stmt = $conexao->prepare("SELECT * FROM times WHERE id = :id");
    $stmt->execute([':id' => (int) $id]);
    return $stmt->fetch(); // array ou false se não existir
}

// Retorna quantos registros foram alterados (0 = id não encontrado)
function atualizar_time(PDO $conexao, $id, $nome, $tecnico, $cpf_tecnico, $nasc, $telefone)
{
    $sql = "UPDATE times
            SET nome = :nome,
                tecnico = :tecnico,
                cpf_tecnico = :cpf,
                data_nascimento = :nasc,
                telefone = :telefone
            WHERE id = :id";

    $stmt = $conexao->prepare($sql);
    $stmt->execute([
        ':nome'     => $nome,
        ':tecnico'  => $tecnico,
        ':cpf'      => $cpf_tecnico,
        ':nasc'     => $nasc,
        ':telefone' => vazio_para_null($telefone),
        ':id'       => (int) $id,
    ]);
    return $stmt->rowCount();
}

// Retorna quantos registros foram apagados (0 = id não encontrado)
function deletar_time(PDO $conexao, $id)
{
    $stmt = $conexao->prepare("DELETE FROM times WHERE id = :id");
    $stmt->execute([':id' => (int) $id]);
    return $stmt->rowCount();
}

/* ============================================================
 * JOGADORES
 * ============================================================ */

function cadastrar_jogador(PDO $conexao, $time_id, $nome, $cpf, $nasc, $telefone, $nome_responsavel, $telefone_responsavel)
{
    $sql = "INSERT INTO jogadores
                (time_id, nome, cpf, data_nascimento, telefone, nome_responsavel, telefone_responsavel)
            VALUES
                (:time_id, :nome, :cpf, :nasc, :telefone, :nome_resp, :tel_resp)";

    $stmt = $conexao->prepare($sql);
    return $stmt->execute([
        ':time_id'   => (int) $time_id,
        ':nome'      => $nome,
        ':cpf'       => $cpf,
        ':nasc'      => $nasc,
        ':telefone'  => vazio_para_null($telefone),
        ':nome_resp' => vazio_para_null($nome_responsavel),
        ':tel_resp'  => vazio_para_null($telefone_responsavel),
    ]);
}

function listar_jogadores(PDO $conexao)
{
    $sql = "SELECT j.*, t.nome AS time_nome
            FROM jogadores j
            JOIN times t ON t.id = j.time_id
            ORDER BY j.nome";
    return $conexao->query($sql)->fetchAll();
}

function listar_jogadores_do_time(PDO $conexao, $time_id)
{
    $sql = "SELECT j.*, t.nome AS time_nome
            FROM jogadores j
            JOIN times t ON t.id = j.time_id
            WHERE j.time_id = :time_id
            ORDER BY j.nome";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([':time_id' => (int) $time_id]);
    return $stmt->fetchAll();
}

function consultar_jogador(PDO $conexao, $id)
{
    $sql = "SELECT j.*, t.nome AS time_nome
            FROM jogadores j
            JOIN times t ON t.id = j.time_id
            WHERE j.id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([':id' => (int) $id]);
    return $stmt->fetch(); // array ou false se não existir
}

function atualizar_jogador(PDO $conexao, $id, $time_id, $nome, $cpf, $nasc, $telefone, $nome_responsavel, $telefone_responsavel)
{
    $sql = "UPDATE jogadores
            SET time_id = :time_id,
                nome = :nome,
                cpf = :cpf,
                data_nascimento = :nasc,
                telefone = :telefone,
                nome_responsavel = :nome_resp,
                telefone_responsavel = :tel_resp
            WHERE id = :id";

    $stmt = $conexao->prepare($sql);
    $stmt->execute([
        ':time_id'   => (int) $time_id,
        ':nome'      => $nome,
        ':cpf'       => $cpf,
        ':nasc'      => $nasc,
        ':telefone'  => vazio_para_null($telefone),
        ':nome_resp' => vazio_para_null($nome_responsavel),
        ':tel_resp'  => vazio_para_null($telefone_responsavel),
        ':id'        => (int) $id,
    ]);
    return $stmt->rowCount();
}

function deletar_jogador(PDO $conexao, $id)
{
    $stmt = $conexao->prepare("DELETE FROM jogadores WHERE id = :id");
    $stmt->execute([':id' => (int) $id]);
    return $stmt->rowCount();
}

/* ============================================================
 * TABELAS HTML (reaproveitadas nas páginas de listagem)
 * ============================================================ */

function exibir_tabela_times(array $times)
{
    if (!$times) {
        echo "<p>Nenhum time cadastrado.</p>";
        return;
    }
    echo "<table border='1' cellpadding='6'>";
    echo "<tr><th>ID</th><th>Time</th><th>Técnico</th><th>CPF do técnico</th><th>Nascimento</th><th>Telefone</th></tr>";
    foreach ($times as $t) {
        echo "<tr>";
        echo "<td>" . h($t['id']) . "</td>";
        echo "<td>" . h($t['nome']) . "</td>";
        echo "<td>" . h($t['tecnico']) . "</td>";
        echo "<td>" . h($t['cpf_tecnico']) . "</td>";
        echo "<td>" . h($t['data_nascimento']) . "</td>";
        echo "<td>" . h($t['telefone']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

function exibir_tabela_jogadores(array $jogadores)
{
    if (!$jogadores) {
        echo "<p>Nenhum jogador encontrado.</p>";
        return;
    }
    echo "<table border='1' cellpadding='6'>";
    echo "<tr><th>ID</th><th>Jogador</th><th>Time</th><th>CPF</th><th>Nascimento</th><th>Telefone</th><th>Responsável</th><th>Tel. responsável</th><th>Gols</th></tr>";
    foreach ($jogadores as $j) {
        echo "<tr>";
        echo "<td>" . h($j['id']) . "</td>";
        echo "<td>" . h($j['nome']) . "</td>";
        echo "<td>" . h($j['time_nome']) . "</td>";
        echo "<td>" . h($j['cpf']) . "</td>";
        echo "<td>" . h($j['data_nascimento']) . "</td>";
        echo "<td>" . h($j['telefone']) . "</td>";
        echo "<td>" . h($j['nome_responsavel']) . "</td>";
        echo "<td>" . h($j['telefone_responsavel']) . "</td>";
        echo "<td>" . h($j['gols']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

// Gera as <option> de um <select> com todos os times
function opcoes_times(PDO $conexao, $selecionado = null)
{
    foreach (listar_times($conexao) as $t) {
        $sel = ((string) $t['id'] === (string) $selecionado) ? ' selected' : '';
        echo "<option value='" . (int) $t['id'] . "'$sel>" . h($t['nome']) . "</option>";
    }
}

/* ============================================================
 * USUÁRIOS (login)
 * ============================================================ */

function cadastrar_user(PDO $conexao, $email, $senha)
{
    $stmt = $conexao->prepare("INSERT INTO usuarios (email, senha) VALUES (:email, :senha)");
    return $stmt->execute([
        ':email' => $email,
        ':senha' => password_hash($senha, PASSWORD_DEFAULT), // nunca guardar senha pura
    ]);
}

function consultar_user(PDO $conexao, $email)
{
    $stmt = $conexao->prepare("SELECT id, email, senha FROM usuarios WHERE email = :email");
    $stmt->execute([':email' => $email]);
    return $stmt->fetch(); // array ou false
}
