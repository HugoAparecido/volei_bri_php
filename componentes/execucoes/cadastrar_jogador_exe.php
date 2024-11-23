<div class="loader"></div>
<script src="../../js/loading.js" defer></script>
<?php
// Inclui arquivos de classe necessários para o código, cada um representando um tipo de jogador com métodos específicos.
require_once '../classes/libero_class.php'; // Inclui a classe Libero
require_once '../classes/levantador_class.php'; // Inclui a classe Levantador
require_once '../classes/outras_posicoes_class.php'; // Inclui a classe OutrasPosicoes

// Obtém os dados enviados pelo formulário via POST
$nomeJogador = $_POST['nome_jogador'];
$apelidoJogador = $_POST['apelido_jogador'];
$numCamisaJogador = $_POST['num_camisa_jogador'];
$posicaoJogador = $_POST['posicao_jogador'];
$sexoJogador = $_POST['sexo_jogador'];
$alturaJogador = $_POST['altura_jogador'];
$pesoJogador = $_POST['peso_jogador'];

// Verifica se os dados obrigatórios (nome, posição e sexo) estão definidos
if (isset($nomeJogador) && isset($posicaoJogador) && isset($sexoJogador)) {
    // Cria um objeto da classe apropriada com base na posição do jogador
    if ($posicaoJogador === "Líbero") {
        // Se a posição for "Líbero", cria um objeto da classe Libero e chama o método para cadastrar o jogador
        $obLibero = new Libero();
        $obLibero->CadastrarLibero($nomeJogador, $sexoJogador, $apelidoJogador, $numCamisaJogador, $alturaJogador, $pesoJogador);
    } elseif ($posicaoJogador === "Levantador") {
        // Se a posição for "Levantador", cria um objeto da classe Levantador e chama o método para cadastrar o jogador
        $obLevantador = new Levantador();
        $obLevantador->CadastrarLevantador($nomeJogador, $sexoJogador, $apelidoJogador, $numCamisaJogador, $alturaJogador, $pesoJogador);
    } else {
        // Para outras posições, cria um objeto da classe OutrasPosicoes e chama o método para cadastrar o jogador
        $obOutrasPosicoes = new OutrasPosicoes();
        $obOutrasPosicoes->CadastrarPosicao($nomeJogador, $sexoJogador, $posicaoJogador, $apelidoJogador, $numCamisaJogador, $alturaJogador, $pesoJogador);
    }
} else {
    // Se os dados obrigatórios não estiverem definidos, exibe uma mensagem de erro
    echo "Não foi possível cadastrar o jogador";
}

// Redireciona o usuário para a página onde os jogadores cadastrados são exibidos
header("Location: ../../pages/times.php");