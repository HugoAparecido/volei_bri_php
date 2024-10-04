<?php
// Inclui um arquivo que contém funções ou códigos para proteger o acesso à página, geralmente verificando se o usuário está autenticado.
include('../componentes/protect.php');
include('../componentes/classes/componentes_class.php');
include('../componentes/classes/outras_posicoes_class.php');

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
    define('LOGO_HEADER', "../img/logo.png");

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
    <main class="d-flex justify-content-center align-items-center min-vh-100 mt-5">
        <!-- Botão flutuante no canto superior direito da página -->
        <div class="d-grip gap-2 mb-3 fixed-top" id="botao_flutuante">
            <button type="button" class="btn" id="logout">
                <a href="../componentes/logout.php">Sair</a>
            </button>
        </div>

        <!-- Cartão que contém o formulário de cadastro de jogador -->
        <div class="card p-4 shadow-sm" id="card">
            <form action="<?= isset($_POST['id_jogador']) ? '../componentes/execucoes/cadastrar_jogador_exe.php' : './atualizar_jogador.php' ?>" method="post">
                <h2 class="text-center text-white mb-4">Atualizar Jogador(a)</h2>
                <?php if (!isset($_POST['id_jogador'])) { ?>
                    <div class="mb-3"> <!-- Seleção de qual jogador é, se for o caso -->
                        <label for="id_jogador">Qual jogador é?</label>
                        <select name="id_jogador" class="form-select" id="id_jogador" required>
                            <!-- Chama o método da classe Componentes para gerar opções de jogadores -->
                            <?php Componentes::InputJogadores(); ?>
                        </select>
                    </div>
                <?php } else {
                    $jogador = Jogador::getJogador(intval($_POST['id_jogador']));
                ?>
                    <!-- Campo para nome do jogador -->
                    <div class="mb-3">
                        <label for="nome_jogador">Nome: </label>
                        <input type="text" class="form-control" id="nome_jogador" name="nome_jogador" value="<?= $jogador->GetNome() ?>" required>
                    </div>

                    <!-- Campo para apelido do jogador -->
                    <div class="mb-3">
                        <label for="apelido_jogador">Apelido: </label>
                        <input type="text" class="form-control" id="apelido_jogador" name="apelido_jogador" value="<?= $jogador->GetApelido() ?>">
                    </div>

                    <!-- Campo para número da camisa do jogador -->
                    <div class="mb-3">
                        <label for="num_camisa_jogador">Número da camisa do(a) jogador(a): </label>
                        <input type="number" class="form-control" id="num_camisa_jogador" name="num_camisa_jogador" value="<?= $jogador->GetNumeroCamisa() ?>">
                    </div>

                    <!-- Campo para sexo do jogador -->
                    <div class="mb-3">
                        <label for="sexo_jogador">Sexo do(a) jogador(a): </label>
                        <select name="sexo_jogador" class="form-select" id="sexo_jogador" required>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                    </div>

                    <!-- Campo para altura do jogador -->
                    <div class="mb-3">
                        <label for="altura_jogador">Altura do(a) jogador(a): </label>
                        <input type="text" class="form-control" id="altura_jogador" name="altura_jogador">
                    </div>

                    <!-- Campo para peso do jogador -->
                    <div class="mb-3">
                        <label for="peso_jogador">Peso do(a) jogador(a): </label>
                        <input type="text" class="form-control" id="peso_jogador" name="peso_jogador">
                    </div>
                <?php } ?>
                <!-- Botão para cadastrar o jogador -->
                <div class="d-grid gap-2 mb-3">
                    <button id="cadastrar_jogador" class="btn">Atualizar Jogador(a)</button>
                </div>
            </form>
            <!-- Botão para mostrar jogadores cadastrados -->
            <div class="d-grid gap-2 mb-3">
                <a href="./exibir_jogadores.php" class="btn" id="update_jogadores_cadastrados">Mostrar Jogadores Cadastrados</a>
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