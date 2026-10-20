<?php
include __DIR__ . '/../database/conect.php';

// escapa o texto antes de mostrar na tela
function h($valor)
{
    return htmlspecialchars((string)$valor);
}

/* ================= TIMES ================= */

function cadastrar_time($conexao, $nome, $tecnico, $cpf, $nasc, $telefone)
{
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

        echo "Time cadastrado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao cadastrar time: " . h($e->getMessage());
    }
}

function deletar_time($conexao, $id)
{
    try {
        $sql = "DELETE FROM times WHERE id = :id";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Time $id deletado.";
        } else {
            echo "Time não encontrado.";
        }
    } catch (PDOException $e) {
        // erro 23503 = o time ainda tem jogadores
        if ($e->getCode() == '23503') {
            echo "Não é possível deletar: o time ainda tem jogadores.";
        } else {
            echo "Erro ao deletar time: " . h($e->getMessage());
        }
    }
}

function listar_times($conexao)
{
    $sql = "SELECT * FROM times ORDER BY id";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    $times = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($times as $time) {
        echo "<hr>";
        echo "ID: " . h($time['id']) . " <br>";
        echo "Time: " . h($time['nome']) . " <br>";
        echo "Técnico: " . h($time['tecnico']) . " <br>";
        echo "CPF do técnico: " . h($time['cpf_tecnico']) . " <br>";
        echo "Nascimento: " . h($time['data_nascimento']) . " <br>";
        echo "Telefone: " . h($time['telefone']) . " <br>";
    }
}

// mostra um time e os jogadores dele
function consultar_time($conexao, $id)
{
    $sql = "SELECT * FROM times WHERE id = :id";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $time = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$time) {
        echo "Time não encontrado.";
        return;
    }

    echo "Time: " . h($time['nome']) . " <br>";
    echo "Técnico: " . h($time['tecnico']) . " <br>";
    echo "CPF do técnico: " . h($time['cpf_tecnico']) . " <br>";
    echo "Nascimento: " . h($time['data_nascimento']) . " <br>";
    echo "Telefone: " . h($time['telefone']) . " <br>";

    echo "<h4>Jogadores do time:</h4>";

    $sql = "SELECT id, nome, gols FROM jogadores WHERE time_id = :id ORDER BY nome";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $jogadores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$jogadores) {
        echo "Nenhum jogador cadastrado nesse time.";
    }

    foreach ($jogadores as $jogador) {
        echo "ID: " . h($jogador['id']) . " - " . h($jogador['nome']) . " (Gols: " . h($jogador['gols']) . ") <br>";
    }
}

function atualizar_time($conexao, $id, $nome, $tecnico, $cpf, $nasc, $telefone)
{
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
            echo "Time atualizado com sucesso!";
        } else {
            echo "Time não encontrado.";
        }
    } catch (PDOException $e) {
        echo "Erro ao atualizar time: " . h($e->getMessage());
    }
}

/* ================= JOGADORES ================= */

// procura o id do time pelo nome (o formulário pede o nome do time)
function buscar_id_time($conexao, $nome_time)
{
    $sql = "SELECT id FROM times WHERE nome = :nome";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":nome", $nome_time);
    $stmt->execute();

    return $stmt->fetchColumn(); // false se não achar
}

function cadastrar_jogador($conexao, $nome_time, $nome, $cpf, $nasc, $telefone, $nome_resp, $tel_resp)
{
    $time_id = buscar_id_time($conexao, $nome_time);

    if (!$time_id) {
        echo "Time não encontrado. Cadastre o time primeiro.";
        return;
    }

    // responsável é opcional
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

        echo "Jogador cadastrado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao cadastrar jogador: " . h($e->getMessage());
    }
}

function deletar_jogador($conexao, $id)
{
    $sql = "DELETE FROM jogadores WHERE id = :id";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Jogador $id deletado.";
    } else {
        echo "Jogador não encontrado.";
    }
}

function listar_jogadores($conexao)
{
    $sql = "SELECT j.*, t.nome AS time_nome
            FROM jogadores j
            JOIN times t ON t.id = j.time_id
            ORDER BY j.id";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    $jogadores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($jogadores as $jogador) {
        echo "<hr>";
        echo "ID: " . h($jogador['id']) . " <br>";
        echo "Time: " . h($jogador['time_nome']) . " <br>";
        echo "Jogador: " . h($jogador['nome']) . " <br>";
        echo "CPF: " . h($jogador['cpf']) . " <br>";
        echo "Nascimento: " . h($jogador['data_nascimento']) . " <br>";
        echo "Telefone: " . h($jogador['telefone']) . " <br>";
        echo "Responsável: " . h($jogador['nome_responsavel']) . " <br>";
        echo "Telefone do responsável: " . h($jogador['telefone_responsavel']) . " <br>";
        echo "Gols: " . h($jogador['gols']) . " <br>";
    }
}

function consultar_jogador($conexao, $id)
{
    $sql = "SELECT j.*, t.nome AS time_nome
            FROM jogadores j
            JOIN times t ON t.id = j.time_id
            WHERE j.id = :id";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $jogador = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$jogador) {
        echo "Jogador não encontrado.";
        return;
    }

    echo "Jogador: " . h($jogador['nome']) . " <br>";
    echo "Time: " . h($jogador['time_nome']) . " <br>";
    echo "CPF: " . h($jogador['cpf']) . " <br>";
    echo "Nascimento: " . h($jogador['data_nascimento']) . " <br>";
    echo "Telefone: " . h($jogador['telefone']) . " <br>";
    echo "Responsável: " . h($jogador['nome_responsavel']) . " <br>";
    echo "Telefone do responsável: " . h($jogador['telefone_responsavel']) . " <br>";
    echo "Gols: " . h($jogador['gols']);
}

function atualizar_jogador($conexao, $id, $nome_time, $nome, $cpf, $nasc, $telefone, $nome_resp, $tel_resp)
{
    $time_id = buscar_id_time($conexao, $nome_time);

    if (!$time_id) {
        echo "Time não encontrado.";
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
            echo "Jogador atualizado com sucesso!";
        } else {
            echo "Jogador não encontrado.";
        }
    } catch (PDOException $e) {
        echo "Erro ao atualizar jogador: " . h($e->getMessage());
    }
}

/* ================= USUÁRIOS (login) ================= */

function Cadastrar_user($conexao, $email, $senha)
{
    try {
        $sql = "INSERT INTO usuarios (email, senha) VALUES (:email, :senha)";

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT); // nunca salvar a senha pura

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha_hash);
        $stmt->execute();

        echo "Usuario cadastrado com sucesso!";
    } catch (PDOException $e) {
        if ($e->getCode() == '23505') {
            echo "Esse e-mail já está cadastrado.";
        } else {
            echo "Erro ao cadastrar usuário: " . h($e->getMessage());
        }
    }
}

function consultar_user($conexao, $email)
{
    $sql = "SELECT id, email, senha FROM usuarios WHERE email = :email";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    return $usuario;
}
?>
