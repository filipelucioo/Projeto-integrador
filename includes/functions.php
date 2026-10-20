<?php
require_once __DIR__ . '/../database/conect.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// endereço base do site (funciona em qualquer pasta e em qualquer página)
if (!defined('BASE_URL')) {
    $script_name = $_SERVER['SCRIPT_NAME'] ?? '';
    $dir_name = str_replace('\\', '/', dirname($script_name));
    $clean_dir = preg_replace('#/(app|login|includes|database)$#i', '', $dir_name);
    define('BASE_URL', rtrim($clean_dir, '/') . '/');
}

// escapa o texto antes de mostrar na tela
function h($valor)
{
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
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
        // erro 23503 = o time (ou um jogador dele) já tem partidas registradas
        if ($e->getCode() == '23503') {
            echo "Não é possível deletar: o time já tem partidas registradas.";
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
    try {
        $sql = "DELETE FROM jogadores WHERE id = :id";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Jogador $id deletado.";
        } else {
            echo "Jogador não encontrado.";
        }
    } catch (PDOException $e) {
        // erro 23503 = o jogador tem gols registrados em partidas
        if ($e->getCode() == '23503') {
            echo "Não é possível deletar: o jogador tem gols registrados em partidas.";
        } else {
            echo "Erro ao deletar jogador: " . h($e->getMessage());
        }
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

/* ================= PARTIDAS ================= */

// salva a partida na tabela jogos e soma os gols dos jogadores
// $autores_gols = [id_do_jogador => quantidade_de_gols]
function registrar_partida($conexao, $time_casa_id, $time_fora_id, $gols_casa, $gols_fora, $data_jogo, $autores_gols)
{
    $time_casa_id = (int)$time_casa_id;
    $time_fora_id = (int)$time_fora_id;
    $gols_casa = (int)$gols_casa;
    $gols_fora = (int)$gols_fora;

    if ($time_casa_id <= 0 || $time_fora_id <= 0) {
        echo "Selecione os dois times.";
        return;
    }

    if ($time_casa_id == $time_fora_id) {
        echo "Os times da partida precisam ser diferentes.";
        return;
    }

    if ($gols_casa < 0 || $gols_fora < 0) {
        echo "O placar não pode ser negativo.";
        return;
    }

    try {
        // jogadores que pertencem aos dois times: [id_jogador => id_time]
        $sql = "SELECT id, time_id FROM jogadores WHERE time_id IN (:casa, :fora)";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":casa", $time_casa_id);
        $stmt->bindParam(":fora", $time_fora_id);
        $stmt->execute();

        $jogadores_dos_times = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

        // confere os gols dos jogadores
        $soma_casa = 0;
        $soma_fora = 0;
        $gols_para_somar = [];

        foreach ($autores_gols as $jogador_id => $gols) {
            $jogador_id = (int)$jogador_id;
            $gols = (int)$gols;

            if ($gols <= 0) {
                continue;
            }

            if (!isset($jogadores_dos_times[$jogador_id])) {
                echo "Jogador inválido para essa partida.";
                return;
            }

            if ($jogadores_dos_times[$jogador_id] == $time_casa_id) {
                $soma_casa += $gols;
            } else {
                $soma_fora += $gols;
            }

            $gols_para_somar[$jogador_id] = $gols;
        }

        if ($soma_casa > $gols_casa || $soma_fora > $gols_fora) {
            echo "Os gols dos jogadores não podem passar do placar do time.";
            return;
        }

        // salva tudo junto: se der erro em um passo, nada é salvo
        $conexao->beginTransaction();

        $sql = "INSERT INTO jogos (time_casa_id, time_fora_id, gols_casa, gols_fora, data_jogo)
                VALUES (:casa, :fora, :gols_casa, :gols_fora, :data_jogo)
                RETURNING id";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":casa", $time_casa_id);
        $stmt->bindParam(":fora", $time_fora_id);
        $stmt->bindParam(":gols_casa", $gols_casa);
        $stmt->bindParam(":gols_fora", $gols_fora);
        $stmt->bindParam(":data_jogo", $data_jogo);
        $stmt->execute();

        $jogo_id = $stmt->fetchColumn(); // id do jogo que acabou de ser salvo

        // soma no total do jogador (artilharia)
        $sql = "UPDATE jogadores SET gols = gols + :gols WHERE id = :id";
        $stmt_total = $conexao->prepare($sql);

        // guarda os gols desse jogo (histórico da tabela)
        $sql = "INSERT INTO jogo_gols (jogo_id, jogador_id, quantidade)
                VALUES (:jogo_id, :jogador_id, :quantidade)";
        $stmt_jogo = $conexao->prepare($sql);

        foreach ($gols_para_somar as $jogador_id => $gols) {
            $stmt_total->bindParam(":gols", $gols);
            $stmt_total->bindParam(":id", $jogador_id);
            $stmt_total->execute();

            $stmt_jogo->bindParam(":jogo_id", $jogo_id);
            $stmt_jogo->bindParam(":jogador_id", $jogador_id);
            $stmt_jogo->bindParam(":quantidade", $gols);
            $stmt_jogo->execute();
        }

        $conexao->commit();

        echo "Partida registrada com sucesso!";
    } catch (PDOException $e) {
        if ($conexao->inTransaction()) {
            $conexao->rollBack();
        }
        echo "Erro ao registrar partida: " . h($e->getMessage());
    }
}

function listar_partidas($conexao)
{
    $sql = "SELECT p.*, c.nome AS time_casa, f.nome AS time_fora
            FROM jogos p
            JOIN times c ON c.id = p.time_casa_id
            JOIN times f ON f.id = p.time_fora_id
            ORDER BY p.data_jogo DESC, p.id DESC";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    $partidas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$partidas) {
        echo "Nenhuma partida registrada.";
    }

    foreach ($partidas as $partida) {
        echo "<hr>";
        echo "Data: " . h(date('d/m/Y', strtotime($partida['data_jogo']))) . " <br>";
        echo h($partida['time_casa']) . " " . h($partida['gols_casa']) . " x " . h($partida['gols_fora']) . " " . h($partida['time_fora']) . " <br>";
    }
}

