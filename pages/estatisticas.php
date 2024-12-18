<?php
// Inclui o arquivo de proteção para verificar permissões ou autenticação do usuário.
include '../componentes/protect.php';
include '../componentes/classes/time_class.php';
include '../componentes/classes/componentes_class.php';
include '../componentes/classes/competicao_time_class.php';

// Define o caminho do ícone (favicon) da página.
define('FAVICON', "../img/bolas.ico");

// Define os caminhos dos arquivos CSS a serem carregados na página.
define('FOLHAS_DE_ESTILO', array("../css/index.css", "../css/login.css", "../css/style.css", "../css/estatisticas.css"));

define('SCRIPT_LOADING', "../js/loading.js");

// Define os links para as páginas de cadastro de usuário, cadastro de instituição e login.
define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
define('LINK_LOGIN', './login.php');

// Define o caminho do logo que aparece no cabeçalho da página.
define('LOGO_HEADER', "../img/logo.png");

// Define o caminho do ícone de usuário para o login.
define('LOGO_USUARIO', "../img/login.png");
define('LINK_USUARIO_CADASTRADO', array(['Dados para aplicativo', '../componentes/construir_json.php'], ['Gerenciar cadastros efetuados', './gerenciamento_cadastros.php']));

// Define um array com nomes e caminhos de outras páginas para a navegação.
define('OUTRAS_PAGINAS', array(
    ['Página Principal', '../index.php'],
    ['Times', './times.php'],
    ['Estatísticas', './estatisticas.php']
));

// Inclui o cabeçalho da página, que contém a estrutura HTML inicial e a inclusão de CSS e ícones.
include '../componentes/header.php';
?>

