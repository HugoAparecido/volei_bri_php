<?php
// Inclui arquivos de proteção e classes necessários
include('../componentes/protect.php');
include('../componentes/classes/instituicao_class.php');

// Verifica se o usuário está logado e se é um treinador
if (isset($_SESSION['id_usuario']) && $_SESSION['treinador']) {
    // Define o caminho do ícone do favicon em uma constante
    define('FAVICON', "../img/bolas.ico");

    // Define o caminho dos arquivos CSS da página em uma constante
    define('FOLHAS_DE_ESTILO', array("../css/cadastro.css", "../css/style.css"));

    // Define o caminho da logo no header em uma constante
    define('LOGO_HEADER', "../img/bolas.png");

    // Define o caminho da logo de login em uma constante
    define('LOGO_USUARIO', "../img/login.png");

    // Define os nomes e caminhos de outras páginas em uma constante
    define('OUTRAS_PAGINAS', array(
        ['Página Principal', '../index.php'],
        ['Times', './times.php'],
        ['Estatísticas', './estatisticas.php']
    ));

    // Inclui o arquivo do cabeçalho da página
    include '../componentes/header.php';
?>
    <!-- Início do conteúdo principal da página -->
    <main>
        <!-- Logo do site -->
        <a href="#">
            <img src="../img/Logo.png" alt="Logo">
        </a>
        <!-- Formulário para cadastro de usuário -->
        <form action="../componentes/execucoes/cadastrar_instituicao_exe.php" method="post">
            <fieldset>
                <legend>Cadastro</legend>

                <!-- Campo para inserir o nome -->
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" required>

                <!-- Campo para inserir o tipo da instituição -->
                <label for="tipo_instituicao">Tipo da Instituição de Ensino:</label>
                <select name="tipo_instituicao" id="tipo_instituicao" required>
                    <option value="Superior e Médio Técnico">Superior e Médio Técnico</option>
                    <option value="Superior">Superior</option>
                    <option value="Médio Técnico">Médio Técnico</option>
                </select>

                <!-- Botão para submeter o formulário -->
                <button type="submit" id="botao_cadastro">Cadastrar</button>
            </fieldset>
        </form>
        <button><a href="./cadastrar_instituicao.php?mostrar=sim">Mostrar Instituições cadastradas</a></button>
        <?php
        if (isset($_GET['mostrar'])) {
        ?>
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
    </main>
<?php
    // Inclui o arquivo do rodapé da página
    include '../componentes/footer.php';
} else {
    // Se o usuário não estiver logado ou não for treinador, redireciona para a página de times
    header("Location: ./times.php");
}
?>