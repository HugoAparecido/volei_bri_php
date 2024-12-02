<?php
// Inclui um arquivo que protege a página contra acessos não autorizados
require_once '../protect.php';

// Inclui os arquivos de classe necessários para manipular dados
include '../classes/instituicao_class.php'; // Classe relacionada à instituição
include '../classes/jogador_class.php';    // Classe relacionada ao jogador
include '../classes/time_class.php';       // Classe relacionada ao time

// Exibe o conteúdo da superglobal $_GET para depuração (apenas para testes)
var_dump($_GET);

// Verifica o valor de 'classe' na URL e executa ações com base nele
switch ($_GET['classe']) {
    case 'instituicao':
        // Busca a instituição pelo ID informado e a exclui
        $instituicao = Instituicao::GetInstituicao(intval($_GET['id']));
        $instituicao->Excluir();
        break;

    case 'jogador':
        // Busca o jogador pelo ID informado e o exclui
        $jogador = Jogador::getJogador(intval($_GET['id']));
        $jogador->Excluir();
        break;

    case 'time':
        // Busca o time pelo ID informado e o exclui
        $time = Time::GetTime(intval($_GET['id']));
        $time->Excluir();
        break;

    default:
        // Caso o valor de 'classe' não corresponda a nenhum dos casos acima
        // Você pode incluir um tratamento aqui, como redirecionar ou registrar um erro
        break;
}

// Redireciona o usuário para a página inicial após a execução da ação
header("Location: ../../index.php");