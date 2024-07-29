<?php
$nomeJogador = $_POST['nome_jogador'];
$apelidoJogador = $_POST['apelido_jogador'];
$numCamisaJogador = $_POST['num_camisa_jogador'];
$posicaoJogador = $_POST['posicao_jogador'];
$sexoJogador = $_POST['sexo_jogador'];
$alturaJogador = $_POST['altura_jogador'];
$pesoJogador = $_POST['peso_jogador'];
if ($posicaoJogador === "Líbero") {
    $obLibero = new Libero(null, $nomeJogador, $apelidoJogador, $numCamisaJogador, $alturaJogador, $pesoJogador, $sexoJogador);
    $obLibero->CadastrarLibero();
}
