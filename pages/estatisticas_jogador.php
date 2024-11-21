<?php
// Inclui o arquivo de proteção para verificar permissões ou autenticação do usuário.
include '../componentes/protect.php';
include '../componentes/classes/levantador_class.php';
include '../componentes/classes/outras_posicoes_class.php';
include '../componentes/classes/libero_class.php';

// Define o caminho do ícone (favicon) da página.
define('FAVICON', "../img/bolas.ico");

// Define os caminhos dos arquivos CSS a serem carregados na página.
define('FOLHAS_DE_ESTILO', array("../css/index.css", "../css/login.css", "../css/style.css"));

// Define os links para as páginas de cadastro de usuário, cadastro de instituição e login.
define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
define('LINK_LOGIN', './login.php');

// Define o caminho do logo que aparece no cabeçalho da página.
define('LOGO_HEADER', "../img/logo.png");

// Define o caminho do ícone de usuário para o login.
define('LOGO_USUARIO', "../img/login.png");

// Define um array com nomes e caminhos de outras páginas para a navegação.
define('OUTRAS_PAGINAS', array(
    ['Página Principal', '../index.php'],
    ['Times', './times.php'],
    ['Estatísticas', './estatisticas.php']
));

// Inclui o cabeçalho da página, que contém a estrutura HTML inicial e a inclusão de CSS e ícones.
include '../componentes/header.php';
?>

