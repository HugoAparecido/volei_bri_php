<?php
require_once '../classes/time_class.php';
session_start();
$idLibero = $_POST['novo_jogador_libero'];
$idLevantador = $_POST['novo_jogador_Levantador'];
$idOposto = $_POST['novo_jogador_oposto'];
$idPonta1 = $_POST['novo_jogador_ponta_1'];
$idPonta2 = $_POST['novo_jogador_ponta_2'];
$idCentral = $_POST['novo_jogador_central'];
$idOutraPosicao = $_POST['novo_jogador_outra_posicao'];
$idTime = $_POST['id_time'];
// $posicao = $_POST['posicao'];
if (isset($idTime)) {
    $time = new Time();
    if (isset($idLibero)) {
        $time->AdicionarJogadorAoTime((int)$idLibero, (int)$idTime, 'Líbero');
    }
    if (isset($idLevantador)) {
        $time->AdicionarJogadorAoTime((int)$idLevantador, (int)$idTime, 'Levantador');
    }
    if (isset($idOposto)) {
        $time->AdicionarJogadorAoTime((int)$idOposto, (int)$idTime, 'Oposto');
    }
    if (isset($idPonta1)) {
        $time->AdicionarJogadorAoTime((int)$idPonta1, (int)$idTime, 'Ponta 1');
    }
    if (isset($idPonta2)) {
        $time->AdicionarJogadorAoTime((int)$idPonta2, (int)$idTime, 'Ponta 2');
    }
    if (isset($idCentral)) {
        $time->AdicionarJogadorAoTime((int)$idCentral, (int)$idTime, 'Central');
    }
    if (isset($idOutraPosicao)) {
        $time->AdicionarJogadorAoTime((int)$idOutraPosicao, (int)$idTime, 'Não Definida');
    }
    // header("Location: ../../pages/times.php");
} else {
    header("Location: ../../pages/times.php");
}
