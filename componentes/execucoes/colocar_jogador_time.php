<?php
// Inclui a classe `Time`, necessária para manipulação de dados relacionados ao time
require_once '../classes/time_class.php';

// Inicia a sessão para acessar dados de sessão, se necessário
session_start();

// Recebe os IDs dos jogadores enviados via formulário POST, cada um representando uma posição específica
$idLibero = $_POST['novo_jogador_libero'];          // ID do jogador Líbero
$idLevantador = $_POST['novo_jogador_Levantador'];  // ID do jogador Levantador
$idOposto = $_POST['novo_jogador_oposto'];          // ID do jogador Oposto
$idPonta1 = $_POST['novo_jogador_ponta_1'];         // ID do jogador Ponta 1
$idPonta2 = $_POST['novo_jogador_ponta_2'];         // ID do jogador Ponta 2
$idCentral = $_POST['novo_jogador_central'];        // ID do jogador Central
$idOutraPosicao = $_POST['novo_jogador_outra_posicao']; // ID do jogador em outra posição
$idTime = $_POST['id_time'];                        // ID do time ao qual os jogadores serão adicionados

// Verifica se o ID do time foi fornecido
if (isset($idTime)) {
    // Cria uma nova instância da classe `Time`
    $time = new Time();

    // Verifica se cada ID de jogador foi informado e adiciona o jogador ao time na posição especificada
    if ($idLibero != "") {
        $time->AdicionarJogadorAoTime((int)$idLibero, (int)$idTime, 'Líbero'); // Adiciona Líbero
    }
    if ($idLevantador != "") {
        $time->AdicionarJogadorAoTime((int)$idLevantador, (int)$idTime, 'Levantador'); // Adiciona Levantador
    }
    if ($idOposto != "") {
        $time->AdicionarJogadorAoTime((int)$idOposto, (int)$idTime, 'Oposto'); // Adiciona Oposto
    }
    if ($idPonta1 != "") {
        $time->AdicionarJogadorAoTime((int)$idPonta1, (int)$idTime, 'Ponta 1'); // Adiciona Ponta 1
    }
    if ($idPonta2 != "") {
        $time->AdicionarJogadorAoTime((int)$idPonta2, (int)$idTime, 'Ponta 2'); // Adiciona Ponta 2
    }
    if ($idCentral != "") {
        $time->AdicionarJogadorAoTime((int)$idCentral, (int)$idTime, 'Central'); // Adiciona Central
    }
    if ($idOutraPosicao != "") {
        $time->AdicionarJogadorAoTime((int)$idOutraPosicao, (int)$idTime, 'Não Definida'); // Adiciona jogador em posição não definida
    }

    // Redireciona o usuário para a página de times após adicionar os jogadores
    header("Location: ../../pages/times.php");
} else {
    // Se o ID do time não foi fornecido, redireciona para a mesma página de times
    header("Location: ../../pages/times.php");
}
