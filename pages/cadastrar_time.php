<?php
// Inclui um arquivo que contém funções ou códigos para proteger o acesso à página, geralmente verificando se o usuário está autenticado.
include('../componentes/protect.php');

// Verifica se a variável de sessão 'id_usuario' está definida, o que indica que o usuário está autenticado.
if (isset($_SESSION['id_usuario'])) {
    // Define uma constante para o caminho do ícone da página.
    define('FAVICON', "../img/bolas.ico");

    // Define uma constante para o caminho dos arquivos CSS usados na página.
    define('FOLHAS_DE_ESTILO', array("../css/style.css", "../css/cadastro.css"));
    define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
    define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
    define('LINK_LOGIN', './login.php');

    // Define uma constante para o caminho da imagem da logo exibida no cabeçalho.
    define('LOGO_HEADER', "../img/bolas.png");

    // Define uma constante para o caminho da imagem da logo de usuário.
    define('LOGO_USUARIO', "../img/login.png");

    // Define uma constante para um array contendo os nomes e caminhos de outras páginas do site.
    define('OUTRAS_PAGINAS', array(
        ['Página Principal', '../index.php'],
        ['Times', './times.php'],
        ['Estatísticas', './estatisticas.php']
    ));

    // Inclui o arquivo do cabeçalho da página, geralmente contendo a estrutura HTML inicial e a inclusão de recursos como CSS.
    include '../componentes/header.php';
?>

    <!-- Principal conteúdo da página -->
    <main class="d-flex flex-column justify-content-center align-items-center min-vh-100 mt-5">
        <!-- Botão flutuante no canto superior direito da página -->
        <div class="d-grip gap-2 mb-3 fixed-top" id="botao_flutuante">
            <button type="button" class="btn" id="logout">
                <a href="../componentes/logout.php">Sair</a>
            </button>
        </div>
        <!--Forms do cadastro time-->
        <div class="card p-5 shadow-sm mb-5" id="card">
            <form action="../componentes/execucoes/cadastrar_time_exe.php" method="post">
                <div class="mb-3">
                    <label class="form-label" for="nome_time">Nome do Time:</label>
                    <input class="form-control" type="text" id="nome_time" name="nome_time" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="sexo_time">Sexo do Time:</label>
                    <select class="form-select" name="sexo_time" id="sexo_time" required>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="Mis">Misto</option>
                    </select>
                </div>
                <div class="mb-3">
                    <button id="cadastrar_time" class="btn" type="button">Cadastar Time</button>
                    <a href="./cadastrar_jogador.php" class="btn" id="update_jogadores_cadastrados">Cadastrar
                        Jogador</a>
                </div>
            </form>
        </div>
        </div>
        <div class="card p-4 shadow-sm " id="card">
            <button class="btn id=" id="mostrar_times" type="button">Mostrar
                Time</button>
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
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </main>
<?php
    // Inclui o arquivo do rodapé da página, geralmente contendo scripts ou informações finais.
    include '../componentes/footer.php';
} else {
    // Se a variável de sessão 'id_usuario' não estiver definida, redireciona o usuário para a página de login.
    header("Location: ./login.php");
}
?>