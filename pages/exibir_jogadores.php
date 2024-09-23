<?php
include('../componentes/protect.php');
// define o caminho do icone em uma constante
define('FAVICON', "../img/bolas.ico");
// define o caminho do css da página
// define o caminho da logo no header
define('FOLHAS_DE_ESTILO', array("../css/cadastro.css", "../css/style.css"));
define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
define('LINK_LOGIN', './login.php');
define('LOGO_HEADER', "../img/logo.png");
define('LOGO_USUARIO', "../img/login.png");
// define os nomes dasa páginas e seus respectivos caminhos
define('OUTRAS_PAGINAS', array(['Página Principal', '../index.php'], ['Times', './times.php'], ['Estatísticas', './estatisticas.php'], ['Login', './login.php'], ['Registrar Usuário', './registro.php']));
include '../componentes/header.php';
if (isset($_SESSION['id_usuario'])) {
?>
    <button type="button" class="botao_deslogar" id="logout"><a href="../componentes/logout.php">Sair</a></button>
    <div class="tabela"><?php } ?>