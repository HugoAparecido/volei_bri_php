<?php
// Inclui um arquivo para proteger o acesso à página, verificando a autenticação do usuário.
include('../componentes/protect.php');

include('../componentes/classes/time_class.php');

if (isset($_POST['id_time'])) {
    $time = Time::GetTime(intval($_POST['id_time']));
    $time->Atualizar($_POST['nome_time']);
    header("Location: ./gerenciamento_cadastros.php");
}

// Verifica se a variável de sessão 'id_usuario' está definida para garantir que o usuário está autenticado.
if (isset($_SESSION['id_usuario'])) {
    // Define uma constante para o caminho do ícone da página (favicon).
    define('FAVICON', "../img/bolas.ico");

    // Define uma constante para o caminho dos arquivos CSS utilizados na página.
    define('FOLHAS_DE_ESTILO', array("../css/style.css", "../css/cadastro.css"));

    define('SCRIPT_LOADING', "../js/loading.js");

    // Define constantes para links específicos de funcionalidades de cadastro e login.
    define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
    define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
    define('LINK_LOGIN', './login.php');

    // Define uma constante para o caminho da imagem do logo que aparece no cabeçalho.
    define('LOGO_HEADER', "../img/logo.png");

    // Define uma constante para o caminho da imagem do ícone do usuário.
    define('LOGO_USUARIO', "../img/login.png");
    define('LINK_USUARIO_CADASTRADO', array(['Dados para aplicativo', '../componentes/construir_json.php'], ['Gerenciar cadastros efetuados', './gerenciamento_cadastros.php']));

    // Define uma constante para um array contendo outras páginas do site e seus respectivos links.
    define('OUTRAS_PAGINAS', array(
        ['Página Principal', '../index.php'],
        ['Times', './times.php'],
        ['Estatísticas', './estatisticas.php']
    ));

    // Inclui o cabeçalho da página, contendo a estrutura inicial de HTML e links para CSS e favicon.
    include '../componentes/header.php';
?>

<!-- Principal conteúdo da página -->
<main class="d-flex flex-column justify-content-center align-items-center min-vh-100 mt-5">

    <!-- Botão flutuante no canto superior direito para logout -->
    <div class="d-grip gap-2 mb-3 fixed-top" id="botao_flutuante">
        <button type="button" class="btn" id="logout">
            <a href="../componentes/logout.php">Sair</a>
        </button>
    </div>

    <!-- Cartão contendo o formulário de cadastro de um time -->
    <div class="card p-5 shadow-sm mb-5" id="card">
        <form action="./atualizar_time.php" method="post">
            <?php
                $id = intval($_GET['id']);
                $time = Time::GetTime($id);
                ?>
            <input type="hidden" name="id_time" value="<?= $id ?>">
            <!-- Campo para o nome do time -->
            <div class="mb-3">
                <label class="form-label" for="nome_time">Nome do Time:</label>
                <input class="form-control" type="text" id="nome_time" name="nome_time" value="<?= $time->GetNome() ?>">
            </div>

            <!-- Botões para cadastrar o time e redirecionar para o cadastro de jogadores -->
            <div class="mb-3">
                <button id="cadastrar_time" class="btn" type="submit">Atualizar Time</button>
            </div>
        </form>
    </div>
</main>
<?php
    // Inclui o rodapé da página, contendo scripts adicionais ou informações finais.
    include '../componentes/footer.php';
} else {
    // Redireciona o usuário para a página de login caso não esteja autenticado.
    header("Location: ./login.php");
}
?>