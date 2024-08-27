<?php
include '../componentes/protect.php';
require_once '../componentes/classes/usuario_class.php';
if (isset($_POST['email']) || isset($_POST['password'])) {
    if (strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if (strlen($_POST['password']) == 0) {
        echo "Preencha sua senha";
    } else {
        $usuario = Usuario::Logar($_POST['email'], $_POST['password']);
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
    define('FOLHAS_DE_ESTILO', array("../css/index.css", "../css/login.css"));
    // define o caminho da logo no header
    define('LOGO_HEADER', "../img/bolas.png");
    // define os nomes dasa páginas e seus respectivos caminhos
    define('OUTRAS_PAGINAS', array(['Página Principal', '../index.php'], ['Times', './times.php'], ['Estatísticas', './estatisticas.php'], ['Login', './login.php']));
    include '../componentes/header.php';
?>
    <main class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="card p-4 shadow-sm" id="card">
            <h2 class="text-center text-white mb-4">Login</h2>
            <form action="./login.php" method="post">
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email" placeholder="seu@email.com">
                    <div class="error text-danger" id="email-required-error">Email é obrigatório</div>
                    <div class="error text-danger" id="email-invalid-error">Email é inválido</div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Senha</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="Senha">
                    <div class="error text-danger" id="password-required-error">Senha é obrigatória</div>
                </div>
                <div class="d-grid gap-2 mb-3">
                    <button type="button" class="btn" id="recover-password-button" disabled>Recuperar senha</button>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn" id="login-button" disabled>Entrar</button>
                </div>
            </form>
        </div>
    </main>
    <script type="module" src="../js/login.js"></script>
    <?php
    include '../componentes/footer.php';
    ?>
<?php
} else {
?>
    <script>
        window.location.href = "./times.php"
    </script>
<?php
}