/* ================= TABELA E ARTILHARIA ================= */

// monta a classificação a partir dos jogos (3 pontos vitória, 1 empate)
function obter_tabela_classificacao($conexao)
{
    $times = $conexao->query("SELECT id, nome FROM times")->fetchAll(PDO::FETCH_ASSOC);

    $tabela = [];
    foreach ($times as $time) {
        $tabela[$time['id']] = [
            'nome' => $time['nome'],
            'P' => 0, 'J' => 0, 'V' => 0, 'E' => 0, 'D' => 0,
            'GP' => 0, 'GC' => 0, 'SG' => 0
        ];
    }

    $sql = "SELECT time_casa_id, time_fora_id, gols_casa, gols_fora FROM jogos";
    $jogos = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    foreach ($jogos as $jogo) {
        $casa = $jogo['time_casa_id'];
        $fora = $jogo['time_fora_id'];
        $gols_casa = (int)$jogo['gols_casa'];
        $gols_fora = (int)$jogo['gols_fora'];

        $tabela[$casa]['J']++;
        $tabela[$fora]['J']++;

        $tabela[$casa]['GP'] += $gols_casa;
        $tabela[$casa]['GC'] += $gols_fora;
        $tabela[$fora]['GP'] += $gols_fora;
        $tabela[$fora]['GC'] += $gols_casa;

        if ($gols_casa > $gols_fora) {
            $tabela[$casa]['V']++;
            $tabela[$casa]['P'] += 3;
            $tabela[$fora]['D']++;
        } elseif ($gols_casa < $gols_fora) {
            $tabela[$fora]['V']++;
            $tabela[$fora]['P'] += 3;
            $tabela[$casa]['D']++;
        } else {
            $tabela[$casa]['E']++;
            $tabela[$casa]['P']++;
            $tabela[$fora]['E']++;
            $tabela[$fora]['P']++;
        }
    }

    foreach ($tabela as $id => $linha) {
        $tabela[$id]['SG'] = $linha['GP'] - $linha['GC'];
    }

    // ordem: pontos, vitórias, saldo de gols, gols pró e nome
    $tabela = array_values($tabela);
    usort($tabela, function ($a, $b) {
        if ($a['P'] != $b['P']) { return $b['P'] <=> $a['P']; }
        if ($a['V'] != $b['V']) { return $b['V'] <=> $a['V']; }
        if ($a['SG'] != $b['SG']) { return $b['SG'] <=> $a['SG']; }
        if ($a['GP'] != $b['GP']) { return $b['GP'] <=> $a['GP']; }
        return strcmp($a['nome'], $b['nome']);
    });

    return $tabela;
}

// histórico de jogos, do mais novo para o mais antigo
function listar_historico_jogos($conexao)
{
    $sql = "SELECT j.*, t1.nome AS time_casa, t2.nome AS time_fora
            FROM jogos j
            JOIN times t1 ON t1.id = j.time_casa_id
            JOIN times t2 ON t2.id = j.time_fora_id
            ORDER BY j.data_jogo DESC, j.id DESC";

    return $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

// quem marcou em cada jogo: [id_do_jogo => [ ['nome' => ..., 'quantidade' => ...], ... ]]
function listar_goleadores_por_jogo($conexao)
{
    $sql = "SELECT jg.jogo_id, j.nome, jg.quantidade
            FROM jogo_gols jg
            JOIN jogadores j ON j.id = jg.jogador_id
            ORDER BY jg.quantidade DESC, j.nome";

    $linhas = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    $goleadores = [];
    foreach ($linhas as $linha) {
        $goleadores[$linha['jogo_id']][] = $linha;
    }

    return $goleadores;
}

function listar_artilheiros($conexao)
{
    $sql = "SELECT j.nome, j.gols, t.nome AS time_nome
            FROM jogadores j
            JOIN times t ON t.id = j.time_id
            WHERE j.gols > 0
            ORDER BY j.gols DESC, j.nome ASC
            LIMIT 25";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/* ================= USUÁRIOS (login) ================= */

function cadastrar_user($conexao, $email, $senha)
{
    try {
        $sql = "INSERT INTO usuarios (email, senha) VALUES (:email, :senha)";

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT); // nunca salvar a senha pura

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha_hash);
        $stmt->execute();

        echo "Usuário cadastrado com sucesso!";
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