<!-- Conteúdo principal da página -->
<main>
    <?php
    if (isset($_SESSION)) {
    ?>
    <!-- Botão flutuante no topo direito da página, utilizado para logout -->
    <div class="d-grip gap-2 mb-3 fixed-top" id="botao_flutuante">
        <button type="button" class="btn" id="logout">
            <!-- Link para o logout, redirecionando para o script de logout -->
            <a href="../componentes/logout.php">Sair</a>
        </button>
    </div>
    <?php
        $levantador = Levantador::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', ' levantador.id_jogador = ' . intval($_GET['id_jogador']));
        $outras = OutrasPosicoes::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', ' outras_posicoes.id_jogador = ' . intval($_GET['id_jogador']));
        $libero = Libero::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', ' libero.id_jogador = ' . intval($_GET['id_jogador']));
        if (!empty($levantador)) {
            $nomeJogador = $levantador[0]->GetNome();
        ?>
    <script>
    var levantador = {
        defesas: <?= $levantador[0]->GetDefesas() ?>,
        ataques: <?= $levantador[0]->GetAtaques() ?>,
        bloqueios: <?= $levantador[0]->GetBloqueios() ?>,
        saques: <?= $levantador[0]->GetSaques() ?>,
        levantamentos: <?= $levantador[0]->GetLevantamentos() ?>
    }
    </script>
    <?php
        }
        if (!empty($outras)) {
            $nomeJogador = $outras[0]->GetNome();
        ?>
    <script>
    var outras = {
        posicao: "<?= $outras[0]->GetPosicao() ?>",
        defesas: <?= $outras[0]->GetDefesas() ?>,
        ataques: <?= $outras[0]->GetAtaques() ?>,
        bloqueios: <?= $outras[0]->GetBloqueios() ?>,
        saques: <?= $outras[0]->GetSaques() ?>,
        passes: <?= $outras[0]->GetPasses() ?>
    }
    </script>
    <?php
        }
        if (!empty($libero)) {
            $nomeJogador = $libero[0]->GetNome();
        ?>
    <script>
    libero = {
        passes: <?= $libero[0]->GetPasses() ?>,
        defesas: <?= $libero[0]->GetDefesas() ?>
    }
    </script>
    <?php
        }
    }

    ?>
    <div class="text-center">
        <h1>Jogador</h1>
    </div>
    <div class="card text-center">
        <div class="card-header">
            <h2><?= $nomeJogador ?></h2>
        </div>
        <div class="d-flex flex-row flex-wrap justify-content-around">
            <?php
            if (!empty($libero) || !empty($outras)) {
            ?>
            <!-- Seção de gráficos para exibir as estatísticas de passes e defesas -->
            <div class="card" style="width: 25%;">
                <div class="card-header text-center">
                    <h3>Passes</h3>
                </div>
                <div class="d-flex flex-row justify-content-around">
                    <?php
                        if (!empty($libero)) {
                        ?>
                    <div class="card" style="width:100%;">
                        <div class="text-center" id="grafico_passe_libero_local">
                            <h3>Líbero</h3>
                        </div>
                    </div>
                    <?php }
                        foreach ($outras as $posicao) {
                        ?>
                    <div class="card" style="width: 100%;">
                        <!-- <div class="text-center"
                            id="grafico_passe_<?= str_replace(' ', '_', str_replace('ã', 'a', str_replace('í', 'i', $posicao->GetPosicao()))) ?>_local"> -->
                        <div class="text-center" id="grafico_passe_outras_local">
                            <h3><?= $posicao->GetPosicao() ?></h3>
                        </div>
                    </div>
                    <?php } ?>
                    <?php
                        if (!empty($levantador) && !empty($outras)) {
                        ?>
                    <div class="card" style="width: 100%;">
                        <div class="text-center" id="grafico_passe_total_local">
                            <h3>Total Passes</h3>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
            <!-- Gráfico para exibir as defesas -->
            <div class="card align-items-center" style="width: 25%;">
                <div class="card-header text-center" style="width: 100%;">
                    <h3>Defesas</h3>
                </div>
                <div class="text-center" style="width: 100%;">
                    <div id="grafico_defesa_local"></div>
                </div>
            </div>
            <?php
            if (!empty($levantador) || !empty($outras)) {
            ?>
            <!-- Gráfico para exibir as defesas -->
            <div class="card" style="width: 50%;">
                <div class="card-header text-center">
                    <h3>Saques</h3>
                </div>
                <div class="d-flex flex-row justify-content-around">
                    <?php if (!empty($levantador)) { ?>
                    <div class="card" style="width: 50%;">
                        <div class="text-center" id="grafico_erros_saques_levantador_local">
                            <h3>Erros e acertos dos levantadores</h3>
                        </div>
                    </div>
                    <div class="card" style="width: 50%;">
                        <div class="text-center" id="grafico_tipos_saques_levantadores_local">
                            <h3>Tipos de saques usados por levantadores</h3>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if (!empty($outras)) { ?>
                    <div class="card" style="width: 50%;">
                        <div class="text-center" id="grafico_erros_saques_outras_local">
                            <h3>Erros e acertos dos outros jogadores</h3>
                        </div>
                    </div>
                    <div class="card" style="width: 50%;">
                        <div class="text-center" id="grafico_tipos_saques_outras_local">
                            <h3>Tipos de saques usados por outros jogadores</h3>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php if (!empty($outras) && !empty($levantador)) { ?>
                <div class="d-flex flex-row justify-content-around">
                    <div class="card" style="width: 50%;">
                        <div class="text-center" id="grafico_erros_saques_total_local">
                            <h3>Total erros e acertos</h3>
                        </div>
                    </div>
                    <div class="card" style="width: 50%;">
                        <div class="text-center" id="grafico_tipos_saques_total_local">
                            <h3>Total tipos de saques usados</h3>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="card" style="width: 25%;">
                <div class="card-header text-center">
                    <h3>Ataques</h3>
                </div>
                <div class="d-flex flex-row justify-content-around">
                    <?php if (!empty($levantador)) { ?>
                    <div class="card" style="width: 100%;">
                        <div class="text-center" id="grafico_ataque_levantador_local">
                            <h3>Erros e acertos dos levantadores</h3>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if (!empty($outras)) { ?>
                    <div class="card" style="width: 100%;">
                        <div class="text-center" id="grafico_ataque_outras_local">
                            <h3>Erros e acertos dos outros jogadores</h3>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if (!empty($outras) && !empty($levantador)) { ?>
                    <div class="card" style="width: 100%;">
                        <div class="text-center" id="grafico_ataque_total_local">
                            <h3>Erros e acertos totais</h3>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="card" style="width: 25%;">
                <div class="card-header text-center">
                    <h3>Bloqueios</h3>
                </div>
                <div class="d-flex flex-row justify-content-around">
                    <?php if (!empty($levantador)) { ?>
                    <div class="card" style="width: 100%;">
                        <div class="text-center" id="grafico_bloqueio_levantador_local">
                            <h3>Erros e acertos dos levantadores</h3>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if (!empty($outras)) { ?>
                    <div class="card" style="width: 100%;">
                        <div class="text-center" id="grafico_bloqueio_outras_local">
                            <h3>Erros e acertos dos outros jogadores</h3>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if (!empty($outras) && !empty($levantador)) { ?>
                    <div class="card" style="width: 100%;">
                        <div class="text-center" id="grafico_bloqueio_total_local">
                            <h3>Erros e acertos totais</h3>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
            <?php if (!empty($levantador)) { ?>
            <div class="card" style="width: 50%;">
                <div class="card-header text-center">
                    <h3>Levantamentos</h3>
                </div>
                <div class="d-flex flex-row justify-content-around">
                    <div class="card" style="width: 50%;">
                        <div class="text-center" id="grafico_erros_levantamento_local">
                            <h3>Erros e acertos</h3>
                        </div>
                    </div>
                    <div class="card" style="width: 50%;">
                        <div class="text-center" id="grafico_tipos_levantamento_local">
                            <h3>Tipos acertados</h3>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</main>

<!-- Inclusão de bibliotecas de JavaScript para criação de gráficos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="module" src="../js/estatisticas_jogador.js"></script>

<?php
// Inclui o rodapé da página, contendo scripts e informações finais.
include '../componentes/footer.php';
?>