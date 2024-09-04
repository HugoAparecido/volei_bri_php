<?php
include('../componentes/protect.php');
if (isset($_SESSION['id_usuario'])) {
  // define o caminho do icone em uma constante
  define('FAVICON', "../img/bolas.ico");
  // define o caminho do css da página
  define('FOLHAS_DE_ESTILO', array("../css/style.css", "../css/times.css"));
  // define o caminho da logo no header
  define('LOGO_HEADER', "../img/bolas.png");
  define('LOGO_USUARIO', "../img/login.png");
  // define os nomes dasa páginas e seus respectivos caminhos
  define('OUTRAS_PAGINAS', array(['Página Principal', '../index.php'], ['Times', './times.php'], ['Estatísticas', './estatisticas.php']));
  include '../componentes/header.php';
?>
  <main>
    <!-- Botão flutuante no canto superior direito da página -->
    <div class="d-grip gap-2 mb-3 fixed-top" id="botao_flutuante">
      <button type="button" class="btn" id="logout">
        <a href="../componentes/logout.php">Sair</a>
      </button>
    </div>
    <div id="duvidas">
      <button class="btn" type="button" id="botao_duvidas">?</button>
      <div id="descricao_botoes">
        <p><strong>Def:</strong> defesa bem sucedida</p>
        <p><strong>Def Err:</strong> defesa em que a bola não pode ser pega pelo companheiro</p>
        <p><strong>Pas:</strong> ato de passar a bola entre os jogadores, considerando a altura máxima entre
          a
          jogado de um e o recebimneto do outro. <strong>A:</strong> acima das antenas da rede;
          <strong>B:</strong>
          acima da rede e na altura das antenas; <strong>C:</strong> abaixo das antenas e na altura da
          rede;
          <strong>D:</strong> abaixo da rede;
        </p>
      </div>
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
    <h2>Masculino</h2>
    <button class="btn"><a href="cadastrar_time.php?sexo=M">Cadastrar Time</a></button>
    <h2>Feminino</h2>
    <button class="btn"><a href="cadastrar_time.php?sexo=F">Cadastrar Time</a></button>
    <h2>Misto</h2>
    <button class="btn "><a href="cadastrar_time.php?sexo=Mis">Cadastrar Time</a></button>
  </main>
<?php
  include '../componentes/footer.php';
} else
  header("Location: ./login.php");
?>