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


    <!-- Formulário exibido quando o time não é selecionado, permitindo escolher um time -->
    <form action="./estatisticas.php" method="get" class="mt-5">
        <select name="id_time" id="id_time">
            <?php
            // Função que popula o 'select' com os times disponíveis
            Componentes::InputTimes();
            ?>
        </select>
        <button type="submit">Mostrar</button>
    </form>
    <!-- Verificação se o parâmetro 'id_time' não está presente na URL -->
    <?php if (isset($_GET['id_time'])) { ?>
        <!-- Exibe o título "Estatísticas" -->
        <h1>Estatísticas</h1>
        <div class="card">
            <?php
            // Obtenção de jogadores de um time específico usando a função getJogadoresTime
            $objetos = JogadorTime::getJogadoresTime('id_time = ' . intval($_GET['id_time']), null, null, 'id_jogador_time, posicao_jogador');

            // Cria um array para armazenar os IDs dos jogadores obtidos
            $ids = [];
            // Itera sobre os objetos retornados para extrair os IDs dos jogadores
            foreach ($objetos as $objeto) {
                array_push($ids, $objeto->GetID()); // Adiciona o ID do jogador ao array
            }

            // Obtenção das estatísticas de defesas e passes para o time selecionado
            $estatisticas = [
                'defesas' => ['select' => JogadorTime::GetEstatiticasSomaGeralDefesas(intval($_GET['id_time'])), 'dados' => 'GetDefesas'], // Estatísticas de defesas
                'passesLibero' => ['select' => JogadorTime::GetEstatiticasSomaGeralPasses($ids, 'libero_no_time'), 'dados' => 'GetPasses'], // Estatísticas de passes do líbero
                'passesOutrasPosicoes' => ['select' => JogadorTime::GetEstatiticasSomaGeralPasses($ids, 'outras_posicoes_no_time'), 'dados' => 'GetPasses'], // Estatísticas de passes de outras posições
                'saquesOutrasPosicoes' => ['select' => JogadorTime::GetEstatiticasSomaGeralSaques($ids, 'outras_posicoes_no_time'), 'dados' => 'GetSaques'], // Estatísticas de saques de outras posições
                'saquesLevantador' => ['select' => JogadorTime::GetEstatiticasSomaGeralSaques($ids, 'levantador_no_time'), 'dados' => 'GetSaques'] // Estatísticas de saques do levantador
            ];

            // Itera sobre o array de estatísticas para processar cada movimento
            foreach ($estatisticas as $movimento => $estatistica) {
                // Verifica se a primeira posição da seleção é um objeto
                if (is_object($estatistica['select'][0])) {
                    $funcao = $estatistica['dados']; // Obtém o nome da função para chamar
                    // Envia o valor das estatísticas para o JavaScript como uma variável
                    echo '<script>var ' . $movimento . ' = ' . $estatistica['select'][0]->$funcao() . ';</script>';
                } else {
                    // Se não houver dados válidos, define a variável como um array padrão [0, 0]
                    echo '<script>var ' . $movimento . ' = [0, 0];</script>';
                }
            }
            ?>


            <!-- Seção de gráficos para exibir as estatísticas de passes e defesas -->
            <div class="card">
                <div class="card-header text-center">
                    <h2>Passes</h2>
                </div>
                <div class="d-flex flex-row">
                    <div class="text-center" id="grafico_passe_libero_local" style="width: 500px;">
                        <h3>Líbero</h3>
                    </div>
                    <div class="text-center" id="grafico_passe_outras_local" style="width: 500px;">
                        <h3>Outras Posições</h3>
                    </div>
                    <div class="text-center" id="grafico_passe_total_local" style="width: 500px;">
                        <h3>Total Passes Time</h3>
                    </div>
                </div>
            </div>

            <!-- Gráfico para exibir as defesas -->
            <div class="card">
                <div class="card-header text-center">
                    <h2>Defesas</h2>
                </div>
                <div id="grafico_defesa_local">
                </div>
            </div>

            <!-- Gráfico para exibir as defesas -->
            <div class="card">
                <div class="card-header text-center">
                    <h2>Saques</h2>
                </div>
                <div class="d-flex flex-row">
                    <div class="text-center" id="grafico_erros_saques_levantadores_local" style="width: 500px;">
                        <h3>Erros e acertos dos levantadores</h3>
                    </div>
                    <div class="text-center" id="grafico_tipos_saques_levantadores_local" style="width: 500px;">
                        <h3>Tipos de saques usados por levantadores</h3>
                    </div>
                    <div class="text-center" id="grafico_erros_saques_outras_posicoes_local" style="width: 500px;">
                        <h3>Erros e acertos dos outros jogadores</h3>
                    </div>
                    <div class="text-center" id="grafico_tipos_saques_outras_posicoes_local" style="width: 500px;">
                        <h3>Tipos de saques usados por outros jogadores</h3>
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

<?php
// Inclui o rodapé da página, contendo scripts e informações finais.
include '../componentes/footer.php';
?>