<?php
// Inclui o arquivo de proteção para verificar permissões ou autenticação do usuário.
include '../componentes/protect.php';

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
</main>

<?php
// Inclui o rodapé da página, contendo scripts e informações finais.
include '../componentes/footer.php';
?>