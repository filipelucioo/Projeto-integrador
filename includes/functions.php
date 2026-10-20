<?php
include_once __DIR__ . '/../database/conect.php';

function h($valor)
{
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}

/* ================= TIMES ================= */

function cadastrar_time($conexao, $nome, $tecnico, $cpf, $nasc, $telefone)
{
    if (!$conexao) {
        echo "<div class='alert alert-danger'>Sem conexão com o banco de dados.</div>";
        return;
    }
    try {
        $sql = "INSERT INTO times (nome, tecnico, cpf_tecnico, data_nascimento, telefone)
                VALUES (:nome, :tecnico, :cpf, :nasc, :telefone)";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":tecnico", $tecnico);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":nasc", $nasc);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->execute();

        echo "<div class='alert alert-success'>Time '$nome' cadastrado com sucesso!</div>";
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Erro ao cadastrar time: " . h($e->getMessage()) . "</div>";
    }
}

function deletar_time($conexao, $id)
{
    if (!$conexao) {
        echo "<div class='alert alert-danger'>Sem conexão com o banco de dados.</div>";
        return;
    }
    try {
        $sql = "DELETE FROM times WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<div class='alert alert-success'>Time ID #$id deletado com sucesso.</div>";
        } else {
            echo "<div class='alert alert-danger'>Time ID #$id não encontrado.</div>";
        }
    } catch (PDOException $e) {
        if ($e->getCode() == '23503' || strpos($e->getMessage(), 'foreign key') !== false) {
            echo "<div class='alert alert-danger'>Não é possível deletar: o time ainda tem jogadores associados.</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao deletar time: " . h($e->getMessage()) . "</div>";
        }
    }
}

function listar_times($conexao)
{
    if (!$conexao) {
        echo "<div class='alert alert-danger'>Sem conexão com o banco de dados.</div>";
        return;
    }
    $sql = "SELECT * FROM times ORDER BY id ASC";
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $times = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($times)) {
        echo "<p>Nenhum time cadastrado ainda.</p>";
        return;
    }

    echo "<table class='data-table'>";
    echo "<thead><tr><th>ID</th><th>Time</th><th>Técnico</th><th>CPF Técnico</th><th>Nascimento</th><th>Telefone</th></tr></thead>";
    echo "<tbody>";
    foreach ($times as $time) {
        echo "<tr>";
        echo "<td>#" . h($time['id']) . "</td>";
        echo "<td><strong>" . h($time['nome']) . "</strong></td>";
        echo "<td>" . h($time['tecnico']) . "</td>";
        echo "<td>" . h($time['cpf_tecnico']) . "</td>";
        echo "<td>" . h($time['data_nascimento']) . "</td>";
        echo "<td>" . h($time['telefone']) . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}

