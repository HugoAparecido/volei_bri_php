<?php
include_once '../classes/jogador_time_class.php';
if (isset($_POST)) {
    $jogadores_no_time = new JogadorTime();
    $jogadores = array_slice($_POST, 1);
    foreach ($jogadores as $idJogador => $jogador) {
        $idJogador = explode('_', $idJogador)[1];
        var_dump($jogador);
        $jogador = array_map('intval', $jogador);
        var_dump($jogador);
        $jogadores_no_time->AtualizarEstatisticas($idJogador, $_POST['id_time'], $jogador);
    }
}
header("Location: ../../peges/times.php");
