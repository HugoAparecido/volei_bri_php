<?php
session_set_cookie_params(['httponly' => true]);
// lifetime = 0 significa que o cookie será excluído após o navegador ser fechado, para outros valores corresponderá ao tempo em segundo de expiração do cookie
session_start();
//sessions servem para pegar a variável em qualquer parte do sistema, isto é feito por meio de cookies
// Segurança: criar a sessao com http Only e com o protolo ssl
//Para toda vez que logar o usuário utilizar a função abaixo
//Gera outro cookie com um novo id
//com  true deleta a sessao antiga
session_regenerate_id(true);
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