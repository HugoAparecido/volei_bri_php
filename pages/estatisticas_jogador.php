<?php
// Inclui o arquivo de proteção para verificar permissões ou autenticação do usuário.
include '../componentes/protect.php';
include '../componentes/classes/levantador_class.php';
include '../componentes/classes/outras_posicoes_class.php';
include '../componentes/classes/libero_class.php';

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
    <?php
    if (isset($_SESSION)) {
    ?>
        <!-- Botão flutuante no topo direito da página, utilizado para logout -->
        <div class="d-grip gap-2 mb-3 fixed-top" id="botao_flutuante">
            <button type="button" class="btn" id="logout">
                <!-- Link para o logout, redirecionando para o script de logout -->
                <a href="../componentes/logout.php">Sair</a>
            </button>
        </div>
    <?php
        $levantador = Levantador::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', ' levantador.id_jogador = ' . intval($_GET['id_jogador']));
        $outras = OutrasPosicoes::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', ' outras_posicoes.id_jogador = ' . intval($_GET['id_jogador']));
        $libero = Libero::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', ' libero.id_jogador = ' . intval($_GET['id_jogador']));
        var_dump($outras);
        var_dump($levantador);
        if (!empty($levantador)) {
            $nomeJogador = $levantador[0]->GetNome();
        }
        if (!empty($outras)) {
            $nomeJogador = $outras[0]->GetNome();
        }
        if (!empty($libero)) {
            $nomeJogador = $libero[0]->GetNome();
        }
    }

    ?>
    <div class="text-center">
        <h1>Jogador</h1>
    </div>
    <div class="card">
        <div class="card-header"><?= $nomeJogador ?></div>

    </div>
</main>

<!-- Inclusão de bibliotecas de JavaScript para criação de gráficos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="module" src="../js/estatisticas_time.js"></script>
<script src="../js/pesquisa.js"></script>

<?php
// Inclui o rodapé da página, contendo scripts e informações finais.
include '../componentes/footer.php';
?>