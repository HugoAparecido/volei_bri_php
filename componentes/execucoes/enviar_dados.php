<?php
include_once '../classes/jogador_time_class.php';
include_once '../classes/levantador_class.php';
include_once '../classes/libero_class.php';
include_once '../classes/outras_posicoes_class.php';
if (isset($_POST)) {
    $jogadores_no_time = new JogadorTime();
    $jogadores = array_slice($_POST, 1);
    foreach ($jogadores as $idJogador => $jogador) {
        $idJogador = explode('_', $idJogador)[1];
        $posicao = $jogador['posicao'];
        unset($jogador['posicao']);
        $jogador = array_map('intval', $jogador);
        $jogadores_no_time->AtualizarEstatisticas($idJogador, $_POST['id_time'], $jogador);
        $jogadorOB = new Jogador();
        $defesas = ['erro_defesa' => $jogador['erro_defesa'], 'defesa_jogador' => $jogador['defesa_jogador']];
        $jogadorOB->AtualizarDefesas($idJogador, $defesas);
        unset($jogador['defesa_jogador']);
        unset($jogador['erro_defesa']);
        if ($posicao == 'Levantador') {
            $levantador = new Levantador();
            $levantador->AtualizarEstatisticas($idJogador, $jogador);
        } elseif ($posicao == 'Líbero') {
            $libero = new Libero();
            $libero->AtualizarEstatisticas($idJogador, $jogador);
        } else {
            $outraPosicoes = new OutrasPosicoes();
            $outraPosicoes->AtualizarEstatisticas($idJogador, $posicao, $jogador);
        }
    }
    header("Location: ../../peges/times.php");
}
