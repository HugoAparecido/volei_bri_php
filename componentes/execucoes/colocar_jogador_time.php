<?php
require_once '../classes/time_class.php';
session_start();
$idJogador = $_POST['novo_jogador_libero'];
$idTime = $_POST['id_time'];
$posicao = 'Líbero';
// $posicao = $_POST['posicao'];
if (isset($idJogador) && isset($idTime) && isset($posicao)) {
    $time = new Time();
    $time->AdicionarJogadorAoTime((int)$idJogador, (int)$idTime, $posicao);
    // header("Location: ../../pages/times.php");
} else {
    header("Location: ../../pages/times.php");
}
