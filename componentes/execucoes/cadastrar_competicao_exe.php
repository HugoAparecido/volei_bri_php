<div class="loader"></div>
<script src="../../js/loading.js" defer></script>
<?php
// Inclui a definição da classe `Competicao`, que deve conter os métodos necessários para manipulação de dados de usuário
require_once '../classes/competicao_class.php';
require_once '../classes/competicao_time_class.php';

// Obtém os valores enviados pelo formulário via POST
$nomeCompeticao = $_POST['nome_competicao']; // Nome da Competição
$desafiante = intval($_POST['desafiante_competicao']);
$desafiado = ($_POST['desafiado_competicao'] == '' ? null : intval($_POST['desafiado_competicao']));

// Verifica se todos os campos necessários foram enviados
if (isset($nomeCompeticao) && isset($desafiante)) {
    // Cria uma nova instância da classe `Competicao`
    $Competicao = new Competicao();
    $dados = [$nomeCompeticao, $desafiante, $desafiado];
    $Competicao->Cadastrar($dados);
    $competicaoTime = new CompeticaoTime();
    $competicaoTime->Cadastrar([$Competicao->GetID(), $desafiante]);
    if ($desafiado == !null) {
        $competicaoTime->Cadastrar([$Competicao->GetID(), $desafiado]);
    }
    // Redireciona para a página de times após o cadastro ser realizado com sucesso
    header("Location: ../../pages/times.php");
} else {
    $_SESSION['error'] = "O nome e o desafiante devem estar definidos";
    // Se algum dos campos obrigatórios não está presente, redireciona de volta para a página
    header("Location: ../../pages/cadastrar_Competicao.php");
}
