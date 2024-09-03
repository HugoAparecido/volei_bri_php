<?php
// Inclui arquivos de proteção e classes necessários
include('../componentes/protect.php');
include('../componentes/classes/componenetes_class.php');

// Verifica se o usuário está logado e se é um treinador
if (isset($_SESSION['id_usuario']) && $_SESSION['treinador']) {
  // Define o caminho do ícone do favicon em uma constante
  define('FAVICON', "../img/bolas.ico");

  // Define o caminho dos arquivos CSS da página em uma constante
  define('FOLHAS_DE_ESTILO', array("../css/cadastro.css", "../css/style.css"));

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
  <main>
    <!-- Logo do site -->
    <a href="#">
      <img src="../img/Logo.png" alt="Logo">
    </a>
    <!-- Formulário para cadastro de usuário -->
    <form action="../componentes/execucoes/cadastrar_usuario_exe.php" method="post">
      <fieldset>
        <legend>Cadastro</legend>

        <!-- Campo para inserir o nome -->
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>

        <!-- Campo para inserir o email -->
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" required>
        <div class="erro text-danger" id="email-requerido-erro">Email é obrigatório</div>
        <div class="erro text-danger" id="email-invalido-erro">Email é inválido</div>

        <!-- Campo para inserir a senha -->
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <div class="erro text-danger" id="senha-requerido-erro">Senha é obrigatória</div>

        <!-- Campo para confirmar a senha -->
        <label for="confirmasenha">Confirmar Senha:</label>
        <input type="password" name="confirmasenha" id="confirmasenha" required>
        <div class="erro text-danger" id="senha-confirmacao-erro">Senha é obrigatória</div>

        <!-- Opção para marcar se o usuário é jogador -->
        <label>É jogador</label>
        <input type="radio" name="jogador" id="ejogador" value="1">
        <label for="ejogador">Sim</label>
        <input type="radio" name="jogador" id="naoejogador" value="0">
        <label for="naoejogador">Não</label>

        <!-- Seleção de qual jogador é, se for o caso -->
        <label for="idJogador">Qual jogador é?</label>
        <select name="idJogador" id="idJogador">
          <!-- Chama o método da classe Componentes para gerar opções de jogadores -->
          <?php Componentes::InputJogadores() ?>
        </select>

        <!-- Opção para marcar se o usuário é treinador -->
        <label>É Treinador</label>
        <input type="radio" name="treinador" id="etreinador" value="1">
        <label for="etreinador">Sim</label>
        <input type="radio" name="treinador" id="naoetreinador" value="0">
        <label for="naoetreinador">Não</label>

        <!-- Botão para submeter o formulário -->
        <button type="submit">Cadastrar</button>
      </fieldset>
    </form>
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