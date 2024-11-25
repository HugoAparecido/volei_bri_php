<?php
// Inclui o arquivo de proteção, responsável por verificar permissões e autenticação do usuário.
include('../componentes/protect.php');

// Define o caminho do ícone (favicon) da página.
define('FAVICON', "../img/bolas.ico");

// Define o caminho dos arquivos CSS a serem utilizados na página.
define('FOLHAS_DE_ESTILO', [
    "../css/cadastro.css",
    "../css/style.css"
]);

// Define o caminho do script de carregamento.
define('SCRIPT_LOADING', "../js/loading.js");

// Define os links para outras páginas importantes.
define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
define('LINK_LOGIN', './login.php');

// Define o caminho da logo a ser exibida no cabeçalho.
define('LOGO_HEADER', "../img/logo.png");

// Define o caminho do ícone de login do usuário.
define('LOGO_USUARIO', "../img/login.png");

// Define um array com os nomes das páginas e seus respectivos caminhos para navegação.
define('OUTRAS_PAGINAS', [
    ['Página Principal', '../index.php'],
    ['Times', './times.php'],
    ['Estatísticas', './estatisticas.php'],
    ['Login', './login.php'],
    ['Registrar Usuário', './registro.php']
]);

// Inclui o cabeçalho da página, que contém a estrutura inicial do HTML e a inclusão de CSS e ícones.
include '../componentes/header.php';

// Verifica se o usuário está autenticado através da variável de sessão 'id_usuario'.
if (isset($_SESSION['id_usuario'])) {
?>
<!-- Botão para logout, redirecionando para o script de logout ao clicar -->
<button type="button" class="botao_deslogar" id="logout">
    <a href="../componentes/logout.php">Sair</a>
</button>

<!-- Início da seção de tabela ou conteúdo restrito para usuários autenticados -->
<div class="tabela">
</div>
<?php } ?>