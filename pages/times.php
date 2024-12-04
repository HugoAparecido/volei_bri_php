<?php
// Inclui os arquivos de proteção de sessão e classes necessárias
include('../componentes/protect.php');
include('../componentes/classes/time_class.php');
include('../componentes/classes/libero_class.php');
include('../componentes/classes/levantador_class.php');
include('../componentes/classes/outras_posicoes_class.php');
include('../componentes/classes/componentes_class.php');

// Verifica se o usuário está logado
if (isset($_SESSION['id_usuario'])) {
    // Define constantes para o caminho de ícone, CSS, links de cadastro e login, e logotipo
    define('FAVICON', "../img/bolas.ico");
    define('FOLHAS_DE_ESTILO', array("../css/style.css", "../css/times.css", "../css/inserir_informacoes.css"));
    define('SCRIPT_LOADING', "../js/loading.js");
    define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
    define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
    define('LINK_LOGIN', './login.php');
    define('LOGO_HEADER', "../img/logo.png");
    define('LOGO_USUARIO', "../img/login.png");
    define('LINK_USUARIO_CADASTRADO', array(['Dados para aplicativo', '../componentes/construir_json.php'], ['Gerenciar cadastros efetuados', './gerenciamento_cadastros.php']));

    // Define o nome e caminho das páginas disponíveis
    define('OUTRAS_PAGINAS', array(['Página Principal', '../index.php'], ['Times', './times.php'], ['Estatísticas', './estatisticas.php']));
    include '../componentes/header.php';
?>
<main>
    <!-- Botão para logout no canto superior direito -->
    <div class="d-grip gap-2 mb-3 fixed-top" id="botao_flutuante">
        <button type="button" class="btn" id="logout">
            <a href="../componentes/logout.php">Sair</a>
        </button>
    </div>
    <?php
        // Se existe um ID de time na URL, obtem informações do time
        if (isset($_GET['id_time'])) {
            $time = Time::GetTime((int)$_GET['id_time']);
        ?>
    <div class="d-flex justify-content-center mt-5">
        <!-- Formulário para envio de dados do time -->
        <form action="../componentes/execucoes/enviar_dados.php" method="post" class="w-100 text-center">
            <div class="card w-100 text-center d-flex justify-content-center align-items-center">
                <input type="hidden" name="id_time" value="<?= $time->GetID() ?>">
                <label for="id_competicao" class="form-label m-3">Em qual competição ou treinamento o time
                    está?</label>
                <select name="id_competicao" id="id_competicao" class="form-select m-3" style="width: 500px;">
                    <option value="">Nenhuma</option>
                    <?php
                            Componentes::InputCompeticoes($time->GetID())
                            ?>
                </select>
                <a href="./cadastrar_competicao.php" class="btn m-3" id="btn" style="width: 300px;">Cadastrar
                    Competição</a>
            </div>
            <!-- Card com informações do time e jogadores principais -->
            <div class="card mb-3 mt-5 " style="width: 100%;">
                <div class="card-header">
                    <h2>Time: <?= $time->GetNome() ?></h2>
                </div>
                <div class="col-auto m-3">
                    <h2>Sexo: <?= strtoupper($time->GetSexo()) ?></h2>
                </div>
                <div class="col-auto m-3">
                    <!-- Título para os jogadores principais com ajuste de gênero ('Jogadoras' ou 'Jogadores') -->
                    <h3>Jogador<?= ($time->GetSexo() == 'F' ? 'as' : 'es') ?> Principais no Momento</h3>

                    <?php
                            // Array contendo as posições dos jogadores para exibir nos cards
                            $cardPosicoes = ['Levantador', 'Líbero', 'Ponta 1', 'Ponta 2', 'Oposto', 'Central 1', 'Central 2'];

                            // Loop para criar um card para cada posição dentro do array $cardPosicoes
                            foreach ($cardPosicoes as $indice => $cardPosicao) {
                            ?>

                    <!-- Estrutura de um card para cada posição, com estilo mínimo de altura para manter tamanho uniforme -->
                    <div class="card" style="min-height: 100px; height: auto; min-width:50%; width: auto; float:left;">

                        <!-- Cabeçalho do card que mostra o nome da posição -->
                        <div class="card-header">
                            <p><?= $cardPosicao ?></p>
                        </div>

                        <!-- Div para conter o conteúdo principal do card, com altura mínima para evitar colapso -->
                        <div class="containerItemPrincipal" style="min-height: 100px;"></div>
                    </div>

                    <?php
                            }
                            ?>
                </div>

            </div>
            <!-- Card para listar jogadores de diferentes posições e adicionar no time -->
            <div class="card containerItem">
                <?php
                        // Recupera jogadores e os divide em listas por posição para exibição
                        $time->DefinirJogadores(JogadorTime::getJogadores('jogador', 'id_jogador', 'id_jogador',  'id_time = ' . $time->GetID()));
                        $jogadoresNoTime = [];
                        $componentes = new Componentes();

                        // Lista jogadores por posição e insere no componente adequado
                        foreach ($time->GetJogadores() as $jogador) {
                            $componentes->LocalInsercao($jogador->GetIDJogador(), $jogador->GetNome(), $jogador->GetPosicao(), $jogador->GetNumeroCamisa());
                            array_push($jogadoresNoTime, $jogador->GetIDJogador());
                        }
                        ?>
                <!-- Botão para enviar dados do time -->
                <button type="submit" class="btn m-5" id="btn">Enviar Dados</button>
            </div>
        </form>

    </div>
    <div class="d-flex align-items-center justify-content-center">

        <!-- Formulário para adicionar jogador em cada posição -->
        <form action="../componentes/execucoes/colocar_jogador_time.php" method="post">
            <div class="card m-lg-5 w-80">
                <!-- Campo oculto para armazenar o ID do time -->
                <input type="hidden" name="id_time" value="<?= $time->GetID() ?>">
                <div class="d-flex flex-row flex-wrap align-items-center justify-content-center">
                    <?php
                            // Array associativo que define cada posição de jogador com:
                            // 1) Um rótulo que adapta o gênero e a posição conforme o sexo do time.
                            // 2) Uma lista de jogadores para a posição correspondente, utilizando o método `JuntarTabelas` para fazer as consultas necessárias.
                            $selectsPosicao = [
                                'novo_jogador_libero' => ['Líber' . ($time->GetSexo() == 'F' ? "a" : (($time->GetSexo()) == 'mis' ? "o(a)" : "o")), $liberos = Libero::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', (($time->GetSexo()) == 'mis' ? "" : "jogador.sexo_jogador = '" . $time->GetSexo() . "'") . (count($jogadoresNoTime) ? (($time->GetSexo()) == 'mis' ? '' : ' AND ') . ' libero.id_jogador NOT IN (' . implode(',', $jogadoresNoTime) . ') ' : ''), 'nome_jogador')],
                                'novo_jogador_Levantador' => ['Levantador' . ($time->GetSexo() == 'F' ? "a" : (($time->GetSexo()) == 'mis' ? "(a)" : "")), $levantadores = Levantador::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', (($time->GetSexo()) == 'mis' ? "" : "jogador.sexo_jogador = '" . $time->GetSexo() . "'") . (count($jogadoresNoTime) ? (($time->GetSexo()) == 'mis' ? '' : ' AND ') . 'levantador.id_jogador NOT IN (' . implode(',', $jogadoresNoTime) . ') ' : ''), 'nome_jogador')],
                                'novo_jogador_oposto' => ['Opost' . ($time->GetSexo() == 'F' ? "a" : (($time->GetSexo()) == 'mis' ? "o(a)" : "o")), $opostos = OutrasPosicoes::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', (($time->GetSexo()) == 'mis' ? "" : "jogador.sexo_jogador = '" . $time->GetSexo() . "'") . (($time->GetSexo()) == 'mis' ? '' : ' AND ') . "outras_posicoes.posicao = 'Oposto'" . (count($jogadoresNoTime) ? ' AND outras_posicoes.id_jogador NOT IN (' . implode(',', $jogadoresNoTime) . ')' : ''), 'nome_jogador')],
                                'novo_jogador_ponta_1' => ['Ponta 1', $pontas1 = OutrasPosicoes::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', (($time->GetSexo()) == 'mis' ? "" : "jogador.sexo_jogador = '" . $time->GetSexo() . "' AND ") . "outras_posicoes.posicao = 'Ponta 1'" . (count($jogadoresNoTime) ? ' AND outras_posicoes.id_jogador NOT IN (' . implode(',', $jogadoresNoTime) . ')' : ''), 'nome_jogador')],
                                'novo_jogador_ponta_2' => ['Ponta 2', $pontas1 = OutrasPosicoes::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', (($time->GetSexo()) == 'mis' ? "" : "jogador.sexo_jogador = '" . $time->GetSexo() . "' AND ") . "outras_posicoes.posicao = 'Ponta 2'" . (count($jogadoresNoTime) ? ' AND outras_posicoes.id_jogador NOT IN (' . implode(',', $jogadoresNoTime) . ')' : ''), 'nome_jogador')],
                                'novo_jogador_central' => ['Central', $pontas1 = OutrasPosicoes::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', (($time->GetSexo()) == 'mis' ? "" : "jogador.sexo_jogador = '" . $time->GetSexo() . "' AND ") . "outras_posicoes.posicao = 'Central'" . (count($jogadoresNoTime) ? ' AND outras_posicoes.id_jogador NOT IN (' . implode(',', $jogadoresNoTime) . ')' : ''), 'nome_jogador')],
                                'novo_jogador_outra_posicao' => ['de posição Não Definida', $pontas1 = OutrasPosicoes::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', (($time->GetSexo()) == 'mis' ? "" : "jogador.sexo_jogador = '" . $time->GetSexo() . "' AND ") . "outras_posicoes.posicao = 'Não Definida'" . (count($jogadoresNoTime) ? ' AND outras_posicoes.id_jogador NOT IN (' . implode(',', $jogadoresNoTime) . ')' : ''), 'nome_jogador')],
                            ];
                            // Loop para criar um campo de seleção para cada posição
                            foreach ($selectsPosicao as $name => $conteudo) {
                            ?>

                    <div class="align-self-center">
                        <!-- Rótulo com base no sexo e na posição do jogador -->
                        <label class="m-3"
                            for="<?= $name ?>">Nov<?= $time->GetSexo() == 'F' ? "a" : (($time->GetSexo()) == 'MIS' ? "o(a)" : "o") ?>
                            Jogador<?= $time->GetSexo() == 'F' ? "a" : (($time->GetSexo()) == 'MIS' ? "(a)" : "") ?>
                            <?= $conteudo[0] ?></label>
                        <!-- Campo de seleção para escolher o jogador disponível na posição -->
                        <select class="form-select m-3" style="width: auto;" name="<?= $name ?>">
                            <option value="">Escolha uma posição</option>
                            <?php
                                        // Loop para preencher cada opção com os jogadores disponíveis na posição atual
                                        foreach ($conteudo[1] as $jogador) {
                                        ?>
                            <option value="<?= $jogador->GetID() ?>"><?= $jogador->GetNome() ?></option>
                            <?php
                                        }
                                        ?>
                        </select>
                    </div>

                    <?php
                            }
                            ?>
                </div>
                <div class="d-flex align-items-center justify-content-center flex-column">
                    <!-- Botão para enviar o formulário e adicionar o jogador selecionado -->
                    <button type="submit" class="btn m-3" id="btn">Adicionar Jogador</button>

                    <!-- Link para cadastrar novo jogador -->
                    <a href="./cadastrar_jogador.php" type="button" class="btn m-3" id="btn">Cadastrar Jogador</a>
                </div>
        </form>
    </div>

    <!-- Exibe a lista de times por categoria (Masculino, Feminino e Misto) -->
    </div>
    <?php
        }
        ?>
    <div class="d-flex justify-content-center mt-5 mb-5">
        <div class="card p-4 shadow-sm" id="card">

            <h2 class="text-center text-white mb-3">Masculino</h2>
            <?php
                $timeMasculino = Time::GetTimes("sexo_time = 'M'", 'data_hora_criacao');
                if (!empty($timeMasculino))
                    foreach ($timeMasculino as $time) {
                ?>
            <a class="btn m-1" id="btn-time"
                href="./times.php?id_time=<?= $time->GetID() ?>"><?= $time->GetNome() ?></a>
            <?php
                    }
                ?>
            <a href="cadastrar_time.php?sexo=M" class="btn" id="btn">Cadastrar Time</a>

            <h2 class="text-center text-white mb-3">Feminino</h2>
            <?php
                $timeFeminino = Time::GetTimes("sexo_time = 'F'", 'data_hora_criacao');
                if (!empty($timeFeminino))
                    foreach ($timeFeminino as $time) {
                ?>
            <a class="btn m-1" id="btn-time"
                href="./times.php?id_time=<?= $time->GetID() ?>"><?= $time->GetNome() ?></a>
            <?php
                    }
                ?>
            <a href="cadastrar_time.php?sexo=F" class="btn" id="btn">Cadastrar Time</a>

            <h2 class="text-center text-white mb-3">Misto</h2>
            <?php
                $timeMisto = Time::GetTimes("sexo_time = 'Mis'", 'data_hora_criacao');
                if (!empty($timeMisto))
                    foreach ($timeMisto as $time) {
                ?>
            <a class="btn m-1" id="btn-time"
                href="./times.php?id_time=<?= $time->GetID() ?>"><?= $time->GetNome() ?></a>
            <?php
                    }
                ?>
            <a href="cadastrar_time.php?sexo=Mis" class="btn" id="btn">Cadastrar Time</a>
        </div>
    </div>
    </div>
</main>
<script src="../js/times.js"></script>
<?php
    // Inclui o footer da página
    include '../componentes/footer.php';
} else
    // Redireciona para a página de login se o usuário não estiver logado
    header("Location: ./login.php");
?>