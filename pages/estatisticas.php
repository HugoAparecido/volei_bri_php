<?php
// Inclui o arquivo de proteção para verificar permissões ou autenticação do usuário.
include '../componentes/protect.php';
include '../componentes/classes/time_class.php';
include '../componentes/classes/componentes_class.php';

// Define o caminho do ícone (favicon) da página.
define('FAVICON', "../img/bolas.ico");

// Define os caminhos dos arquivos CSS a serem carregados na página.
define('FOLHAS_DE_ESTILO', array("../css/index.css", "../css/login.css", "../css/style.css"));

// Define os links para as páginas de cadastro de usuário, cadastro de instituição e login.
define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
define('LINK_LOGIN', './login.php');

// Define o caminho do logo que aparece no cabeçalho da página.
define('LOGO_HEADER', "../img/logo.png");

// Define o caminho do ícone de usuário para o login.
define('LOGO_USUARIO', "../img/login.png");

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
    <!-- Botão flutuante no topo direito da página, utilizado para logout -->
    <div class="d-grip gap-2 mb-3 fixed-top" id="botao_flutuante">
        <button type="button" class="btn" id="logout">
            <!-- Link para o logout, redirecionando para o script de logout -->
            <a href="../componentes/logout.php">Sair</a>
        </button>
    </div>
    <?php
    Componentes::PesquisaDinamica('produto', 'pesq-produto-form', 'Time');
    ?>
    <div class="d-flex justify-content-center align-items-center">
        <!-- Formulário exibido quando o time não é selecionado, permitindo escolher um time -->
        <form action="./estatisticas.php" method="get" class="mt-5">
            <select class="form-select" name="id_time" id="id_time">
                <?php
                // Função que popula o 'select' com os times disponíveis
                Componentes::InputTimes();
                ?>
            </select>
            <button class="btn" type="submit" id="btn">Mostrar</button>
        </form>
    </div>
    <div class="text-center">
        <!-- Verificação se o parâmetro 'id_time' não está presente na URL -->
        <?php if (isset($_GET['id_time'])) { ?>
            <!-- Exibe o título "Estatísticas" -->
            <h1>Estatísticas</h1>
    </div>


    <div class="card">
        <?php
            // Obtenção de jogadores de um time específico usando a função getJogadoresTime
            $objetos = JogadorTime::getJogadoresTime('id_time = ' . intval($_GET['id_time']), null, null, 'id_jogador_time, posicao_jogador');

            if (!empty($objetos)) {
                // Cria um array para armazenar os IDs dos jogadores obtidos
                $ids = [];
                // Itera sobre os objetos retornados para extrair os IDs dos jogadores
                foreach ($objetos as $objeto) {
                    array_push($ids, $objeto->GetID()); // Adiciona o ID do jogador ao array
                }

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
                $movimentos = ['defesas', 'passesLibero', 'passesOutrasPosicoes', 'saquesOutrasPosicoes', 'saquesLevantador'];
                foreach ($movimentos as $movimento) {
                    echo '<script>var ' . $movimento . ' = [0, 0, 0, 0, 0];</script>';
                }
            }
        ?>


        <!-- Seção de gráficos para exibir as estatísticas de passes e defesas -->
        <div class="card">
            <div class="card-header text-center">
                <h2>Passes</h2>
            </div>
            <div class="d-flex flex-row">
                <div class="card" style="width: 33.3%;">
                    <div class="text-center" id="grafico_passe_libero_local">
                        <h3>Líbero</h3>
                    </div>
                </div>
                <div class="card" style="width: 33.3%;">
                    <div class="text-center" id="grafico_passe_outras_local">
                        <h3>Outras Posições</h3>
                    </div>
                </div>
                <div class="card" style="width: 33.3%;">
                    <div class="text-center" id="grafico_passe_total_local">
                        <h3>Total Passes Time</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico para exibir as defesas -->
        <div class="card align-items-center" style="width: 100%;">
            <div class="card-header text-center" style="width: 100%;">
                <h2>Defesas</h2>
            </div>
            <div class="text-center" style="width: 33.3%;">
                <div id="grafico_defesa_local"></div>
            </div>
        </div>

        <!-- Gráfico para exibir as defesas -->
        <div class="card">
            <div class="card-header text-center">
                <h2>Saques</h2>
            </div>
            <div class="d-flex flex-row">
                <div class="card" style="width: 25%;">
                    <div class="text-center" id="grafico_erros_saques_levantadores_local">
                        <h3>Erros e acertos dos levantadores</h3>
                    </div>
                </div>
                <div class="card" style="width: 25%;">
                    <div class="text-center" id="grafico_tipos_saques_levantadores_local">
                        <h3>Tipos de saques usados por levantadores</h3>
                    </div>
                </div>
                <div class="card" style="width: 25%;">
                    <div class="text-center" id="grafico_erros_saques_outras_posicoes_local">
                        <h3>Erros e acertos dos outros jogadores</h3>
                    </div>
                </div>
                <div class="card" style="width: 25%;">
                    <div class="text-center" id="grafico_tipos_saques_outras_posicoes_local">
                        <h3>Tipos de saques usados por outros jogadores</h3>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row">
                <div class="card" style="width: 50%;">
                    <div class="text-center" id="grafico_erros_saques_total_local">
                        <h3>Total erros e acertos</h3>
                    </div>
                </div>
                <div class="card" style="width: 50%;">
                    <div class="text-center" id="grafico_tipos_saques_total_local">
                        <h3>Total tipos de saques usados</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-center">
                <h2>Ataques</h2>
            </div>
            <div class="d-flex flex-row">
                <div class="card" style="width: 25%;">
                    <div class="text-center" id="grafico_erros_saques_levantadores_local">
                        <h3>Erros e acertos dos levantadores</h3>
                    </div>
                </div>
                <div class="card" style="width: 25%;">
                    <div class="text-center" id="grafico_tipos_saques_levantadores_local">
                        <h3>Tipos de saques usados por levantadores</h3>
                    </div>
                </div>
                <div class="card" style="width: 25%;">
                    <div class="text-center" id="grafico_erros_saques_outras_posicoes_local">
                        <h3>Erros e acertos dos outros jogadores</h3>
                    </div>
                </div>
                <div class="card" style="width: 25%;">
                    <div class="text-center" id="grafico_tipos_saques_outras_posicoes_local">
                        <h3>Tipos de saques usados por outros jogadores</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fim da condição -->
<?php } ?>
</main>

<!-- Inclusão de bibliotecas de JavaScript para criação de gráficos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="module" src="../js/estatisticas_time.js"></script>
<script src="../js/pesquisa.js"></script>

<?php
// Inclui o rodapé da página, contendo scripts e informações finais.
include '../componentes/footer.php';
?>