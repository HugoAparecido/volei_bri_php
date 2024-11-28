<?php
// Inclui arquivos para proteger o acesso e carregar classes necessárias.
include('../componentes/protect.php');
include('../componentes/classes/instituicao_class.php');

// Verifica se o usuário está logado e se tem permissão de treinador.
if (isset($_SESSION['id_usuario']) && $_SESSION['treinador']) {
    // Define a constante do caminho do favicon.
    define('FAVICON', "../img/bolas.ico");

    // Define uma constante com o caminho dos arquivos CSS da página.
    define('FOLHAS_DE_ESTILO', array("../css/cadastro.css", "../css/style.css"));

    define('SCRIPT_LOADING', "../js/loading.js");

    // Define links constantes para páginas específicas do sistema.
    define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
    define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
    define('LINK_LOGIN', './login.php');

    // Define a constante do caminho para a logo no cabeçalho.
    define('LOGO_HEADER', "../img/logo.png");

    // Define a constante do caminho para a imagem do usuário.
    define('LOGO_USUARIO', "../img/login.png");
    define('LINK_USUARIO_CADASTRADO', array(['Dados para aplicativo', '../componentes/construir_json.php'], ['Gerenciar cadastros efetuados', './gerenciamento_cadastros.php']));

    // Define uma constante contendo outras páginas do sistema.
    define('OUTRAS_PAGINAS', array(
        ['Página Principal', '../index.php'],
        ['Times', './times.php'],
        ['Estatísticas', './estatisticas.php']
    ));

    // Inclui o arquivo de cabeçalho da página.
    include '../componentes/header.php';
?>

<!-- Conteúdo principal da página -->
<main class="d-flex flex-column justify-content-center align-items-center min-vh-100 mt-5">

    <!-- Botão de logout no canto superior direito -->
    <div class="d-grip gap-2 mb-3 fixed-top" id="botao_flutuante">
        <button type="button" class="btn" id="logout">
            <a href="../componentes/logout.php">Sair</a>
        </button>
    </div>

    <!-- Cartão contendo o formulário para cadastro de instituição -->
    <div class="card p-4 shadow-sm mb-5" id="card">
        <form action="../componentes/execucoes/atualizar_instituicao_exe.php" method="post">
            <?php
                $instituicao = Instituicao::GetInstituicao(intval($_GET['id']))
                ?>
            <div class="text-center text-white mb-4">
                <h2>Atualizar Instituição</h2>
            </div>
            <input type="hidden" name="id_instituicao" value="<?= $_GET['id'] ?>">

            <div class="mb-3">
                <!-- Campo de entrada para o nome da instituição -->
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" required
                    value="<?= $instituicao->GetNome() ?>">
            </div>

            <div class="mb-3">
                <!-- Campo de seleção para o tipo de instituição -->
                <label for="tipo_instituicao">Tipo da Instituição de Ensino:</label>
                <select name="tipo_instituicao" class="form-select" id="tipo_instituicao" required>
                    <option value="pré-mirim" <?= ($instituicao->GetTipo() == "pré-mirim" ? "selected" : "") ?>>
                        Pré-mirim</option>
                    <option value="mirim" <?= ($instituicao->GetTipo() == "mirim" ? "selected" : "") ?>>Mirim</option>
                    <option value="infantil" <?= ($instituicao->GetTipo() == "infantil" ? "selected" : "") ?>>infantil
                    </option>
                    <option value="infanto juvenil"
                        <?= ($instituicao->GetTipo() == "infanto juvenil" ? "selected" : "") ?>>infanto juvenil</option>
                    <option value="juvenil" <?= ($instituicao->GetTipo() == "juvenil" ? "selected" : "") ?>>juvenil
                    </option>
                    <option value="adulto" <?= ($instituicao->GetTipo() == "adulto" ? "selected" : "") ?>>adulto
                    </option>
                    <option value="máster" <?= ($instituicao->GetTipo() == "máster" ? "selected" : "") ?>>máster
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <!-- Botão para submeter o formulário de cadastro -->
                <button type="submit" id="botao_cadastro" class="btn">Atualizar</button>
            </div>
        </form>
    </div>
</main>

<?php
    // Inclui o rodapé da página com informações finais.
    include '../componentes/footer.php';
} else {
    // Redireciona para a página de times caso o usuário não esteja logado ou não seja treinador.
    header("Location: ./times.php");
}
?>