<!-- Conteúdo principal da página -->
<main>
    <?php
    if (isset($_SESSION['id_usuario'])) {
    ?>
    <!-- Botão flutuante no topo direito da página, utilizado para logout -->
    <div class="d-grip gap-2 mb-3 fixed-top" id="botao_flutuante">
        <button type="button" class="btn" id="logout">
            <!-- Link para o logout, redirecionando para o script de logout -->
            <a href="../componentes/logout.php">Sair</a>
        </button>
    </div>
    <?php
    }
    ?>
    <div class="d-flex justify-content-center align-items-center">
        <!-- Formulário exibido quando o time não é selecionado, permitindo escolher um time -->
        <form action="./estatisticas.php" method="get" class="mt-5 d-flex flex-column">
            <select class="form-select" name="id_time" id="id_time">
                <?php
                // Função que popula o 'select' com os times disponíveis
                Componentes::InputTimes();
                ?>
            </select>
            <button class="btn mt-3 mb-3" type="submit" id="btn">Mostrar</button>
        </form>
    </div>
    <?php
    // Chama a função que cria um input para pesquisar o time
    Componentes::PesquisaDinamica('produto', 'pesq-produto-form', 'Time');
    ?>
    <div class="text-center">
        <!-- Verificação se o parâmetro 'id_time' não está presente na URL -->
        <?php if (isset($_GET['id_time'])) { ?>
        <!-- Exibe o título "Estatísticas" -->
        <h1>Estatísticas</h1>
    </div>

    <div class="card">
        <?php
            // Obtenção de jogadores de um time específico usando a função getJogadoresTime
            $objetos = JogadorTime::getJogadoresTime('id_time = ' . intval($_GET['id_time']), null, null, 'id_jogador_time, posicao_jogador, id_jogador');

            if (!empty($objetos)) {
                // Cria um array para armazenar os IDs dos jogadores obtidos
                $ids = [];
        ?>
        <div>
            <form action="./estatisticas_jogador.php"
                class="d-flex flex-column justify-content-around align-items-center">
                <label for="id_jogador" class="form-control text-center p-3">Estatíticas do jogador:</label>
                <select name="id_jogador" id="id_jogador" class="form-select" style="width: auto;">
                    <?php
                        // Itera sobre os objetos retornados para extrair os IDs dos jogadores
                        foreach ($objetos as $objeto) {
                            $nomeJogadorClass = JogadorTime::getJogadores('jogador', 'id_jogador', 'id_jogador', " jogador_no_time.id_jogador = " . $objeto->GetIDJogador());
                            $nomeJogador = $nomeJogadorClass[0]->GetNome();
                            echo "<option value=" . $objeto->GetIDJogador() . ">" . $nomeJogador . ' (' . $objeto->GetPosicao() . ")</option>";
                            array_push($ids, $objeto->GetID()); // Adiciona o ID do jogador ao array
                        }
                        ?>
                </select>
                <button type="submit" class="btn mt-3" id="btn">Visualizar</button>
                <button type="button" class="btn mt-3 mb-3" id="btn_impressao">Imprimir relatório</button>
            </form>
        </div>
        <?php

                // Definição das estatísticas de defesas e passes para o time selecionado
                $estatisticas = [
                    // Estatísticas de defesas
                    'defesas' => [
                        'select' => JogadorTime::GetEstatiticasSomaGeralDefesas(intval($_GET['id_time'])),
                        'dados' => 'GetDefesas'
                    ],
                    // Estatísticas de passes do líbero
                    'passesLibero' => [
                        'select' => JogadorTime::GetEstatiticasSomaGeralPasses($ids, 'libero_no_time'),
                        'dados' => 'GetPasses'
                    ],
                    // Estatísticas de passes de outras posições
                    'passesOutrasPosicoes' => [
                        'select' => JogadorTime::GetEstatiticasSomaGeralPasses($ids, 'outras_posicoes_no_time'),
                        'dados' => 'GetPasses'
                    ],
                    // Estatísticas de saques de outras posições
                    'saquesOutrasPosicoes' => [
                        'select' => JogadorTime::GetEstatiticasSomaGeralSaques($ids, 'outras_posicoes_no_time'),
                        'dados' => 'GetSaques'
                    ],
                    // Estatísticas de saques do levantador
                    'saquesLevantador' => [
                        'select' => JogadorTime::GetEstatiticasSomaGeralSaques($ids, 'levantador_no_time'),
                        'dados' => 'GetSaques'
                    ],
                    // Estatísticas de ataques do levantador
                    'ataquesLevantador' => [
                        'select' => JogadorTime::GetEstatiticasSomaGeralAtaques($ids, 'levantador_no_time'),
                        'dados' => 'GetAtaques'
                    ],
                    // Estatísticas de ataques das outras posições
                    'ataquesOutrasPosicoes' => [
                        'select' => JogadorTime::GetEstatiticasSomaGeralAtaques($ids, 'outras_posicoes_no_time'),
                        'dados' => 'GetAtaques'
                    ],
                    // Estatísticas de bloqueios do levantador
                    'bloqueiosLevantador' => [
                        'select' => JogadorTime::GetEstatiticasSomaGeralBloqueios($ids, 'levantador_no_time'),
                        'dados' => 'GetBloqueios'
                    ],
                    // Estatísticas de bloqueios das outras posições
                    'bloqueiosOutrasPosicoes' => [
                        'select' => JogadorTime::GetEstatiticasSomaGeralBloqueios($ids, 'outras_posicoes_no_time'),
                        'dados' => 'GetBloqueios'
                    ],
                    'levantamentos' => [
                        'select' => JogadorTime::GetEstatiticasSomaGeralLevantamentos($ids, 'levantador_no_time'),
                        'dados' => 'GetLevantamentos'
                    ]
                ];

                // Itera sobre o array de estatísticas para processar cada movimento
                foreach ($estatisticas as $movimento => $estatistica) {
                    // Verifica se o primeiro elemento do array 'select' é um objeto
                    if (is_object($estatistica['select'][0])) {
                        $funcao = $estatistica['dados']; // Obtém o nome do método para ser chamado
                        // Envia o valor das estatísticas para o JavaScript como uma variável
                        echo '<script>var ' . $movimento . ' = ' . $estatistica['select'][0]->$funcao() . ';</script>';
                    } else {
                        // Se não houver dados válidos, define a variável como um array padrão [0, 0]
                        echo '<script>var ' . $movimento . ' = [0, 0];</script>';
                    }
                }
            } else {
                // Se não houver jogadores, define valores padrão para cada movimento no JavaScript
                $movimentos = ['defesas', 'passesLibero', 'passesOutrasPosicoes', 'saquesOutrasPosicoes', 'saquesLevantador', 'ataquesLevantador', 'ataquesOutrasPosicoes', 'bloqueiosLevantador', 'bloqueiosOutrasPosicoes', 'levantamentos'];
                foreach ($movimentos as $movimento) {
                    echo '<script>var ' . $movimento . ' = [0, 0, 0, 0, 0];</script>';
                }
            }
        ?>

        <div id="relatorio">
            <div class="d-flex flex-wrap">
                <!-- Seção de gráficos para exibir as estatísticas de passes e defesas -->
                <div class="card" id='passes_time'>
                    <div class="card-header text-center">
                        <h2>Passes</h2>
                    </div>
                    <div class="d-flex flex-row flex-wrap">
                        <div class="card">
                            <div class="text-center" id="grafico_passe_libero_local">
                                <h3>Líbero</h3>
                            </div>
                        </div>
                        <div class="card">
                            <div class="text-center" id="grafico_passe_outras_local">
                                <h3>Outras Posições</h3>
                            </div>
                        </div>
                        <div class="card">
                            <div class="text-center" id="grafico_passe_total_local">
                                <h3>Total Passes Time</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Gráfico para exibir as defesas -->
                <div class="card align-items-center" id="defesas_time">
                    <div class="card-header text-center" style="width: 100%;">
                        <h2>Defesas</h2>
                    </div>
                    <div class="text-center" style="width: 100%;">
                        <div id="grafico_defesa_local">
                            <h3>Total de Defesas</h3>
                        </div>
                    </div>
                </div>
                <!-- Gráfico para exibir as defesas -->
                <div class="card" id="saques_time">
                    <div class="card-header text-center">
                        <h2>Saques</h2>
                    </div>
                    <div class="d-flex flex-row flex-wrap">
                        <div class="card">
                            <div class="text-center" id="grafico_erros_saques_levantadores_local">
                                <h3>Erros e acertos dos levantadores</h3>
                            </div>
                        </div>
                        <div class="card">
                            <div class="text-center" id="grafico_tipos_saques_levantadores_local">
                                <h3>Tipos de saques usados por levantadores</h3>
                            </div>
                        </div>
                        <div class="card">
                            <div class="text-center" id="grafico_erros_saques_outras_posicoes_local">
                                <h3>Erros e acertos dos outros jogadores</h3>
                            </div>
                        </div>
                        <div class="card">
                            <div class="text-center" id="grafico_tipos_saques_outras_posicoes_local">
                                <h3>Tipos de saques usados por outros jogadores</h3>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row flex-wrap">
                        <div class="card">
                            <div class="text-center" id="grafico_erros_saques_total_local">
                                <h3>Total erros e acertos</h3>
                            </div>
                        </div>
                        <div class="card">
                            <div class="text-center" id="grafico_tipos_saques_total_local">
                                <h3>Total tipos de saques usados</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card ataques_bloqueios_time">
                    <div class="card-header text-center">
                        <h2>Ataques</h2>
                    </div>
                    <div class="d-flex flex-row flex-wrap">
                        <div class="card">
                            <div class="text-center" id="grafico_ataque_levantador_local">
                                <h3>Erros e acertos dos levantadores</h3>
                            </div>
                        </div>
                        <div class="card">
                            <div class="text-center" id="grafico_ataque_outras_posicoes_local">
                                <h3>Erros e acertos dos outros jogadores</h3>
                            </div>
                        </div>
                        <div class="card">
                            <div class="text-center" id="grafico_ataque_total_local">
                                <h3>Erros e acertos totais</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card ataques_bloqueios_time">
                    <div class="card-header text-center">
                        <h2>Bloqueios</h2>
                    </div>
                    <div class="d-flex flex-row flex-wrap">
                        <div class="card">
                            <div class="text-center" id="grafico_bloqueio_levantador_local">
                                <h3>Erros e acertos dos levantadores</h3>
                            </div>
                        </div>
                        <div class="card">
                            <div class="text-center" id="grafico_bloqueio_outras_posicoes_local">
                                <h3>Erros e acertos dos outros jogadores</h3>
                            </div>
                        </div>
                        <div class="card">
                            <div class="text-center" id="grafico_bloqueio_total_local">
                                <h3>Erros e acertos totais</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" id="levantamentos">
                    <div class="card-header text-center">
                        <h2>Levantamentos</h2>
                    </div>
                    <div class="d-flex flex-row flex-wrap">
                        <div class="card">
                            <div class="text-center" id="grafico_erros_levantamento_local">
                                <h3>Erros e acertos</h3>
                            </div>
                        </div>
                        <div class="card">
                            <div class="text-center" id="grafico_tipos_levantamento_local">
                                <h3>Tipos acertados</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-wrap" id="relacao_competicao">
                <div class="card">
                    <div class="card-header">
                        <h2>Relação de acertos e erros de defesa entre as competições</h2>
                    </div>
                    <div class="card" style="width: 100%;">
                        <div class="text-center" id="relacao_defesas_competicoes_local">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2>Relação de acertos e erros de saques</h2>
                    </div>
                    <div class="card" style="width: 100%;">
                        <div class="text-center" id="relacao_saques_competicoes_local">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2>Relação de acertos e erros de ataques entre as competições</h2>
                    </div>
                    <div class="card" style="width: 100%;">
                        <div class="text-center" id="relacao_ataques_competicoes_local">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2>Relação de acertos e erros de bloqueios entre as competições</h2>
                    </div>
                    <div class="card" style="width: 100%;">
                        <div class="text-center" id="relacao_bloqueios_competicoes_local">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2>Relação de acertos e erros de levantamentos entre as competições</h2>
                    </div>
                    <div class="card" style="width: 100%;">
                        <div class="text-center" id="relacao_levantamentos_competicoes_local">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2>Relação de levantamentos entre as competições</h2>
                    </div>
                    <div class="card" style="width: 100%;">
                        <div class="text-center" id="relacao_levantamentos_tipos_competicoes_local">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2>Relação de saques entre as competições</h2>
                    </div>
                    <div class="card" style="width: 100%;">
                        <div class="text-center" id="relacao_saques_tipos_competicoes_local">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
            $competicoes = Competicao::GetCompeticoes(' id_time_desafiante = ' . intval($_GET['id_time']) . ' OR id_time_desafiado = ' . intval($_GET['id_time']));
            $competicoesTime = [];
            $defesas = ['acertos' => [], 'erros' => []];
            $ataques = ['acertos' => [], 'erros' => []];
            $bloqueios = ['acertos' => [], 'erros' => []];
            $levantamentos = ['acertos' => [], 'erros' => [], 'oposto' => [], 'central' => [], 'pipe' => [], 'ponta' => []];
            $saques = ['acertos' => [], 'erros' => [], 'flutuante' => [], 'viagem' => [], 'ace' => [], 'cima' => []];
            $passes = ['A' => [], 'B' => [], 'C' => [], 'D' => []];
            $nomeCompeticoes = [];
            foreach ($competicoes as $competicao) {
                array_push($competicoesTime, CompeticaoTime::GetCompeticaoTime($competicao->GetID()));
                array_push($nomeCompeticoes, $competicao->GetNome());
            }
            foreach ($competicoesTime as $competicaoTime) {
                list($acertos, $erros) = $competicaoTime->GetDefesas();
                array_push($defesas['acertos'], $acertos);
                array_push($defesas['erros'], $erros);
                list($acertos, $erros) = $competicaoTime->GetBloqueios();
                array_push($bloqueios['acertos'], $acertos);
                array_push($bloqueios['erros'], $erros);
                list($acertos, $erros) = $competicaoTime->GetAtaques();
                array_push($ataques['acertos'], $acertos);
                array_push($ataques['erros'], $erros);
                list($centro, $oposto, $pipe, $ponta, $erro) = $competicaoTime->GetLevantamentos();
                array_push($levantamentos['acertos'], ($centro + $oposto + $ponta + $pipe));
                array_push($levantamentos['oposto'], $oposto);
                array_push($levantamentos['pipe'], $pipe);
                array_push($levantamentos['ponta'], $ponta);
                array_push($levantamentos['central'], $centro);
                array_push($levantamentos['erros'], $erro);
                list($ace, $viagem, $flutuante, $cima, $erro) = $competicaoTime->GetSaques();
                array_push($saques['acertos'], ($ace + $viagem + $cima + $flutuante));
                array_push($saques['flutuante'], $flutuante);
                array_push($saques['viagem'], $viagem);
                array_push($saques['ace'], $ace);
                array_push($saques['cima'], $cima);
                array_push($saques['erros'], $erro);
            }
            echo "<script> const competicoes = ['" . implode("','", $nomeCompeticoes) . "'] </script>";
            echo "<script> const defesasCompeticoes = [['" . implode("','", $defesas['acertos']) . "'], ['" . implode("','", $defesas['erros']) . "']] </script>";
            echo "<script> const bloqueiosCompeticoes = [['" . implode("','", $bloqueios['acertos']) . "'], ['" . implode("','", $bloqueios['erros']) . "']] </script>";
            echo "<script> const ataquesCompeticoes = [['" . implode("','", $ataques['acertos']) . "'], ['" . implode("','", $ataques['erros']) . "']] </script>";
            echo "<script> const levantamentosCompeticoes = [['" . implode("','", $levantamentos['acertos']) . "'], ['" . implode("','", $levantamentos['erros']) . "']] </script>";
            echo "<script> const saquesCompeticoes = [['" . implode("','", $saques['acertos']) . "'], ['" . implode("','", $saques['erros']) . "']] </script>";
            echo "<script> const saquesTiposCompeticoes = [['" . implode("','", $saques['ace']) . "'], ['" . implode("','", $saques['viagem']) . "'], ['" . implode("','", $saques['flutuante']) . "'], ['" . implode("','", $saques['cima']) . "'], ['" . implode("','", $saques['erros']) . "']] </script>";
            echo "<script> const levantamentosTiposCompeticoes = [['" . implode("','", $levantamentos['pipe']) . "'], ['" . implode("','", $levantamentos['oposto']) . "'], ['" . implode("','", $levantamentos['ponta']) . "'], ['" . implode("','", $levantamentos['central']) . "'], ['" . implode("','", $levantamentos['erros']) . "']] </script>";
    ?>
    <!-- Inclusão de bibliotecas de JavaScript para criação de gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module" src="../js/estatisticas_time.js"></script>
    <script src="../js/impressao.js"></script>
    <!-- Fim da condição -->
    <?php } ?>
</main>
<script src="../js/pesquisa.js"></script>

<?php
// Inclui o rodapé da página, contendo scripts e informações finais.
include '../componentes/footer.php';
?>