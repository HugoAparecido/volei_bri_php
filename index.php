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

define('LINK_USUARIO_CADASTRADO', array(['Dados para aplicativo', './componentes/construir_json.php'], ['Gerenciar cadastros efetuados', './componentes/gerenciamento_cadastro.php']));
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
        <!-- Botão de logout flutuante -->
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
        <!-- Botão de dúvidas com descrições para auxiliar o usuário -->
        <button class="btn" type="button" id="botao_duvidas">?</button>
        <div id="descricao_botoes">
            <p><strong>Def:</strong> defesa bem sucedida</p>
            <p><strong>Def Err:</strong> defesa em que a bola não pode ser pega pelo companheiro</p>
            <p><strong>Pas:</strong> ato de passar a bola entre os jogadores, considerando a altura máxima entre
                a
                jogada de um e o recebimento do outro. <strong>A:</strong> acima das antenas da rede;
                <strong>B:</strong> o flutuante
                acima da rede e na altura das antenas; <strong>C:</strong> abaixo das antenas e na altura da
                rede;
                <strong>D:</strong> abaixo da rede;
            </p>
        </div>
    </div>
</main>
<?php
// Inclui o footer à página, que também está no diretório de componentes
include __DIR__ . '/componentes/footer.php';
?>