<?php
include_once '../classes/jogador_time_class.php';
print_r($_POST);
$jogadores_no_time = new JogadorTime;
$jogadores = array_slice($_POST, 1);
foreach ($jogadores as $idJogador => $jogador) {
    echo "<pre>";
    print_r($jogador);
    echo "</pre>";
    $idJogador = explode('_', $idJogador)[0];
    echo $idJogador;
    $jogadores_no_time->AtualizarEstatisticas($idJogador, $_POST['id_time'], $jogador);
}
