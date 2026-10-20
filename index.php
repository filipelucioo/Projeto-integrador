<?php
$page_title = "Página Inicial";
require_once __DIR__ . '/includes/functions.php';
include __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <h1>🏆 Seja bem-vindo à Copa Bololô</h1>
    <p>O palco do futebol amador raiz e da resenha de fim de semana</p>
</div>

<div class="grid-2">
    <div class="card">
        <h2>Quem Somos</h2>
        <p>O Campeonato Bololô nasceu da paixão pelo futebol raiz e da resenha de fim de semana. Somos uma liga de futebol amador criada para dar palco aos times montados na rua, no bairro, na faculdade ou no trabalho.</p>
        <p style="margin-top: 1rem;">Aqui, a sua turma de amigos deixa de jogar apenas partidas avulsas e ganha um campeonato de verdade para disputar.</p>
    </div>

    <div class="card">
        <h2>O Que Fazemos</h2>
        <ul style="padding-left: 1.2rem; line-height: 1.8;">
            <li><strong>Gestão de Competição:</strong> Elaboração de tabelas, fases de grupos, mata-mata e agendamento de jogos.</li>
            <li><strong>Infraestrutura Completa:</strong> Reserva de campos de qualidade e arbitragem imparcial.</li>
            <li><strong>Estatísticas e Mídia:</strong> Acompanhamento de classificação, artilharia, cartões e destaques da rodada.</li>
        </ul>
    </div>
</div>

<div class="card shadow">
    <h2>📋 Regras do Campeonato</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Diretriz</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Formação de Equipe</strong></td>
                <td>Cada time deve ter entre 7 e 15 jogadores inscritos (amigos, familiares ou conhecidos).</td>
            </tr>
            <tr>
                <td><strong>Uniformes</strong></td>
                <td>Jogadores da mesma equipe devem usar camisas de cor padronizada.</td>
            </tr>
            <tr>
                <td><strong>Duração da Partida</strong></td>
                <td>2 tempos de 20 minutos, com intervalo de 5 minutos.</td>
            </tr>
            <tr>
                <td><strong>Pontualidade</strong></td>
                <td>Tolerância de 10 minutos. Atrasos superiores geram derrota por W.O. (3 x 0).</td>
            </tr>
            <tr>
                <td><strong>Substituições</strong></td>
                <td>Livres e volantes (ilimitadas), com paralisação autorizada pelo árbitro.</td>
            </tr>
            <tr>
                <td><strong>Disciplina</strong></td>
                <td>Cartão amarelo = advertência. Cartão vermelho = expulsão e suspensão automática na rodada seguinte.</td>
            </tr>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
