<?php
// Inclui o arquivo de proteção para verificar permissões ou autenticação do usuário.
include '../componentes/protect.php';

// Inclui a classe de usuário, que contém métodos de autenticação e manipulação de dados do usuário.
require_once '../componentes/classes/usuario_class.php';

// Verifica se os dados foram enviados via formulário POST.
if (isset($_POST['email']) && isset($_POST['senha'])) {
    // Verifica se o campo de e-mail está vazio e exibe uma mensagem de erro caso esteja.
    if (strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    }
    // Verifica se o campo de senha está vazio e exibe uma mensagem de erro caso esteja.
    else if (strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {
        // Tenta realizar o login buscando o usuário pelo e-mail fornecido.
        $usuario = Usuario::Logar($_POST['email']);
        $quantidade = count($usuario);

        // Verifica se a senha informada coincide com a armazenada no banco de dados.
        var_dump($_POST['senha']); // Exibe a senha fornecida (para depuração).
        var_dump($usuario[0]->GetSenha()); // Exibe a senha do usuário do banco (para depuração).
        if (password_verify($_POST['senha'], $usuario[0]->GetSenha())) {
            // Inicia a sessão se ainda não estiver ativa.
            if (!isset($_SESSION)) {
                session_start();
            }
            // Armazena informações essenciais do usuário na sessão.
            $_SESSION['id_usuario'] = $usuario[0]->GetID();
            $_SESSION['nome_usuario'] = $usuario[0]->GetNomeUsuario();

            // Se o usuário é treinador, registra essa informação na sessão.
            if ($usuario[0]->GetTreinador()) {
                $_SESSION['treinador'] = true;
            }

            // Redireciona para a página de times após login bem-sucedido.
            header("Location: ./times.php");
        }
        // Exibe mensagem de erro caso a autenticação falhe.
        else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }
    }
}

// Caso o usuário não esteja logado (não tenha 'id_usuario' na sessão).
if (!isset($_SESSION['id_usuario'])) {
    // Define o caminho do favicon da página.
    define('FAVICON', "../img/bolas.ico");
    // Define os caminhos dos arquivos CSS.
    define('FOLHAS_DE_ESTILO', array("../css/index.css", "../css/login.css"));
    define('SCRIPT_LOADING', "../js/loading.js");
    define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
    define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
    define('LINK_LOGIN', './login.php');
    // Define o caminho do logo para o cabeçalho.
    define('LOGO_HEADER', "../img/logo.png");
    define('LOGO_USUARIO', "../img/login.png");
    // Define as páginas para navegação, como a página inicial e de estatísticas.
    define('OUTRAS_PAGINAS', array(
        ['Página Principal', '../index.php'],
        ['Times', './times.php'],
        ['Estatísticas', './estatisticas.php']
    ));

    // Inclui o cabeçalho da página.
    include '../componentes/header.php';
?>
    <!-- HTML para o formulário de login do usuário -->
    <main class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="card p-4 shadow-sm" id="card">
            <h2 class="text-center text-white mb-4">Login</h2>
            <form action="./login.php" method="post">
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email" placeholder="seu@email.com">
                    <!-- Mensagens de erro para validação do campo de e-mail -->
                    <div class="erro text-danger" id="email-requerido-erro">Email é obrigatório</div>
                    <div class="erro text-danger" id="email-invalido-erro">Email é inválido</div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="senha">Senha</label>
                    <input class="form-control" type="password" name="senha" id="senha" placeholder="Senha">
                    <!-- Mensagem de erro para validação do campo de senha -->
                    <div class="erro text-danger" id="senha-requerido-erro">Senha é obrigatória</div>
                </div>
                <div class="d-grid gap-2 mb-3">
                    <!-- Botão de recuperação de senha (desativado) -->
                    <button type="button" class="btn" id="recuperar-senha-botao" disabled>Recuperar senha</button>
                </div>
                <div class="d-grid gap-2">
                    <!-- Botão de login (desativado) -->
                    <button type="submit" class="btn" id="login-botao" disabled>Entrar</button>
                </div>
            </form>
        </div>
    </main>
    <!-- Inclui o arquivo JavaScript para validação do formulário de login -->
    <script type="module" src="../js/login.js"></script>
    <?php
    // Inclui o rodapé da página.
    include '../componentes/footer.php';
    ?>
<?php
}
// Se o usuário já estiver logado, redireciona diretamente para a página de times.
else {
    header("Location: ./times.php");
}
?>