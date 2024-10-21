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

    <!-- Verificação se o parâmetro 'id_time' não está presente na URL -->
    <?php if (!isset($_GET['id_time'])) { ?>

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

        <!-- Caso o 'id_time' já esteja presente na URL -->
    <?php } else { ?>

        <!-- Exibe o título "Estatísticas" -->
        <h1>Estatísticas</h1>
        <div class="card">
            <?php
            // Obtenção de jogadores de um time específico
            $objetos = JogadorTime::getJogadoresTime('id_time = ' . intval($_GET['id_time']), null, null, 'id_jogador_time, posicao_jogador');

            // Cria um array de IDs de jogadores
            $ids = [];
            foreach ($objetos as $objeto) {
                array_push($ids, $objeto->GetID());
            }
            // Obtenção das estatísticas de defesas para o time selecionado
            $estatisticas = JogadorTime::GetEstatiticasSomaGeralDefesas(intval($_GET['id_time']));
            $estatisticas = $estatisticas[0];

            // Envia o valor das defesas para o JavaScript
            echo '<script>var defesas = ' . $estatisticas->GetDefesas() . ';</script>';

            // Obtenção das estatísticas de passes para o líbero no time
            $estatisticas = JogadorTime::GetEstatiticasSomaGeralPasses($ids, 'libero_no_time');
            $estatisticas = $estatisticas[0];

            // Envia o valor dos passes do líbero para o JavaScript
            echo '<script>var passesLibero = ' . $estatisticas->GetPasses() . ';</script>';

            // Obtenção das estatísticas de passes para outras posições no time
            $estatisticas = JogadorTime::GetEstatiticasSomaGeralPasses($ids, 'outras_posicoes_no_time');
            $estatisticas = $estatisticas[0];

            // Envia o valor dos passes das outras posições para o JavaScript
            echo '<script>var passesOutrasPosicoes = ' . $estatisticas->GetPasses() . ';</script>';
            $estatisticas = JogadorTime::GetEstatiticasSomaGeralSaques($ids, 'outras_posicoes_no_time');
            $estatisticas = $estatisticas[0];
            echo '<script>var saquesOutrasPosicoes = ' . $estatisticas->GetSaques() . ';</script>';
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