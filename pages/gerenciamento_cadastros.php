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
<main class="text-center d-flex flex-column justify-content-center align-items-center min-vh-100 mt-5">
    <?php
        $jogadores = Jogador::getJogadores();
        $times = Time::GetTimes(' id_usuario = ' . intval($_SESSION['id_usuario']));
        ?>
    <h1>Gerenciamento</h1>
    <div class="card p-4 shadow-sm" id="card">
        <div class="card-header">
            <h2>Jogadores</h2>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Deletar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jogadores as $jogador) { ?>
                <tr>
                    <td><?= $jogador->GetNome() ?></td>
                    <td><a onclick="confirmarExclusão('../componentes/execucoes/deletar.php?id=<?= $jogador->GetID() ?>&classe=jogador', 'Tem certeza que quer deletar o jogador <?= $jogador->GetNome() ?>? Os dados dele serão perdidos para sempre!')"
                            class="btn btn-danger">Deletar</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="card p-4 shadow-sm" id="card">
        <div class="card-header">
            <h2>Times</h2>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Atualizar</th>
                    <th scope="col">Deletar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($times as $time) { ?>
                <tr>
                    <td><?= $time->GetNome() ?></td>
                    <td><a href="./atualizar_time.php?id=<?= $time->GetID() ?>" class="btn" id="btn">Atualizar</a></td>
                    <td><a onclick="confirmarExclusão('../componentes/execucoes/deletar.php?id=<?= $time->GetID() ?>&classe=time', 'Tem certeza que quer deletar o time <?= $time->GetNome() ?>? Os dados dele serão perdidos para sempre!')"
                            class="btn btn-danger">Deletar</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>
<script src="../js/confirmar_exclusao.js"></script>
<?php
    // Inclui o footer da página
    include '../componentes/footer.php';
} else
    // Redireciona para a página de login se o usuário não estiver logado
    header("Location: ./login.php");
?>