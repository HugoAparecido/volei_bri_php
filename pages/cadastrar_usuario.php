<?php
// Inclui arquivos de proteção e classes necessários
include('../componentes/protect.php');
include('../componentes/classes/componenetes_class.php');
include('../componentes/classes/usuario_class.php');

// Verifica se o usuário está logado e se é um treinador
if (isset($_SESSION['id_usuario']) && $_SESSION['treinador']) {
  // Define o caminho do ícone do favicon em uma constante
  define('FAVICON', "../img/bolas.ico");

  // Define o caminho dos arquivos CSS da página em uma constante
  define('FOLHAS_DE_ESTILO', array("../css/cadastro.css", "../css/style.css"));
  define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
  define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
  define('LINK_LOGIN', './login.php');

  // Define o caminho da logo no header em uma constante
  define('LOGO_HEADER', "../img/bolas.png");

  // Define o caminho da logo de login em uma constante
  define('LOGO_USUARIO', "../img/login.png");

  // Define os nomes e caminhos de outras páginas em uma constante
  define('OUTRAS_PAGINAS', array(
    ['Página Principal', '../index.php'],
    ['Times', './times.php'],
    ['Estatísticas', './estatisticas.php']
  ));

  // Inclui o arquivo do cabeçalho da página
  include '../componentes/header.php';
?>
  <!-- Início do conteúdo principal da página -->
  <main class="d-flex flex-column justify-content-center align-items-center min-vh-100 mt-5">

    <div class="card p-4 shadow-sm mb-5" id="card">
      <!-- Formulário para cadastro de usuário -->
      <form action="../componentes/execucoes/cadastrar_usuario_exe.php" method="post">
        <div class="text-center text-light">
          <h2>Cadastro de Usuário</h2>
        </div>

        <div class="mb-3">
          <!-- Campo para inserir o nome -->
          <label for="nome">Nome:</label>
          <input type="text" class="form-control"="nome" id="nome" required>
        </div>

        <div class="mb-3"> <!-- Campo para inserir o email -->
          <label for="email">Email:</label>
          <input type="text" class="form-control"="email" id="email" required>
          <div class="erro text-danger" id="email_requerido_erro">Email é obrigatório</div>
          <div class="erro text-danger" id="email_invalido_erro">Email é inválido</div>
        </div>

        <div class="mb-3"> <!-- Campo para inserir a senha -->
          <label for="senha">Senha:</label>
          <input type="password" class="form-control" name="senha" id="senha" required>
          <div class="erro text-danger" id="senha_requerida_erro">Senha é obrigatória</div>
          <div class="erro" id="senha_min_length_erro">A senha deve ter pelo menos 6 caracteres</div>
        </div>

        <div class="mb-3"> <!-- Campo para confirmar a senha -->
          <label for="confirmasenha">Confirmar Senha:</label>
          <input type="password" class="form-control" name="confirmasenha" id="confirmar_senha" required>
          <div class="erro" id="senha_nao_corresponde_erro">Senha e confirmar senha devem ser iguais</div>
        </div>

        <div class="mb-3"><!-- Opção para marcar se o usuário é jogador -->
          <label>É jogador</label>
          <input type="radio" name="jogador" id="ejogador" value="1">
          <label for="ejogador">Sim</label>
          <input type="radio" name="jogador" id="naoejogador" value="0">
          <label for="naoejogador">Não</label>
        </div>

        <div class="mb-3" id="idJogador"> <!-- Seleção de qual jogador é, se for o caso -->
          <label for="idJogador">Qual jogador é?</label>
          <select name="idJogador" class="form-select">
            <!-- Chama o método da classe Componentes para gerar opções de jogadores -->
            <?php Componentes::InputJogadores() ?>
          </select>
        </div>

        <div class="mb-3"><!-- Opção para marcar se o usuário é treinador -->
          <label>É Treinador</label>
          <input type="radio" name="treinador" id="etreinador" value="1">
          <label for="etreinador">Sim</label>
          <input type="radio" name="treinador" id="naoetreinador" value="0">
          <label for="naoetreinador">Não</label>
        </div>

        <div class="mb-3"><!-- Botão para submeter o formulário -->
          <button type="submit" class="btn" id="botao_cadastro" disabled>Cadastrar</button>
        </div>

      </form>
    </div>
    <div class="card p-4 shadow-sm" id="card">

      <a href="./cadastrar_usuario.php?mostrar=sim" class="btn" id="mostra_usuario">Mostrar Usuários cadastradas</a>
      <?php
      if (isset($_GET['mostrar'])) {
      ?>
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

  <!-- Inclui o script JavaScript para a página -->
  <script type="module" src="../js/cadastrar_usuario.js"></script>
<?php
  // Inclui o arquivo do rodapé da página
  include '../componentes/footer.php';
} else {
  // Se o usuário não estiver logado ou não for treinador, redireciona para a página de times
  header("Location: ./times.php");
}
?>