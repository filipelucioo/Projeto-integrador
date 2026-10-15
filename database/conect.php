<?php 
$host = "192.168.10.18";
$dbname = "campeonato";
$user = "campeonato";
$pass = "campeonato";

try {
    $conexao = new PDO (
        "pgsql:host=$host;dbname=$dbname",
        $user,
        $pass
    );
} catch (PDOException $e) {
    echo "Erro " . $e->getMessage(); 


}
?>