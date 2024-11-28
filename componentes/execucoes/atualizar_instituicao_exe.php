<div class="loader"></div>
<script src="../../js/loading.js" defer></script>
<?php
require_once '../protect.php';
require_once '../classes/instituicao_class.php';
$idInstituicao = intval($_POST['id_instituicao']);
$nomeInstituicao = $_POST['nome']; // Nome da Instituição
$tipoInstituicao = $_POST['tipo_instituicao']; // Tipo da Instituição
if (isset($nomeInstituicao) && isset($tipoInstituicao) && isset($idInstituicao)) {
    $isntituicao = Instituicao::GetInstituicao($idInstituicao);
    $isntituicao->Atualizar($nomeInstituicao, $tipoInstituicao);
} else {
    $_SESSION['error'] = "O nome, o tipo e o identificador da instituição devem estar definidos";
}
header("Location: ../../pages/cadastrar_instituicao.php");
?>