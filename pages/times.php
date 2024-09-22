<?php
include('../componentes/protect.php');
include('../componentes/classes/time_class.php');
include('../componentes/classes/libero_class.php');
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
    if (isset($_GET['id_time'])) {
      $time = Time::GetTime((int)$_GET['id_time']);
      $sexoProcura = null;
      if ($time->GetSexo() != 'MIS') {
        $sexoProcura = $time->GetSexo();
      }
    ?>
      <form action="../componentes/execucoes/enviar_dados.php" method="post">
        <h2>Time: <?= $time->GetNome() ?></h2>
        <h2>Sexo: <?= $time->GetSexo() ?></h2>
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
        <label for="novo_jogador_libero">Nov<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "o(a)" : "o") ?> Jogador<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "(a)" : "") ?> Líbero</label>
        <select name="novo_jogador_libero">
          <?php
          $liberos = Libero::getJogadores("sexo_");
          ?>
        </select>
        <label for="novo_jogador_Levantador">Nov<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "o(a)" : "o") ?> Jogador<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "(a)" : "") ?> Levantador<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "(a)" : "") ?></label>
        <select name="novo_jogador_Levantador">
        </select>
        <label for="novo_jogador_oposto">Nov<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "o(a)" : "o") ?> Jogador<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "(a)" : "") ?> Opost<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "o(a)" : "o") ?></label>
        <select name="novo_jogador_oposto">
        </select>
        <label for="novo_jogador_Libero">Nov<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "o(a)" : "o") ?> Jogador<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "(a)" : "") ?> Ponta 1</label>
        <select name="novo_jogador_Libero">
        </select>
        <label for="novo_jogador_Libero">Nov<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "o(a)" : "o") ?> Jogador<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "(a)" : "") ?> Ponta 2</label>
        <select name="novo_jogador_Libero">
        </select>
        <label for="novo_jogador_Libero">Nov<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "o(a)" : "o") ?> Jogador<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "(a)" : "") ?> Central</label>
        <select name="novo_jogador_Libero">
        </select>
        <label for="novo_jogador_Libero">Nov<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "o(a)" : "o") ?> Jogador<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "(a)" : "") ?> de posição Não Definida</label>
        <select name="novo_jogador_Libero">
        </select>
        <button type="submit">Adicionar Jogador</button>
      </form>
      <button type="button"><a href="./cadastrar_jogador.php">Cadastrar Jogador</a></button>
    <?php
    }
    ?>
    <div class="d-flex justify-content-center mt-5">
      <div class="card p-4 shadow-sm" id="card">

        <h2 class="text-center text-white mb-3">Masculino</h2>
        <?php
        $timeMasculino = Time::GetTimes("sexo_time = 'M'", 'data_hora_criacao');
        foreach ($timeMasculino as $time) {
        ?>
          <a href="./times.php?id_time=<?= $time->GetID() ?>"><?= $time->GetNome() ?></a>
        <?php
        }
        ?>
        <a href="cadastrar_time.php?sexo=M" class="btn" id="btn">Cadastrar Time</a>

        <h2 class="text-center text-white mb-3">Feminino</h2>
        <?php
        $timeFeminino = Time::GetTimes("sexo_time = 'F'", 'data_hora_criacao');
        foreach ($timeFeminino as $time) {
        ?>
          <a href="./times.php?id_time=<?= $time->GetID() ?>"><?= $time->GetNome() ?></a>
        <?php
        }
        ?>
        <a href="cadastrar_time.php?sexo=F" class="btn" id="btn">Cadastrar Time</a>

        <h2 class="text-center text-white mb-3">Misto</h2>
        <?php
        $timeMisto = Time::GetTimes("sexo_time = 'Mis'", 'data_hora_criacao');
        foreach ($timeMisto as $time) {
        ?>
          <a href="./times.php?id_time=<?= $time->GetID() ?>"><?= $time->GetNome() ?></a>
        <?php
        }
        ?>
        <a href="cadastrar_time.php?sexo=Mis" class="btn" id="btn">Cadastrar Time</a>
      </div>
    </div>

  </main>
<?php
  include '../componentes/footer.php';
} else
  header("Location: ./login.php");
?>