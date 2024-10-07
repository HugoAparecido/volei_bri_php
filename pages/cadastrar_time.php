<?php
// Inclui um arquivo para proteger o acesso à página, verificando a autenticação do usuário.
include('../componentes/protect.php');

// Inclui o arquivo da classe 'Instituicao' que possui métodos e atributos relacionados à instituição.
include('../componentes/classes/instituicao_class.php');

// Verifica se a variável de sessão 'id_usuario' está definida para garantir que o usuário está autenticado.
if (isset($_SESSION['id_usuario'])) {
    // Define uma constante para o caminho do ícone da página (favicon).
    define('FAVICON', "../img/bolas.ico");

    // Define uma constante para o caminho dos arquivos CSS utilizados na página.
    define('FOLHAS_DE_ESTILO', array("../css/style.css", "../css/cadastro.css"));

    // Define constantes para links específicos de funcionalidades de cadastro e login.
    define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
    define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
    define('LINK_LOGIN', './login.php');

    // Define uma constante para o caminho da imagem do logo que aparece no cabeçalho.
    define('LOGO_HEADER', "../img/logo.png");

    // Define uma constante para o caminho da imagem do ícone do usuário.
    define('LOGO_USUARIO', "../img/login.png");

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
            <form action="../componentes/execucoes/cadastrar_time_exe.php" method="post">

                <!-- Campo para o nome do time -->
                <div class="mb-3">
                    <label class="form-label" for="nome_time">Nome do Time:</label>
                    <input class="form-control" type="text" id="nome_time" name="nome_time" value="">
                </div>

                <!-- Campo para o sexo do time -->
                <div class="mb-3">
                    <label class="form-label" for="sexo_time">Sexo do Time:</label>
                    <select class="form-select" name="sexo_time" id="sexo_time" required>
                        <!-- Define opções para o sexo do time, usando a variável $_GET para manter a seleção atual -->
                        <option value="M" <?= $_GET['sexo'] == 'M' ? "selected" : "" ?>>Masculino</option>
                        <option value="F" <?= $_GET['sexo'] == 'F' ? "selected" : "" ?>>Feminino</option>
                        <option value="Mis" <?= $_GET['sexo'] == 'Mis' ? "selected" : "" ?>>Misto</option>
                    </select>
                </div>

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
                </div>

                <!-- Botões para cadastrar o time e redirecionar para o cadastro de jogadores -->
                <div class="mb-3">
                    <button id="cadastrar_time" class="btn" type="submit">Cadastrar Time</button>
                    <a href="./cadastrar_jogador.php" class="btn" id="update_jogadores_cadastrados">Cadastrar Jogador</a>
                </div>
            </form>
        </div>

        <!-- Seção para exibir os times cadastrados em uma tabela -->
        <div class="card p-4 shadow-sm " id="card">
            <button class="btn id=" id="mostrar_times" type="button">Mostrar Time</button>
            <div class="tabela">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Sexo</th>
                            <th>Jogadores</th>
                        </tr>
                    </thead>
                    <tbody id="times_cadastrados">
                        <!-- Os dados dos times serão exibidos aqui dinamicamente -->
                    </tbody>
                </table>
            </div>
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