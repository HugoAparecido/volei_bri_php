<?php
require_once '../protect.php';
include '../classes/instituicao_class.php';
var_dump($_GET);
switch ($_GET['classe']) {
    case 'instituicao':
        $instituicao = Instituicao::GetInstituicao(intval($_GET['id']));
        $instituicao->Excluir();
        break;
}
header("Location: ../../pages/cadastrar_instituicao.php");