<?php
// define o caminho do icone em uma constante
define('FAVICON', "./img/logo-volei.ico");
// define o caminho do css da página
define('FOLHAS_DE_ESTILO', array("./css/index.css"));
// define o caminho da logo no header
define('LOGO_HEADER', "./img/raposa2.png");
// define os nomes dasa páginas e seus respectivos caminhos
define('OUTRAS_PAGINAS', array(['Página Principal', './index.php'], ['Times', './pages/times.php'], ['Estatísticas', './pages/estatisticas.php'], ['Login', './pages/login.php']));
include __DIR__ . '/componentes/header.php';
include __DIR__ . '/componentes/footer.php';