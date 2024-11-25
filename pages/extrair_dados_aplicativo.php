<?php
// Inclui os arquivos de proteção de sessão e classes necessárias
include('../componentes/protect.php');
include('../componentes/classes/time_class.php');
include('../componentes/classes/libero_class.php');
include('../componentes/classes/levantador_class.php');
include('../componentes/classes/outras_posicoes_class.php');
include('../componentes/classes/componentes_class.php');
include('../componentes/classes/instituicao_class.php');

// Verifica se o usuário está logado
if (isset($_SESSION['id_usuario'])) {
    // Define constantes para o caminho de ícone, CSS, links de cadastro e login, e logotipo
    define('FAVICON', "../img/bolas.ico");
    define('FOLHAS_DE_ESTILO', array("../css/style.css", "../css/times.css", "../css/inserir_informacoes.css"));
    define('SCRIPT_LOADING', "../js/loading.js");
    define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
    define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
    define('LINK_LOGIN', './login.php');
    define('LOGO_HEADER', "../img/logo.png");
    define('LOGO_USUARIO', "../img/login.png");

    // Define o nome e caminho das páginas disponíveis
    define('OUTRAS_PAGINAS', array(['Página Principal', '../index.php'], ['Times', './times.php'], ['Estatísticas', './estatisticas.php']));
    include '../componentes/header.php';
?>
    <main>
        <form action="../componentes/construir_json.php" method="post">

            <!-- Campo para a instituição do time -->
            <div class="mb-3">
                <label class="form-label" for="instituicao">Instituição do Time:</label>
                <select class="form-select" name="instituicao" id="instituicao" required>
                    <?php
                    // Obtém a lista de instituições usando um método estático da classe Instituicao.
                    $instituicao = Instituicao::GetInstituicoes();

                    // Percorre a lista de instituições e cria uma opção para cada uma no campo select.
                    foreach ($instituicao as $instituicao) {
                    ?>
                        <option value="<?= $instituicao->GetID() ?>"><?= $instituicao->GetNome() ?></option>
                    <?php } ?>
                </select>
        </form>
        <a href="../componentes/construir_json.php" class="btn" id="btn">Baixar arquivo</a>
        <a href="../componentes/enviar_email.php" class="btn" id="btn">Enviar por e-mail</a>
    </main>
<?php
    // Inclui o footer da página
    include '../componentes/footer.php';
} else
    // Redireciona para a página de login se o usuário não estiver logado
    header("Location: ./login.php");
?>