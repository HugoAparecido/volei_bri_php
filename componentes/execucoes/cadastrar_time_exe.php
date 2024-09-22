<?php
require_once '../classes/time_class.php';
session_start();
$nomeTime = $_POST['nome_time'];
$sexoTime = $_POST['sexo_time'];
$instituicaoTime = $_POST['instituicao'];
if (isset($nomeTime) && isset($sexoTime) && isset($instituicaoTime)) {
    $time = new Time();
    $time->Cadastrar($nomeTime, $sexoTime, (int)$_SESSION['id_usuario'], (int)$instituicaoTime);
    header("Location: ../../pages/times.php");
} else {
    header("Location: ../../pages/cadastrar_time.php");
}
