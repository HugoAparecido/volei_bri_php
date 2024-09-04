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
      <div id="botao_duvidas"><button>?</button></div>
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
      <h2 id="time_exportado">
        </h1>
        <h2 id="sexo_time"></h2>
        <h3>Jogadores Principais no Momento</h3>
        <p>Levantador</p>
        <p>Líbero</p>
        <p>Ponta 1</p>
        <p>Ponta 2</p>
        <p>Oposto</p>
        <p>Central 1</p>
        <p>Central 2</p>
        <label class="form-label" for="novo_jogador">Novo Jogador</label>
        <select class="form-select" name="novo_jogador" id="novo_jogador"></select>
        <button id="adicionar_jogador_button" type="button" class="btn botao_time">Adicionar
          Jogador</button>
        <button id="salvar_informacoes" type="button" class="botao_time btn">Enviar Dados</button>
        <button type="button" class="btn botao_time"><a href="./cadastrar_jogador.php" class="nav-link">Cadastrar
            Jogador</a></button>
        </form>
      <?php
    }
      ?>
      <h2>Masculino</h2>
      <button class="btn"><a href="cadastrar_time.php?sexo=M" class="nav-link">Cadastrar
          Time</a></button>
      <h2>Feminino</h2>
      <button class="btn"><a href="cadastrar_time.php?sexo=F" class="nav-link">Cadastrar
          Time</a></button>
      <h2>Misto</h2>
      <button class="btn "><a href="cadastrar_time.php?sexo=Mis" class="nav-link">Cadastrar
          Time</a></button>
  </main>
<?php
  include '../componentes/footer.php';
} else
  header("Location: ./login.php");
?>