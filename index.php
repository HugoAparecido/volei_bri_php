<?php
if (!isset($_SESSION)) {
    session_start();
}
// define o caminho do icone em uma constante
define('FAVICON', "./img/bolas.ico");
// define o caminho do css da página
define('FOLHAS_DE_ESTILO', array("./css/index.css", "./css/style.css"));
define('LINK_CADASTRO_USUARIO', './pages/cadastrar_usuario.php');
define('LINK_CADASTRO_INSTITUICAO', './pages/cadastrar_instituicao.php');
define('LINK_LOGIN', './pages/login.php');
// define o caminho da logo no header
define('LOGO_HEADER', "./img/logo.png");
define('LOGO_USUARIO', "./img/login.png");
// define os nomes dasa páginas e seus respectivos caminhos
define('OUTRAS_PAGINAS', array(['Página Principal', './index.php'], ['Times', './pages/times.php'], ['Estatísticas', './pages/estatisticas.php']));
// inclui o header à página
include __DIR__ . '/componentes/header.php';
?>
<style>
    .container-esquerdo {
        height: 500px;
        background-color: #e9ecef;
        margin-bottom: 20px;
        border-radius: 10px;
    }

    .container-direito {
        height: 1020px;
        background-color: #ced4da;
        border-radius: 10px;
    }
</style>
<main>
    <div class="d-grip gap-2 mb-3 fixed-top" id="botao_flutuante">
        <button type="button" class="btn" id="logout">
            <a href="./componentes/logout.php">Sair</a>
        </button>
    </div>
    <div class="container mt-4">
        <div class="row">
            <!-- Coluna da esquerda com dois containers -->
            <div class="col-md-8">
                <div class="container-esquerdo p-3">
                    <h5>Container Superior</h5>
                    <p>Conteúdo do container superior.</p>
                </div>
                <div class="container-esquerdo p-3">
                    <h5>Container Inferior</h5>
                    <p>Conteúdo do container inferior.</p>
                </div>
            </div>

            <!-- Coluna da direita com um container fino -->
            <div class="col-md-4">
                <div class="container-direito p-3">
                    <h5>Container Fino</h5>
                    <p>Conteúdo do container fino.</p>
                </div>
            </div>
        </div>
    </div>
    <div id="duvidas">
        <button class="btn" type="button" id="botao_duvidas">?</button>
        <div id="descricao_botoes">
            <p><strong>Def:</strong> defesa bem sucedida</p>
            <p><strong>Def Err:</strong> defesa em que a bola não pode ser pega pelo companheiro</p>
            <p><strong>Pas:</strong> ato de passar a bola entre os jogadores, considerando a altura máxima entre
                a
                jogado de um e o recebimneto do outro. <strong>A:</strong> acima das antenas da rede;
                <strong>B:</strong>o flutuante
                acima da rede e na altura das antenas; <strong>C:</strong> abaixo das antenas e na altura da
                rede;
                <strong>D:</strong> abaixo da rede;
            </p>
        </div>
    </div>
</main>
<?php
// inclui o footer à página
include __DIR__ . '/componentes/footer.php';
