<?php
if (!isset($_SESSION)) {
    session_start();
}
// define o caminho do icone em uma constante
define('FAVICON', "./img/bolas.ico");
// define o caminho do css da página
define('FOLHAS_DE_ESTILO', array("./css/index.css", "./css/style.css"));
// define o caminho da logo no header
define('LOGO_HEADER', "./img/bolas.png");
define('LOGO_USUARIO', "./img/login.png");
// define os nomes dasa páginas e seus respectivos caminhos
define('OUTRAS_PAGINAS', array(['Página Principal', './index.php'], ['Times', './pages/times.php'], ['Estatísticas', './pages/estatisticas.php'], ['Login', './pages/login.php']));
// inclui o header à página
include __DIR__ . '/componentes/header.php';
// inclui o footer à página
include __DIR__ . '/componentes/footer.php';
