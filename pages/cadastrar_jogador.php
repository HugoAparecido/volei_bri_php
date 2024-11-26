<?php
// Inclui um arquivo para proteger o acesso à página, verificando a autenticação do usuário.
include('../componentes/protect.php');

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
    <main class="d-flex justify-content-center align-items-center min-vh-100 mt-5">

        <!-- Botão flutuante no topo direito para logout -->
        <div class="d-grip gap-2 mb-3 fixed-top" id="botao_flutuante">
            <button type="button" class="btn" id="logout">
                <a href="../componentes/logout.php">Sair</a>
            </button>
        </div>

        <!-- Cartão contendo o formulário de cadastro de um jogador -->
        <div class="card p-4 shadow-sm" id="card">
            <form action="../componentes/execucoes/cadastrar_jogador_exe.php" method="post">
                <h2 class="text-center text-white mb-4">Cadastrar Jogador</h2>

                <!-- Campo para o nome do jogador -->
                <div class="mb-3">
                    <label for="nome_jogador">Nome: </label>
                    <input type="text" class="form-control" id="nome_jogador" name="nome_jogador" required>
                </div>

                <!-- Campo para o apelido do jogador -->
                <div class="mb-3">
                    <label for="apelido_jogador">Apelido: </label>
                    <input type="text" class="form-control" id="apelido_jogador" name="apelido_jogador">
                </div>

                <!-- Campo para o número da camisa do jogador -->
                <div class="mb-3">
                    <label for="num_camisa_jogador">Número da camisa do jogador: </label>
                    <input type="number" class="form-control" id="num_camisa_jogador" name="num_camisa_jogador">
                </div>

                <!-- Campo para a posição do jogador -->
                <div class="mb-3">
                    <label for="posicao_jogador">Posição do jogador: </label>
                    <select name="posicao_jogador" class="form-select" id="posicao_jogador" required>
                        <option value="Não Definida">não definida</option>
                        <option value="Levantador">levantador</option>
                        <option value="Central">central</option>
                        <option value="Ponta 1">ponta 1</option>
                        <option value="Ponta 2">ponta 2</option>
                        <option value="Oposto">oposto</option>
                        <option value="Líbero">líbero</option>
                    </select>
                </div>

                <!-- Campo para o sexo do jogador -->
                <div class="mb-3">
                    <label for="sexo_jogador">Sexo do jogador: </label>
                    <select name="sexo_jogador" class="form-select" id="sexo_jogador" required>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>

                <!-- Campo para a altura do jogador -->
                <div class="mb-3">
                    <label for="altura_jogador">Altura do jogador: </label>
                    <input type="text" class="form-control" id="altura_jogador" name="altura_jogador">
                </div>

                <!-- Campo para o peso do jogador -->
                <div class="mb-3">
                    <label for="peso_jogador">Peso do jogador: </label>
                    <input type="text" class="form-control" id="peso_jogador" name="peso_jogador">
                </div>

                <!-- Botão para submeter o cadastro do jogador -->
                <div class="d-grid gap-2 mb-3">
                    <button id="cadastrar_jogador" class="btn">Cadastrar Jogador</button>
                </div>
            </form>

            <!-- Link para a página de atualização de dados de jogadores existentes -->
            <div class="d-grid gap-2 mb-3">
                <a href="./atualizar_jogador.php" class="btn" id="update_jogadores_cadastrados">Atualizar Jogador Existente</a>
            </div>

            <!-- Link para a página de exibição de jogadores cadastrados -->
            <div class="d-grid gap-2 mb-3">
                <a href="./exibir_jogadores.php" class="btn" id="update_jogadores_cadastrados">Mostrar Jogadores Cadastrados</a>
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