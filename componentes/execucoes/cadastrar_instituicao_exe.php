<div class="loader"></div>
<script src="../../js/loading.js" defer></script>
<?php
// Inclui a definição da classe `Instituicao`, que deve conter os métodos necessários para manipulação de dados de usuário
require_once '../classes/instituicao_class.php';

// Obtém os valores enviados pelo formulário via POST
$nomeInstituicao = $_POST['nome']; // Nome da Instituição
$tipoInstituicao = $_POST['tipo_instituicao']; // Tipo da Instituição

// Verifica se todos os campos necessários foram enviados
if (isset($nomeInstituicao) && isset($tipoInstituicao)) {
    // Cria uma nova instância da classe `Instituicao`
    $instituicao = new Instituicao();
    $instituicao->Cadastrar($nomeInstituicao, $tipoInstituicao);

    // Redireciona para a página de times após o cadastro ser realizado com sucesso
    header("Location: ../../pages/times.php");
} else {
    $_SESSION['error'] = "O nome e o tipo da instituição devem estar definidos";
    // Se algum dos campos obrigatórios não está presente, redireciona de volta para a página de cadastro de usuário
    header("Location: ../../pages/cadastrar_instituicao.php");
}
