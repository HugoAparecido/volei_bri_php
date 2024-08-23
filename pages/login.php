<?php
include '../componentes/protect.php';
require_once '../componentes/classes/usuario_class.php';
if (isset($_POST['email']) || isset($_POST['senha'])) {
    if (strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if (strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {
        $usuario = Usuario::Logar($_POST['email'], $_POST['senha']);
        $quantidade = count($usuario);
        if ($quantidade == 1) {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['id_usuario'] = $usuario[0]->GetID();
            $_SESSION['nome_usuario'] = $usuario[0]->GetNomeUsuario();
            if ($usuario[0]->GetTreinador()) {
                $_SESSION['treinador'] = true;
            }
            header("Location: ./times.php");
        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }
    }
}
if (!isset($_SESSION['id_usuario'])) {
    // define o caminho do icone em uma constante
    define('FAVICON', "../img/bolas.ico");
    // define o caminho do css da página
    define('FOLHAS_DE_ESTILO', array("../css/index.css", "../css/style.css"));
    // define o caminho da logo no header
    define('LOGO_HEADER', "../img/bolas.png");
    // define os nomes dasa páginas e seus respectivos caminhos
    define('OUTRAS_PAGINAS', array(['Página Principal', '../index.php'], ['Times', './times.php'], ['Estatísticas', './estatisticas.php'], ['Login', './login.php']));
    include '../componentes/header.php';
?>
    <main>
        <h2>Login</h2>
        <form action="" method="post">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="seu@email.com">
            <div id="email-required-error">Email é obrigatório</div>
            <div id="email-invalid-error">Email é inválido</div>
            <div class="mb-3 container">
                <div><label for="senha">Senha</label></div>
                <input type="password" name="senha" id="senha" placeholder="Senha">
                <div id="senha-required-error">Senha é obrigatória</div>
                <button type="button" id="recover-senha-button" disabled="true">Recuperar
                    senha</button>
                <button type="submit" id="login-button" disabled="true">Entrar</button>
        </form>
    </main>
    <?php
    include '../componentes/footer.php';
    ?>
    <script type="module" src="../js/login.js"></script>
<?php
} else {
?>
    <script>
        window.location.href = "./times.php"
    </script>
<?php
}
