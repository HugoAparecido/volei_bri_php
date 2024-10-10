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

    // Define links constantes para páginas específicas do sistema.
    define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
    define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
    define('LINK_LOGIN', './login.php');

    // Define a constante do caminho para a logo no cabeçalho.
    define('LOGO_HEADER', "../img/logo.png");

    // Define a constante do caminho para a imagem do usuário.
    define('LOGO_USUARIO', "../img/login.png");

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
            <form action="../componentes/execucoes/cadastrar_instituicao_exe.php" method="post">
                <div class="text-center text-white mb-4">
                    <h2>Cadastrar Instituição</h2>
                </div>

                <div class="mb-3">
                    <!-- Campo de entrada para o nome da instituição -->
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" id="nome" required>
                </div>

                <div class="mb-3">
                    <!-- Campo de seleção para o tipo de instituição -->
                    <label for="tipo_instituicao">Tipo da Instituição de Ensino:</label>
                    <select name="tipo_instituicao" class="form-select" id="tipo_instituicao" required>
                        <option value="pré-mirim">Pré-mirim</option>
                        <option value="mirim">Mirim</option>
                        <option value="infantil">infantil</option>
                        <option value="infanto juvenil">infanto juvenil</option>
                        <option value="juvenil">juvenil</option>
                        <option value="adulto">adulto</option>
                        <option value="máster">máster</option>
                    </select>
                </div>

                <div class="mb-3">
                    <!-- Botão para submeter o formulário de cadastro -->
                    <button type="submit" id="botao_cadastro" class="btn">Cadastrar</button>
                </div>
            </form>
        </div>

        <!-- Cartão com botão para mostrar instituições cadastradas -->
        <div class="card p-4 shadow-sm" id="card">
            <a href="./cadastrar_instituicao.php?mostrar=sim" class="btn" id="mostrar_instituição">Mostrar Instituições cadastradas</a>
            <?php
            // Se o parâmetro 'mostrar' estiver definido, exibe as instituições cadastradas.
            if (isset($_GET['mostrar'])) {
            ?>
                <!-- Tabela para listar instituições -->
                <table>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nome</td>
                            <td>Tipo</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Recupera e exibe cada instituição cadastrada.
                        $instituicoes = Instituicao::GetInstituicoes();
                        foreach ($instituicoes as $instituicao) {
                        ?>
                            <tr>
                                <td><?= $instituicao->GetID() ?></td>
                                <td><?= $instituicao->GetNome() ?></td>
                                <td><?= $instituicao->GetTipo() ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            }
            ?>
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