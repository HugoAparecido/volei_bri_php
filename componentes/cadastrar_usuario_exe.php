<?php
require_once './classes/usuario_class.php';
$nomeUsuario = $_POST['nome'];
$emailUsuario = $_POST['email'];
$senhaUsuario = $_POST['senha'];
$eJogador = $_POST['jogador'];
$eTreinador = $_POST['treinador'];
if (isset($nomeUsuario) && isset($emailUsuario) && isset($senhaUsuario) && isset($eJogador) && isset($eTreinador)) {
    $usuario = new Usuario;
    $usuario->Cadastrar($nomeUsuario, $emailUsuario, $senhaUsuario, $eJogador, $eTreinador);
} else {
    echo "Não foi possível cadastrar o Uusario";
}
header("Location: ../pages/times.php");
