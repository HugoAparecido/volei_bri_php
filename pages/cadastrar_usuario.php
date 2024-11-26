<?php
// Inclui arquivos essenciais para proteção de acesso e classes auxiliares.
include('../componentes/protect.php');
include('../componentes/classes/componentes_class.php');
include('../componentes/classes/usuario_class.php');

// Verifica se o usuário está logado e tem permissão de treinador.
if (isset($_SESSION['id_usuario']) && $_SESSION['treinador']) {

    // Define uma constante para o caminho do ícone da página (favicon).
    define('FAVICON', "../img/bolas.ico");

    // Define caminhos para os arquivos CSS utilizados na página.
    define('FOLHAS_DE_ESTILO', array("../css/cadastro.css", "../css/style.css"));

    define('SCRIPT_LOADING', "../js/loading.js");

    // Define links para páginas de cadastro e login.
    define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
    define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
    define('LINK_LOGIN', './login.php');

    // Define o caminho da logo para o cabeçalho.
    define('LOGO_HEADER', "../img/logo.png");

    // Define o caminho do ícone do usuário para login.
    define('LOGO_USUARIO', "../img/login.png");
    define('LINK_USUARIO_CADASTRADO', array(['Dados para aplicativo', '../componentes/construir_json.php'], ['Gerenciar cadastros efetuados', '../componentes/gerenciamento_cadastro.php']));

    // Define um array com links de navegação para outras páginas do site.
    define('OUTRAS_PAGINAS', array(
        ['Página Principal', '../index.php'],
        ['Times', './times.php'],
        ['Estatísticas', './estatisticas.php']
    ));

    // Inclui o cabeçalho da página com estrutura de HTML e links para CSS e favicon.
    include '../componentes/header.php';
?>

    <!-- Início do conteúdo principal da página -->
    <main class="d-flex flex-column justify-content-center align-items-center min-vh-100 mt-5">

        <!-- Botão flutuante no canto superior direito para logout -->
        <div class="d-grip gap-2 mb-3 fixed-top" id="botao_flutuante">
            <button type="button" class="btn" id="logout">
                <a href="../componentes/logout.php">Sair</a>
            </button>
        </div>

        <!-- Cartão contendo o formulário de cadastro de usuário -->
        <div class="card p-4 shadow-sm mb-5" id="card">
            <form action="../componentes/execucoes/cadastrar_usuario_exe.php" method="post">

                <!-- Título do formulário -->
                <div class="text-center text-light">
                    <h2>Cadastro de Usuário</h2>
                </div>

                <!-- Campo para inserir o nome do usuário -->
                <div class="mb-3">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" id="nome" required>
                </div>

                <!-- Campo para inserir o email do usuário -->
                <div class="mb-3">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" id="email" required>
                    <div class="erro text-danger" id="email_requerido_erro">Email é obrigatório</div>
                    <div class="erro text-danger" id="email_invalido_erro">Email é inválido</div>
                </div>

                <!-- Campo para inserir a senha do usuário -->
                <div class="mb-3">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" name="senha" id="senha" required>
                    <div class="erro text-danger" id="senha_requerida_erro">Senha é obrigatória</div>
                    <div class="erro" id="senha_min_length_erro">A senha deve ter pelo menos 6 caracteres</div>
                </div>

                <!-- Campo para confirmar a senha -->
                <div class="mb-3">
                    <label for="confirmasenha">Confirmar Senha:</label>
                    <input type="password" class="form-control" name="confirmasenha" id="confirmar_senha" required>
                    <div class="erro" id="senha_nao_corresponde_erro">Senha e confirmar senha devem ser iguais</div>
                </div>

                <!-- Opção para marcar se o usuário é jogador -->
                <div class="mb-3">
                    <label>É jogador</label>
                    <input type="radio" name="jogador" id="ejogador" value="1">
                    <label for="ejogador">Sim</label>
                    <input type="radio" name="jogador" id="naoejogador" value="0">
                    <label for="naoejogador">Não</label>
                </div>

                <!-- Campo para selecionar o jogador, se o usuário for jogador -->
                <div class="mb-3" id="idJogador">
                    <label for="idJogador">Qual jogador é?</label>
                    <select name="idJogador" class="form-select">
                        <!-- Gera opções de jogadores usando um método da classe Componentes -->
                        <?php Componentes::InputJogadores() ?>
                    </select>
                    <a href="./cadastrar_jogador.php" class="btn">Me cadastrar como jogador</a>
                </div>

                <!-- Opção para marcar se o usuário é treinador -->
                <div class="mb-3">
                    <label>É Treinador</label>
                    <input type="radio" name="treinador" id="etreinador" value="1">
                    <label for="etreinador">Sim</label>
                    <input type="radio" name="treinador" id="naoetreinador" value="0">
                    <label for="naoetreinador">Não</label>
                </div>

                <!-- Botão para submeter o formulário de cadastro -->
                <div class="mb-3">
                    <button type="submit" class="btn" id="botao_cadastro" disabled>Cadastrar</button>
                </div>

            </form>
        </div>

        <!-- Cartão para exibir usuários cadastrados -->
        <div class="card p-4 shadow-sm" id="card">
            <a href="./cadastrar_usuario.php?mostrar=sim" class="btn" id="mostra_usuario">Mostrar Usuários cadastradas</a>

            <?php
            // Verifica se o parâmetro 'mostrar' está definido na URL para exibir a lista de usuários cadastrados.
            if (isset($_GET['mostrar'])) {
            ?>
                <!-- Tabela para exibir informações dos usuários cadastrados -->
                <table>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nome</td>
                            <td>E-mail</td>
                            <td>É jogador</td>
                            <td>É treinador</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Obtém a lista de usuários e exibe cada um em uma linha da tabela.
                        $usuarios = Usuario::GetUsuarios();
                        foreach ($usuarios as $usuario) {
                        ?>
                            <tr>
                                <td><?= $usuario->GetID() ?></td>
                                <td><?= $usuario->GetNomeUsuario() ?></td>
                                <td><?= $usuario->GetEmailUsuario() ?></td>
                                <td><?= $usuario->GetJogador() ? "Sim" : "Não" ?></td>
                                <td><?= $usuario->GetTreinador() ? "Sim" : "Não" ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            }
            ?>
        </div>

    </main>

    <!-- Inclui o script JavaScript específico da página de cadastro -->
    <script type="module" src="../js/cadastrar_usuario.js"></script>
<?php
    // Inclui o rodapé da página, com scripts adicionais e informações finais.
    include '../componentes/footer.php';
} else {
    // Se o usuário não estiver logado ou não for treinador, redireciona para a página de times.
    header("Location: ./times.php");
}
?>