function consultar_time($conexao, $id)
{
    if (!$conexao) {
        echo "<div class='alert alert-danger'>Sem conexão com o banco de dados.</div>";
        return;
    }
    $sql = "SELECT * FROM times WHERE id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $time = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$time) {
        echo "<div class='alert alert-danger'>Time ID #$id não encontrado.</div>";
        return;
    }

    echo "<div class='card'>";
    echo "<h2>" . h($time['nome']) . "</h2>";
    echo "<p><strong>Técnico:</strong> " . h($time['tecnico']) . "</p>";
    echo "<p><strong>CPF Técnico:</strong> " . h($time['cpf_tecnico']) . "</p>";
    echo "<p><strong>Data Nasc. Técnico:</strong> " . h($time['data_nascimento']) . "</p>";
    echo "<p><strong>Telefone:</strong> " . h($time['telefone']) . "</p>";
    echo "<hr style='margin: 1rem 0;'>";

    echo "<h3>Elenco de Jogadores:</h3>";
    $sql_j = "SELECT id, nome, gols, cpf FROM jogadores WHERE time_id = :id ORDER BY nome ASC";
    $stmt_j = $conexao->prepare($sql_j);
    $stmt_j->bindParam(":id", $id);
    $stmt_j->execute();
    $jogadores = $stmt_j->fetchAll(PDO::FETCH_ASSOC);

    if (empty($jogadores)) {
        echo "<p class='text-muted'>Nenhum jogador cadastrado neste time.</p>";
    } else {
        echo "<table class='data-table'>";
        echo "<thead><tr><th>ID</th><th>Nome</th><th>CPF</th><th>Gols</th></tr></thead><tbody>";
        foreach ($jogadores as $j) {
            echo "<tr>";
            echo "<td>#" . h($j['id']) . "</td>";
            echo "<td>" . h($j['nome']) . "</td>";
            echo "<td>" . h($j['cpf']) . "</td>";
            echo "<td><span class='badge badge-goals'>" . h($j['gols']) . " Gols</span></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
    echo "</div>";
}

function atualizar_time($conexao, $id, $nome, $tecnico, $cpf, $nasc, $telefone)
{
    if (!$conexao) {
        echo "<div class='alert alert-danger'>Sem conexão com o banco de dados.</div>";
        return;
    }
    try {
        $sql = "UPDATE times SET nome = :nome, tecnico = :tecnico, cpf_tecnico = :cpf,
                data_nascimento = :nasc, telefone = :telefone WHERE id = :id";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":tecnico", $tecnico);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":nasc", $nasc);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<div class='alert alert-success'>Time ID #$id atualizado com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Nenhum dado alterado ou Time ID #$id não encontrado.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Erro ao atualizar time: " . h($e->getMessage()) . "</div>";
    }
}

/* ================= JOGADORES ================= */

function buscar_id_time($conexao, $nome_time)
{
    $sql = "SELECT id FROM times WHERE LOWER(nome) = LOWER(:nome)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":nome", $nome_time);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function cadastrar_jogador($conexao, $nome_time, $nome, $cpf, $nasc, $telefone, $nome_resp, $tel_resp)
{
    if (!$conexao) {
        echo "<div class='alert alert-danger'>Sem conexão com o banco de dados.</div>";
        return;
    }
    $time_id = buscar_id_time($conexao, $nome_time);

    if (!$time_id) {
        echo "<div class='alert alert-danger'>Time '$nome_time' não foi encontrado. Cadastre o time primeiro.</div>";
        return;
    }

    if ($nome_resp === '') { $nome_resp = null; }
    if ($tel_resp === '') { $tel_resp = null; }

    try {
        $sql = "INSERT INTO jogadores (time_id, nome, cpf, data_nascimento, telefone, nome_responsavel, telefone_responsavel)
                VALUES (:time_id, :nome, :cpf, :nasc, :telefone, :nome_resp, :tel_resp)";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":time_id", $time_id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":nasc", $nasc);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":nome_resp", $nome_resp);
        $stmt->bindParam(":tel_resp", $tel_resp);
        $stmt->execute();

        echo "<div class='alert alert-success'>Jogador '$nome' cadastrado com sucesso no time!</div>";
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Erro ao cadastrar jogador: " . h($e->getMessage()) . "</div>";
    }
}

function deletar_jogador($conexao, $id)
{
    if (!$conexao) {
        echo "<div class='alert alert-danger'>Sem conexão com o banco de dados.</div>";
        return;
    }
    try {
        $sql = "DELETE FROM jogadores WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<div class='alert alert-success'>Jogador ID #$id deletado com sucesso.</div>";
        } else {
            echo "<div class='alert alert-danger'>Jogador ID #$id não encontrado.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Erro ao deletar jogador: " . h($e->getMessage()) . "</div>";
    }
}

function listar_jogadores($conexao)
{
    if (!$conexao) {
        echo "<div class='alert alert-danger'>Sem conexão com o banco de dados.</div>";
        return;
    }
    $sql = "SELECT j.*, t.nome AS time_nome
            FROM jogadores j
            JOIN times t ON t.id = j.time_id
            ORDER BY j.id ASC";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $jogadores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($jogadores)) {
        echo "<p>Nenhum jogador cadastrado ainda.</p>";
        return;
    }

    echo "<table class='data-table'>";
    echo "<thead><tr><th>ID</th><th>Jogador</th><th>Time</th><th>CPF</th><th>Nascimento</th><th>Telefone</th><th>Gols</th></tr></thead>";
    echo "<tbody>";
    foreach ($jogadores as $jogador) {
        echo "<tr>";
        echo "<td>#" . h($jogador['id']) . "</td>";
        echo "<td><strong>" . h($jogador['nome']) . "</strong></td>";
        echo "<td><span class='badge badge-team'>" . h($jogador['time_nome']) . "</span></td>";
        echo "<td>" . h($jogador['cpf']) . "</td>";
        echo "<td>" . h($jogador['data_nascimento']) . "</td>";
        echo "<td>" . h($jogador['telefone']) . "</td>";
        echo "<td><span class='badge badge-goals'>" . h($jogador['gols']) . "</span></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}

function consultar_jogador($conexao, $id)
{
    if (!$conexao) {
        echo "<div class='alert alert-danger'>Sem conexão com o banco de dados.</div>";
        return null;
    }
    $sql = "SELECT j.*, t.nome AS time_nome
            FROM jogadores j
            JOIN times t ON t.id = j.time_id
            WHERE j.id = :id";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $jogador = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$jogador) {
        echo "<div class='alert alert-danger'>Jogador ID #$id não encontrado.</div>";
        return null;
    }

    echo "<div class='card'>";
    echo "<h2>" . h($jogador['nome']) . " <span class='badge badge-team'>" . h($jogador['time_nome']) . "</span></h2>";
    echo "<p><strong>CPF:</strong> " . h($jogador['cpf']) . "</p>";
    echo "<p><strong>Data Nasc:</strong> " . h($jogador['data_nascimento']) . "</p>";
    echo "<p><strong>Telefone:</strong> " . h($jogador['telefone']) . "</p>";
    echo "<p><strong>Gols:</strong> <span class='badge badge-goals'>" . h($jogador['gols']) . " Gols</span></p>";

    if ($jogador['nome_responsavel']) {
        echo "<hr style='margin:1rem 0;'>";
        echo "<p><strong>Responsável:</strong> " . h($jogador['nome_responsavel']) . "</p>";
        echo "<p><strong>Telefone do Responsável:</strong> " . h($jogador['telefone_responsavel']) . "</p>";
    }
    echo "</div>";

    return $jogador;
}

function atualizar_jogador($conexao, $id, $nome_time, $nome, $cpf, $nasc, $telefone, $nome_resp, $tel_resp)
{
    if (!$conexao) {
        echo "<div class='alert alert-danger'>Sem conexão com o banco de dados.</div>";
        return;
    }
    $time_id = buscar_id_time($conexao, $nome_time);

    if (!$time_id) {
        echo "<div class='alert alert-danger'>Time '$nome_time' não foi encontrado.</div>";
        return;
    }

    if ($nome_resp === '') { $nome_resp = null; }
    if ($tel_resp === '') { $tel_resp = null; }

    try {
        $sql = "UPDATE jogadores SET time_id = :time_id, nome = :nome, cpf = :cpf,
                data_nascimento = :nasc, telefone = :telefone,
                nome_responsavel = :nome_resp, telefone_responsavel = :tel_resp
                WHERE id = :id";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":time_id", $time_id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":nasc", $nasc);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":nome_resp", $nome_resp);
        $stmt->bindParam(":tel_resp", $tel_resp);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<div class='alert alert-success'>Jogador ID #$id atualizado com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Nenhum dado alterado ou Jogador ID #$id não encontrado.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Erro ao atualizar jogador: " . h($e->getMessage()) . "</div>";
    }
}

/* ================= USUÁRIOS (login) ================= */

function Cadastrar_user($conexao, $email, $senha)
{
    if (!$conexao) {
        echo "<div class='alert alert-danger'>Sem conexão com o banco de dados.</div>";
        return;
    }
    try {
        $sql = "INSERT INTO usuarios (email, senha) VALUES (:email, :senha)";

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha_hash);
        $stmt->execute();

        echo "<div class='alert alert-success'>Usuário cadastrado com sucesso! <a href='login.php'>Clique aqui para entrar</a>.</div>";
    } catch (PDOException $e) {
        if ($e->getCode() == '23505' || strpos($e->getMessage(), 'unique') !== false) {
            echo "<div class='alert alert-danger'>Este e-mail já está cadastrado no sistema.</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao cadastrar usuário: " . h($e->getMessage()) . "</div>";
        }
    }
}

function consultar_user($conexao, $email)
{
    if (!$conexao) return null;
    $sql = "SELECT id, email, senha FROM usuarios WHERE email = :email";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
