<?php
include('../componentes/protect.php');
if (isset($_SESSION['id_usuario'])) {
  // define o caminho do icone em uma constante
  define('FAVICON', "../img/bolas.ico");
  // define o caminho do css da página
  define('FOLHAS_DE_ESTILO', array("../css/style.css", "../css/times.css"));
  define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
  define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
  define('LINK_LOGIN', './login.php');
  // define o caminho da logo no header
  define('LOGO_HEADER', "../img/bolas.png");
  define('LOGO_USUARIO', "../img/login.png");
  // define os nomes dasa páginas e seus respectivos caminhos
  define('OUTRAS_PAGINAS', array(['Página Principal', '../index.php'], ['Times', './times.php'], ['Estatísticas', './estatisticas.php']));
  include '../componentes/header.php';
?>
  <main class="justify-content-center align-items-center min-vh-100">
    <!-- Botão flutuante no canto superior direito da página -->
    <div class="d-grip gap-2 mb-3 fixed-top" id="botao_flutuante">
      <button type="button" class="btn" id="logout">
        <a href="../componentes/logout.php">Sair</a>
      </button>
    </div>
    <?php
    if (isset($_POST['id_time'])) {
    ?>
      <form action="../componentes/execucoes/enviar_dados.php" method="post">
        <h2>Time:</h2>
        <h2>Sexo:</h2>
        <h3>Jogadores Principais no Momento</h3>
        <p>Levantador</p>
        <p>Líbero</p>
        <p>Ponta 1</p>
        <p>Ponta 2</p>
        <p>Oposto</p>
        <p>Central 1</p>
        <p>Central 2</p>
        <button type="submit">Enviar Dados</button>
      </form>
      <form action="../componentes/execucoes/colocar_jogador_time.php" method="post">
        <label for="novo_jogador">Novo Jogador</label>
        <select name="novo_jogador"></select>
        <button type="submit">Adicionar Jogador</button>
      </form>
      <button type="button"><a href="./cadastrar_jogador.php">Cadastrar Jogador</a></button>
    <?php
    }
    ?>
    <div class="d-flex justify-content-center mt-5">
      <div class="card p-4 shadow-sm" id="card">

        <h2 class="text-center text-white mb-3">Masculino</h2>
        <a href="cadastrar_time.php?sexo=M" class="btn" id="btn">Cadastrar Time</a>

        <h2 class="text-center text-white mb-3">Feminino</h2>
        <a href="cadastrar_time.php?sexo=F" class="btn" id="btn">Cadastrar Time</a>

        <h2 class="text-center text-white mb-3">Misto</h2>
        <a href="cadastrar_time.php?sexo=Mis" class="btn" id="btn">Cadastrar Time</a>
      </div>
    </div>

  </main>
<?php
  include '../componentes/footer.php';
} else
  header("Location: ./login.php");
?>