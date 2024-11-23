<?php
// Inclui um arquivo para proteger o acesso à página, geralmente validando a autenticação do usuário.
include('../componentes/protect.php');

// Inclui arquivos de classes de componentes que serão usados na página.
include('../componentes/classes/componentes_class.php');
include('../componentes/classes/outras_posicoes_class.php');
include('../componentes/classes/levantador_class.php');
include('../componentes/classes/libero_class.php');

// Verifica se a sessão contém a variável 'id_usuario', indicando que o usuário está autenticado.
if (isset($_SESSION['id_usuario'])) {
    // Define uma constante para o caminho do ícone (favicon) da página.
    define('FAVICON', "../img/bolas.ico");

    // Define uma constante contendo caminhos dos arquivos CSS da página.
    define('FOLHAS_DE_ESTILO', array("../css/style.css", "../css/cadastro.css"));

    define('SCRIPT_LOADING', "../js/loading.js");

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
        <form
            action="<?= isset($_POST['id_jogador']) ? '../componentes/execucoes/atualizar_jogador_exe.php' : './atualizar_jogador.php' ?>"
            method="post">
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

                    // Obtém uma instância do jogador na posição de libero, utilizando o ID passado pelo formulário
                    $libero = Libero::getJogador(intval($_POST['id_jogador']));

                    // Obtém uma instância do jogador na posição de levantador, utilizando o ID passado pelo formulário
                    $levantador = Levantador::getJogador(intval($_POST['id_jogador']));

                    // Obtém uma lista de jogadores em outras posições, utilizando o ID passado pelo formulário
                    $outras = OutrasPosicoes::getJogadoresPosicao('id_jogador = ' . intval($_POST['id_jogador']));

                    // Define um array para armazenar quais posições devem ser excluídas, com valores iniciais como "falso" para cada posição
                    $posicoesExcluir = [
                        'central' => false,
                        'ponta 1' => false,
                        'ponta 2' => false,
                        'oposto' => false,
                        'nao definida' => false
                    ];

                    // Itera sobre a lista de jogadores em outras posições
                    foreach ($outras as $posicao) {
                        // Verifica a posição do jogador atual e define o valor como "verdadeiro" no array, caso a posição corresponda
                        foreach ($posicoesExcluir as $chave => $valor) {
                            if ($chave === $posicao->GetPosicao()) {
                                $valor = true;
                            }
                        }
                    }

                ?>

            <!-- Campo oculto para armazenar o ID do jogador enviado via POST -->
            <input type="hidden" name="id_jogador" value="<?= $_POST['id_jogador'] ?>">

            <!-- Campo para selecionar a posição do jogador -->
            <div class="mb-3">
                <label for="posicao_jogador">Posição do jogador: </label>

                <!-- Menu suspenso para seleção da posição -->
                <select name="posicao_jogador" class="form-select" id="posicao_jogador">

                    <!-- Opção padrão para não atribuir outra posição -->
                    <option value="">Não colocar em outra</option>

                    <!-- Adiciona a opção "Não Definida" se ainda não estiver marcada para exclusão -->
                    <?= !$posicoesExcluir['nao definida'] ? "<option value='não definida'>Não Definida</option>" : "" ?>

                    <!-- Adiciona a opção "Levantador" se o jogador ainda não está configurado como levantador -->
                    <?= !$levantador ? "<option value='levantador'>Levantador</option>" : "" ?>

                    <!-- Adiciona a opção "Central" se a posição ainda não estiver marcada para exclusão -->
                    <?= !$posicoesExcluir['central'] ? "<option value='central'>Central</option>" : "" ?>

                    <!-- Adiciona a opção "Ponta 1" se a posição ainda não estiver marcada para exclusão -->
                    <?= !$posicoesExcluir['ponta 1'] ? "<option value='ponta 1'>Ponta 1</option>" : "" ?>

                    <!-- Adiciona a opção "Ponta 2" se a posição ainda não estiver marcada para exclusão -->
                    <?= !$posicoesExcluir['ponta 2'] ? "<option value='ponta 2'>Ponta 2</option>" : "" ?>

                    <!-- Adiciona a opção "Oposto" se a posição ainda não estiver marcada para exclusão -->
                    <?= !$posicoesExcluir['oposto'] ? "<option value='oposto'>Oposto</option>" : "" ?>

                    <!-- Adiciona a opção "Líbero" se o jogador ainda não está configurado como líbero -->
                    <?= !$libero ? "<option value='líbero'>líbero</option>" : "" ?>
                </select>
            </div>

            <!-- Campo para nome do jogador -->
            <div class="mb-3">
                <label for="nome_jogador">Nome: </label>
                <input type="text" class="form-control" id="nome_jogador" name="nome_jogador"
                    value="<?= $jogador->GetNome() ?>" required>
            </div>

            <!-- Campo para apelido do jogador -->
            <div class="mb-3">
                <label for="apelido_jogador">Apelido: </label>
                <input type="text" class="form-control" id="apelido_jogador" name="apelido_jogador"
                    value="<?= $jogador->GetApelido() ?>">
            </div>

            <!-- Campo para número da camisa do jogador -->
            <div class="mb-3">
                <label for="num_camisa_jogador">Número da camisa do(a) jogador(a): </label>
                <input type="number" class="form-control" id="num_camisa_jogador" name="num_camisa_jogador"
                    value="<?= $jogador->GetNumeroCamisa() ?>">
            </div>

            <!-- Campo para sexo do jogador -->
            <div class="mb-3">
                <label for="sexo_jogador">Sexo do(a) jogador(a): </label>
                <select name="sexo_jogador" class="form-select" id="sexo_jogador" disabled>
                    <option value="M" <?= $jogador->GetSexo() == "M" ? 'selected' : "" ?>>Masculino</option>
                    <option value="F" <?= $jogador->GetSexo() == "F" ? 'selected' : "" ?>>Feminino</option>
                </select>
            </div>

            <!-- Campo para altura do jogador -->
            <div class="mb-3">
                <label for="altura_jogador">Altura do(a) jogador(a): </label>
                <input type="text" class="form-control" id="altura_jogador" name="altura_jogador"
                    value="<?= $jogador->GetAltura() ?>">
            </div>

            <!-- Campo para peso do jogador -->
            <div class="mb-3">
                <label for="peso_jogador">Peso do(a) jogador(a): </label>
                <input type="text" class="form-control" id="peso_jogador" name="peso_jogador"
                    value="<?= $jogador->GetPeso() ?>">
            </div>
            <?php } ?>

            <!-- Botão de atualização do jogador -->
            <div class="d-grid gap-2 mb-3">
                <button id="cadastrar_jogador" class="btn">Atualizar Jogador(a)</button>
            </div>
        </form>

        <!-- Link para exibir jogadores cadastrados -->
        <div class="d-grid gap-2 mb-3">
            <a href="./exibir_jogadores.php" class="btn" id="update_jogadores_cadastrados">Mostrar Jogadores
                Cadastrados</a>
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