<?php
require_once '../protect.php';
include '../classes/instituicao_class.php';
include '../classes/jogador_class.php';
include '../classes/time_class.php';
var_dump($_GET);
switch ($_GET['classe']) {
    case 'instituicao':
        $instituicao = Instituicao::GetInstituicao(intval($_GET['id']));
        $instituicao->Excluir();
        break;
    case 'jogador':
        $jogador = Jogador::getJogador(intval($_GET['id']));
        $jogador->Excluir();
        break;
    case 'time':
        $time = Time::GetTime(intval($_GET['id']));
        $time->Excluir();
        break;
}
header("Location: ../../index.php");