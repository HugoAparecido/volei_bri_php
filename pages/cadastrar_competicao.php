<?php
// Inclui um arquivo para proteger o acesso à página, verificando a autenticação do usuário.
include('../componentes/protect.php');
include('../componentes/classes/competicao_class.php');
include('../componentes/classes/componentes_class.php');


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
        ['competicaos', './competicaos.php'],
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

    <!-- Cartão contendo o formulário de cadastro de uma competicao -->
    <div class="card p-5 shadow-sm mb-5" id="card">
        <form action="../componentes/execucoes/cadastrar_competicao_exe.php" method="post">

            <!-- Campo para o nome da competicao -->
            <div class="mb-3">
                <label class="form-label" for="nome_competicao">Nome da competição:</label>
                <input class="form-control" type="text" id="nome_competicao" name="nome_competicao" value="" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="desafiante_competicao">Time Desafiante:</label>
                <select name="desafiante_competicao" id="desafiante_competicao" required class="form-select">
                    <option value="">Escolha um time</option>
                    <?php
                        Componentes::InputTimes();
                        ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="desafiado_competicao">Time Desafiado:</label>
                <select name="desafiado_competicao" id="desafiado_competicao" class="form-select">
                    <option value="">Escolha um time</option>
                    <?php
                        Componentes::InputTimes();
                        ?>
                </select>
            </div>

            <!-- Botões para cadastrar o competicao e redirecionar para o cadastro de jogadores -->
            <div class="mb-3">
                <button class="btn" type="submit">Cadastrar competicao</button>
                <a href="./times.php" class="btn">Inserir Estatísticas</a>
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