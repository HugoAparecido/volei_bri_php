<?php
// Inclui o arquivo de proteção, para verificar permissões ou autenticação
include '../componentes/protect.php';
// Define o caminho do ícone da página
define('FAVICON', "../img/bolas.ico");
// Define os caminhos dos arquivos CSS para a página
define('FOLHAS_DE_ESTILO', array("../css/index.css", "../css/login.css"));
define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
define('LINK_LOGIN', './login.php');
// Define o caminho do logo no cabeçalho
define('LOGO_HEADER', "../img/bolas.png");
define('LOGO_USUARIO', "../img/login.png");
// Define os nomes e caminhos de outras páginas
define('OUTRAS_PAGINAS', array(['Página Principal', '../index.php'], ['Times', './times.php'], ['Estatísticas', './estatisticas.php']));

// Inclui o arquivo de cabeçalho da página
include '../componentes/header.php';
?>
    <?php
    // Inclui o arquivo de rodapé da página
    include '../componentes/footer.php';
    ?>