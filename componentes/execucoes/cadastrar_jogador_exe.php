<?php
require_once './classes/libero_class.php';
require_once './classes/levantador_class.php';
require_once './classes/outras_posicoes_class.php';
$nomeJogador = $_POST['nome_jogador'];
$apelidoJogador = $_POST['apelido_jogador'];
$numCamisaJogador = $_POST['num_camisa_jogador'];
$posicaoJogador = $_POST['posicao_jogador'];
$sexoJogador = $_POST['sexo_jogador'];
$alturaJogador = $_POST['altura_jogador'];
$pesoJogador = $_POST['peso_jogador'];
if (isset($nomeJogador) && isset($posicaoJogador) && isset($sexoJogador)) {
    if ($posicaoJogador === "Líbero") {
        $obLibero = new Libero(null, $nomeJogador, $apelidoJogador, $numCamisaJogador, $alturaJogador, $pesoJogador, $sexoJogador);
        $obLibero->CadastrarLibero();
    } elseif ($posicaoJogador === "Levantador") {
        $obLevantador = new Levantador(null, $nomeJogador, $apelidoJogador, $numCamisaJogador, $alturaJogador, $pesoJogador, $sexoJogador);
        $obLevantador->CadastrarLevantador();
    } else {
        $obOutrasPosicoes = new OutrasPosicoes(null, $nomeJogador, $apelidoJogador, $numCamisaJogador, $alturaJogador, $pesoJogador, $sexoJogador, $posicaoJogador);
        $obOutrasPosicoes->CadastrarPosicao();
    }
} else {
    echo "Não foi possível cadastrar o jogador";
}
header("Location: ../pages/exibir_jogadores.php");
