<?php
// Define o caminho do ícone do site em uma constante.
define('FAVICON', "../img/bolas.ico");

// Define os caminhos dos arquivos CSS utilizados na página.
define('FOLHAS_DE_ESTILO', array("../css/index.css", "../css/login.css"));
define('SCRIPT_LOADING', "../js/loading.js");

// Define os links para as páginas de cadastro de usuário, instituição e login.
define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
define('LINK_LOGIN', './login.php');

// Define o caminho da logo exibida no cabeçalho.
define('LOGO_HEADER', "../img/logo.png");
define('LINK_USUARIO_CADASTRADO', array(['Dados para aplicativo', '../componentes/construir_json.php'], ['Gerenciar cadastros efetuados', '../componentes/gerenciamento_cadastro.php']));

// Define os nomes e caminhos de outras páginas para navegação.
define('OUTRAS_PAGINAS', array(
    ['Página Principal', '../index.php'],
    ['Times', './times.php'],
    ['Estatísticas', './estatisticas.php'],
    ['Login', './login.php']
));

// Inclui o cabeçalho da página.
include '../componentes/header.php';
?>

<!-- Estrutura HTML do formulário de login -->
<main class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="card p-4 shadow-sm" id="card">
        <h2 class="text-center text-white mb-4">Login</h2>
        <form action="./login.php" method="post">
            <!-- Campo de e-mail com mensagens de erro para validação -->
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="seu@email.com">
                <div class="error text-danger" id="email-required-error">Email é obrigatório</div>
                <div class="error text-danger" id="email-invalid-error">Email é inválido</div>
            </div>

            <!-- Campo de senha com mensagem de erro para validação -->
            <div class="mb-3">
                <label class="form-label" for="password">Senha</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="Senha">
                <div class="error text-danger" id="password-required-error">Senha é obrigatória</div>
            </div>

            <!-- Botão de recuperação de senha (desativado por padrão) -->
            <div class="d-grid gap-2 mb-3">
                <button type="button" class="btn" id="recover-password-button" disabled>Recuperar senha</button>
            </div>

            <!-- Botão de login (desativado por padrão) -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn" id="login-button" disabled>Entrar</button>
            </div>
        </form>
    </div>
</main>

<?php
// Inclui o rodapé da página.
include '../componentes/footer.php';
?>