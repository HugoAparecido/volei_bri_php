<?php
// Inclui arquivos PHP necessários
require_once '../protect.php'; // Protege a página contra acessos não autorizados
require_once '../classes/instituicao_class.php'; // Define a classe Instituicao para manipular dados

// Obtém os dados enviados via POST
$idInstituicao = intval($_POST['id_instituicao']); // Converte o ID da instituição para inteiro
$nomeInstituicao = $_POST['nome']; // Nome da Instituição
$tipoInstituicao = $_POST['tipo_instituicao']; // Tipo da Instituição

// Verifica se todos os campos necessários foram enviados
if (isset($nomeInstituicao) && isset($tipoInstituicao) && isset($idInstituicao)) {
    // Busca a instituição no banco de dados pelo ID
    $instituicao = Instituicao::GetInstituicao($idInstituicao);

    // Atualiza os dados da instituição com os valores recebidos
    $instituicao->Atualizar($nomeInstituicao, $tipoInstituicao);
} else {
    // Define uma mensagem de erro caso algum campo esteja ausente
    $_SESSION['error'] = "O nome, o tipo e o identificador da instituição devem estar definidos";
}

// Redireciona o usuário para a página de cadastro de instituições
header("Location: ../../pages/cadastrar_instituicao.php");