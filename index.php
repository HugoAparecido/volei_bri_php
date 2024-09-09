<?php
if (!isset($_SESSION)) {
    session_start();
}
// define o caminho do icone em uma constante
define('FAVICON', "./img/bolas.ico");
// define o caminho do css da página
define('FOLHAS_DE_ESTILO', array("./css/index.css", "./css/style.css"));
// define o caminho da logo no header
define('LOGO_HEADER', "./img/bolas.png");
define('LOGO_USUARIO', "./img/login.png");
// define os nomes dasa páginas e seus respectivos caminhos
define('OUTRAS_PAGINAS', array(['Página Principal', './index.php'], ['Times', './pages/times.php'], ['Estatísticas', './pages/estatisticas.php'], ['Login', './pages/login.php']));
// inclui o header à página
include __DIR__ . '/componentes/header.php';
?>
<main>
    <div id="duvidas">
        <button class="btn" type="button" id="botao_duvidas">?</button>
        <div id="descricao_botoes">
            <p><strong>Def:</strong> defesa bem sucedida</p>
            <p><strong>Def Err:</strong> defesa em que a bola não pode ser pega pelo companheiro</p>
            <p><strong>Pas:</strong> ato de passar a bola entre os jogadores, considerando a altura máxima entre
                a
                jogado de um e o recebimneto do outro. <strong>A:</strong> acima das antenas da rede;
                <strong>B:</strong>o flutuante
                acima da rede e na altura das antenas; <strong>C:</strong> abaixo das antenas e na altura da
                rede;
                <strong>D:</strong> abaixo da rede;
            </p>
        </div>
    </div>
</main>
<?php
// inclui o footer à página
include __DIR__ . '/componentes/footer.php';
