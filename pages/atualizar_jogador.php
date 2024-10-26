<?php
// Inclui um arquivo para proteger o acesso à página, geralmente validando a autenticação do usuário.
include('../componentes/protect.php');

// Inclui arquivos de classes de componentes que serão usados na página.
include('../componentes/classes/componentes_class.php');
include('../componentes/classes/outras_posicoes_class.php');

// Verifica se a sessão contém a variável 'id_usuario', indicando que o usuário está autenticado.
if (isset($_SESSION['id_usuario'])) {
    // Define uma constante para o caminho do ícone (favicon) da página.
    define('FAVICON', "../img/bolas.ico");

    // Define uma constante contendo caminhos dos arquivos CSS da página.
    define('FOLHAS_DE_ESTILO', array("../css/style.css", "../css/cadastro.css"));

    // Define links constantes para páginas específicas do sistema.
    define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
    define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
    define('LINK_LOGIN', './login.php');

    // Define o caminho da imagem da logo usada no cabeçalho.
    define('LOGO_HEADER', "../img/logo.png");

    // Define o caminho da imagem do ícone de usuário.
    define('LOGO_USUARIO', "../img/login.png");

    // Define uma constante para uma lista de páginas adicionais do site.
    define('OUTRAS_PAGINAS', array(
        ['Página Principal', '../index.php'],
        ['Times', './times.php'],
        ['Estatísticas', './estatisticas.php']
    ));

    // Inclui o arquivo de cabeçalho, que contém a estrutura HTML inicial.
    include '../componentes/header.php';
?>

    <!-- Início do conteúdo principal da página -->
    <main class="d-flex justify-content-center align-items-center min-vh-100 mt-5">
        <!-- Botão flutuante de logout no canto superior direito da página -->
        <div class="d-grip gap-2 mb-3 fixed-top" id="botao_flutuante">
            <button type="button" class="btn" id="logout">
                <a href="../componentes/logout.php">Sair</a>
            </button>
        </div>

        <!-- Cartão que contém o formulário de atualização de jogador -->
        <div class="card p-4 shadow-sm" id="card">
            <form action="<?= isset($_POST['id_jogador']) ? '../componentes/execucoes/atualizar_jogador_exe.php' : './atualizar_jogador.php' ?>" method="post">
                <h2 class="text-center text-white mb-4">Atualizar Jogador(a)</h2>

                <?php if (!isset($_POST['id_jogador'])) { ?>
                    <!-- Campo de seleção para escolher um jogador -->
                    <div class="mb-3">
                        <label for="id_jogador">Qual jogador é?</label>
                        <select name="id_jogador" class="form-select" id="id_jogador" required>
                            <!-- Gera opções de jogadores usando o método da classe Componentes -->
                            <?php Componentes::InputJogadores(); ?>
                        </select>
                    </div>
                <?php } else {
                    // Obtém os dados do jogador selecionado.
                    $jogador = Jogador::getJogador(intval($_POST['id_jogador']));
                ?>
                    <input type="hidden" name="id_jogador" value="<?= $_POST['id_jogador'] ?>">
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
                            <option value="M" <?= $jogador->GetSexo() == "M" ? 'selected' : "" ?>>Masculino</option>
                            <option value="F" <?= $jogador->GetSexo() == "F" ? 'selected' : "" ?>>Feminino</option>
                        </select>
                    </div>

                    <!-- Campo para altura do jogador -->
                    <div class="mb-3">
                        <label for="altura_jogador">Altura do(a) jogador(a): </label>
                        <input type="text" class="form-control" id="altura_jogador" name="altura_jogador" value="<?= $jogador->GetAltura() ?>">
                    </div>

                    <!-- Campo para peso do jogador -->
                    <div class="mb-3">
                        <label for="peso_jogador">Peso do(a) jogador(a): </label>
                        <input type="text" class="form-control" id="peso_jogador" name="peso_jogador" value="<?= $jogador->GetPeso() ?>">
                    </div>
                <?php } ?>

                <!-- Botão de atualização do jogador -->
                <div class="d-grid gap-2 mb-3">
                    <button id="cadastrar_jogador" class="btn">Atualizar Jogador(a)</button>
                </div>
            </form>

            <!-- Link para exibir jogadores cadastrados -->
            <div class="d-grid gap-2 mb-3">
                <a href="./exibir_jogadores.php" class="btn" id="update_jogadores_cadastrados">Mostrar Jogadores Cadastrados</a>
            </div>
        </div>
    </main>

<?php
    // Inclui o rodapé da página, geralmente com scripts ou informações finais.
    include '../componentes/footer.php';
} else {
    // Redireciona o usuário para a página de login caso não esteja autenticado.
    header("Location: ./login.php");
}
?>