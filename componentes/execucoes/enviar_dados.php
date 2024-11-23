<div class="loader"></div>
<script src="../../js/loading.js" defer></script>
<?php
// Inclui as classes necessárias para lidar com as operações de atualização de estatísticas
include_once '../classes/jogador_time_class.php';
include_once '../classes/levantador_class.php';
include_once '../classes/libero_class.php';
include_once '../classes/outras_posicoes_class.php';
include_once '../classes/competicao_time_class.php';

// Verifica se há dados enviados via POST
if (isset($_POST)) {
    // Instancia a classe para manipulação dos jogadores do time
    $jogadores_no_time = new JogadorTime();

    // Extrai os dados dos jogadores, ignorando o primeiro elemento (id_time)
    $jogadores = array_slice($_POST, 2);
    $resultado = [];
    // Percorre cada jogador enviado no POST
    foreach ($jogadores as $idJogador => $jogador) {
        // Extrai o ID do jogador a partir do nome do campo (ex: "novo_jogador_1")
        $idJogador = explode('_', $idJogador)[1];

        // Armazena e remove a posição do array $jogador
        $posicao = $jogador['posicao'];
        unset($jogador['posicao']);

        // Converte os valores do array $jogador para inteiros
        $jogador = array_map('intval', $jogador);
        foreach ($jogador as $movimento => $valor) {
            if (!isset($resultado[$movimento])) {
                $resultado[$movimento] = 0;
            }
            $resultado[$movimento] += $valor;
        }


        // Cria um objeto Jogador para atualizar as defesas
        $jogadorOB = new Jogador();

        // Prepara os dados de defesa e atualiza as estatísticas de defesa do jogador
        $defesas = ['erro_defesa' => $jogador['erro_defesa'], 'defesa_jogador' => $jogador['defesa_jogador']];
        // Remove os dados de defesa do array $jogador para evitar duplicação de dados
        unset($jogador['defesa_jogador']);
        unset($jogador['erro_defesa']);
        $jogadorOB->AtualizarDefesas($idJogador, $defesas);
        $jogadores_no_time->AtualizarEstatisticas($idJogador, $_POST['id_time'], $posicao, $defesas, $jogador);

        // Atualiza estatísticas específicas conforme a posição do jogador
        if ($posicao == 'levantador') {
            // Caso o jogador seja um levantador
            $levantador = new Levantador();
            $levantador->AtualizarEstatisticas($idJogador, $jogador);
        } elseif ($posicao == 'líbero') {
            // Caso o jogador seja um líbero
            $libero = new Libero();
            $libero->AtualizarEstatisticas($idJogador, $jogador);
        } else {
            // Caso o jogador esteja em outra posição
            $outraPosicoes = new OutrasPosicoes();
            $outraPosicoes->AtualizarEstatisticas($idJogador, $posicao, $jogador);
        }
    }
    $competicaoDados = new CompeticaoTime();
    $novasChaves = array_map(function ($chave) {
        return str_replace('_jogador', '', $chave);
    }, array_keys($resultado));
    $resultado = array_combine($novasChaves, array_values($resultado));
    if ($_POST['id_competicao'] != '') {
        $competicaoDados->AtualizarEstatisticas(intval($_POST['id_competicao']),  intval($_POST['id_time']), $resultado);
    }
    // Redireciona para a página de estatísticas após a atualização
    header("Location: ../../pages/estatisticas.php");
} else {
    // Se não há dados enviados, redireciona para a página de times
    header("Location: ../../pages/times.php");
}