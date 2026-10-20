<?php
$host = "192.168.10.18";
$dbname = "campeonato";
$user = "campeonato";
$pass = "campeonato";

try {
    $conexao = new PDO(
        "pgsql:host=$host;dbname=$dbname",
        $user,
        $pass
    );
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // sem conexão o site não funciona, então para aqui
    die("Erro ao conectar no banco de dados: " . $e->getMessage());
}
