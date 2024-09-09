<?php
// Inclui o arquivo de proteção, para verificar permissões ou autenticação
include '../componentes/protect.php';

// Inclui a classe de usuário que contém a lógica de autenticação
require_once '../componentes/classes/usuario_class.php';

// Verifica se os dados do formulário foram enviados via método POST
if (isset($_POST['email']) && isset($_POST['senha'])) {
    // Verifica se o campo de e-mail está vazio
    if (strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    }
    // Verifica se o campo de senha está vazio
    else if (strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {
        // Tenta fazer o login do usuário com as credenciais fornecidas
        $usuario = Usuario::Logar($_POST['email']);
        $quantidade = count($usuario);

        // Se o login for bem-sucedido (apenas um usuário retornado)
        var_dump($_POST['senha']);
        var_dump($usuario[0]->GetSenha());
        if (password_verify($_POST['senha'], $usuario[0]->GetSenha())) {
            // Inicia a sessão se ainda não estiver iniciada
            if (!isset($_SESSION)) {
                session_start();
            }
            // Armazena informações do usuário na sessão
            $_SESSION['id_usuario'] = $usuario[0]->GetID();
            $_SESSION['nome_usuario'] = $usuario[0]->GetNomeUsuario();

            // Se o usuário for um treinador, armazena essa informação na sessão
            if ($usuario[0]->GetTreinador()) {
                $_SESSION['treinador'] = true;
            }

            // Redireciona para a página de times
            header("Location: ./times.php");
        }
        // Se a autenticação falhar
        else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }
    }
}

// Se o usuário não estiver logado (variável de sessão 'id_usuario' não está definida)
if (!isset($_SESSION['id_usuario'])) {
    // Define o caminho do ícone da página
    define('FAVICON', "../img/bolas.ico");
    // Define os caminhos dos arquivos CSS para a página
    define('FOLHAS_DE_ESTILO', array("../css/index.css", "../css/login.css"));
    define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
    define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
    // Define o caminho do logo no cabeçalho
    define('LOGO_HEADER', "../img/bolas.png");
    define('LOGO_USUARIO', "../img/login.png");
    // Define os nomes e caminhos de outras páginas
    define('OUTRAS_PAGINAS', array(['Página Principal', '../index.php'], ['Times', './times.php'], ['Estatísticas', './estatisticas.php']));

    // Inclui o arquivo de cabeçalho da página
    include '../componentes/header.php';
?>
    <!-- Estrutura HTML para o formulário de login -->
    <main class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="card p-4 shadow-sm" id="card">
            <h2 class="text-center text-white mb-4">Login</h2>
            <form action="./login.php" method="post">
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email" placeholder="seu@email.com">
                    <div class="erro text-danger" id="email-requerido-erro">Email é obrigatório</div>
                    <div class="erro text-danger" id="email-invalido-erro">Email é inválido</div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="senha">Senha</label>
                    <input class="form-control" type="password" name="senha" id="senha" placeholder="Senha">
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
    <!-- Inclui o arquivo JavaScript para manipulação do formulário -->
    <script type="module" src="../js/login.js"></script>
    <?php
    // Inclui o arquivo de rodapé da página
    include '../componentes/footer.php';
    ?>
<?php
} else
    // Se o usuário já estiver logado, redireciona para a página de times
    header("Location: ./times.php");
