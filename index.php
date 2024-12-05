<?php
// Inicia a sessão caso ela ainda não tenha sido iniciada
if (!isset($_SESSION)) {
    session_start();
}

// Define uma constante com o caminho do ícone da página (favicon)
define('FAVICON', "./img/bolas.ico");

// Define um array de constantes com os caminhos dos arquivos CSS da página
define('FOLHAS_DE_ESTILO', array("./css/index.css", "./css/style.css"));

define('SCRIPT_LOADING', "./js/loading.js");

// Define as constantes com os caminhos para as páginas de cadastro e login
define('LINK_CADASTRO_USUARIO', './pages/cadastrar_usuario.php');
define('LINK_CADASTRO_INSTITUICAO', './pages/cadastrar_instituicao.php');
define('LINK_LOGIN', './pages/login.php');

// Define a constante com o caminho do logo para o header
define('LOGO_HEADER', "./img/logo.png");

// Define a constante com o caminho da imagem de login do usuário
define('LOGO_USUARIO', "./img/login.png");

define('LINK_USUARIO_CADASTRADO', array(['Dados para aplicativo', './componentes/construir_json.php'], ['Gerenciar cadastros efetuados', './pages/gerenciamento_cadastros.php']));
// Define um array com o nome das páginas e seus respectivos caminhos
define('OUTRAS_PAGINAS', array(
    ['Página Principal', './index.php'],
    ['Times', './pages/times.php'],
    ['Estatísticas', './pages/estatisticas.php']
));

// Inclui o header à página, que está no diretório de componentes
include __DIR__ . '/componentes/header.php';
?>
<style>
/* Estilos de formatação para o layout da página */
.container-esquerdo {
    background-color: #e9ecef;
    margin-bottom: 20px;
    border-radius: 10px;
}

.container-direito {
    background-color: #ced4da;
    border-radius: 10px;
}
</style>
<main>
    <?php if (isset($_SESSION['id_usuario'])) { ?>
    <div class="d-grip gap-2 mb-3 fixed-top" id="botao_flutuante">
        <!-- Botão de logout flutuante -->
        <button type="button" class="btn" id="logout">
            <a href="./componentes/logout.php">Sair</a>
        </button>
    </div>
    <?php } ?>
    <div class="container mt-4">
        <div class="row">
            <!-- Coluna da esquerda com dois containers -->
            <div class="col-md-8">
                <div class="container-esquerdo p-3">
                    <h5 style="margin-left: 10px;">Tipos de Saque no vôlei</h5>
                    <iframe id="SAQUE" class="videos" src="https://www.youtube.com/embed/a3C8gZtbZ0U"
                        title="Saque no Voleibol: Os Tipos de Saque do Vôlei" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <div class="container-esquerdo p-3">
                    <h5 style="margin-left: 10px;">Tipos de Levantamento</h5>
                    <iframe id="LEVANTAMENTO" class="videos"
                        src="https://www.youtube.com/embed/g9BFHEjCHa4?si=cn6fOGdfsT3ubfbf" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <div class="container-esquerdo p-3">
                    <h5 style="margin-left: 10px;">Tipos de Ataque</h5>
                    <iframe id="ATAQUE" class="videos" src="https://www.youtube.com/embed/P_dlI-EKtmA"
                        title="Ataque no Voleibol: Tipos de Ataque no Vôlei" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <div class="container-esquerdo p-3">
                    <h5 style="margin-left: 10px;">Posições no Vôlei</h5>
                    <iframe id="POSICAO" class="videos"
                        src="https://www.youtube.com/embed/cngU-dgOhHM?si=Y2BdqcFwM9q7-_8n" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <div class="container-esquerdo p-3">
                    <h5 style="margin-left: 10px;">Passes A,B,C</h5>
                    <iframe id="PASSE" class="videos"
                        src="https://www.youtube.com/embed/lXK9Ubg78yM?si=tqWA8LvYel9G6URN" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <div class="container-esquerdo p-3">
                    <h5 style="margin-left: 10px;">Defesa no Vôlei</h5>
                    <iframe id="DEFESA" class="videos"
                        src="https://www.youtube.com/embed/ENdpOWHq9QI?si=xJ7qkeKoAjt01eP-" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <div class="container-esquerdo p-3">
                    <h5 style="margin-left: 10px;">Bloqueio no Vôlei</h5>
                    <iframe id="BLOQUEIO" class="videos"
                        src="https://www.youtube.com/embed/gBtpPwc6HGs?si=joXy5z_ycLqmutLu" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>

            <!-- Coluna da direita com um container fino -->
            <div class="col-md-4">
                <div class="container-direito p-3">
                    <h5>Sumário:</h5>
                    <div class="list-group list-group-flush">
                        <a href="#SAQUE" class="list-group-item list-group-item-action rounded-top" aria-current="true">
                            Tipos de Saque
                        </a>
                        <a href="#LEVANTAMENTO" class="list-group-item list-group-item-action">Tipos de Levantamento</a>
                        <a href="#ATAQUE" class="list-group-item list-group-item-action">Tipos de Ataque</a>
                        <a href="#POSICAO" class="list-group-item list-group-item-action">Posições no Vôlei</a>
                        <a href="#PASSE" class="list-group-item list-group-item-action">Passes A,B,C</a>
                        <a href="#DEFESA" class="list-group-item list-group-item-action">Defesa no Vôlei</a>
                        <a href="#BLOQUEIO" class="list-group-item list-group-item-action rounded-bottom">Bloqueio no
                            Vôlei</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
// Inclui o footer à página, que também está no diretório de componentes
include __DIR__ . '/componentes/footer.php';
?>