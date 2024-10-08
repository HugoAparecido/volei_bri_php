<?php
// Inclui os arquivos de proteção de sessão e classes necessárias
include('../componentes/protect.php');
include('../componentes/classes/time_class.php');
include('../componentes/classes/libero_class.php');
include('../componentes/classes/levantador_class.php');
include('../componentes/classes/outras_posicoes_class.php');
include('../componentes/classes/componentes_class.php');

// Verifica se o usuário está logado
if (isset($_SESSION['id_usuario'])) {
  // Define constantes para o caminho de ícone, CSS, links de cadastro e login, e logotipo
  define('FAVICON', "../img/bolas.ico");
  define('FOLHAS_DE_ESTILO', array("../css/style.css", "../css/times.css", "../css/inserir_informacoes.css"));
  define('LINK_CADASTRO_USUARIO', './cadastrar_usuario.php');
  define('LINK_CADASTRO_INSTITUICAO', './cadastrar_instituicao.php');
  define('LINK_LOGIN', './login.php');
  define('LOGO_HEADER', "../img/logo.png");
  define('LOGO_USUARIO', "../img/login.png");

  // Define o nome e caminho das páginas disponíveis
  define('OUTRAS_PAGINAS', array(['Página Principal', '../index.php'], ['Times', './times.php'], ['Estatísticas', './estatisticas.php']));
  include '../componentes/header.php';
?>
  <main class="justify-content-center align-items-center min-vh-100">
    <!-- Botão para logout no canto superior direito -->
    <div class="d-grip gap-2 mb-3 fixed-top" id="botao_flutuante">
      <button type="button" class="btn" id="logout">
        <a href="../componentes/logout.php">Sair</a>
      </button>
    </div>
    <?php
    // Se existe um ID de time na URL, obtem informações do time
    if (isset($_GET['id_time'])) {
      $time = Time::GetTime((int)$_GET['id_time']);
      $sexoProcura = null;
      if ($time->GetSexo() != 'MIS') {
        $sexoProcura = $time->GetSexo();
      }
    ?>
      <div class="d-flex justify-content-center mt-5">
        <!-- Formulário para envio de dados do time -->
        <form action="../componentes/execucoes/enviar_dados.php" method="post">
          <!-- Card com informações do time e jogadores principais -->
          <div class="card mb-3 mt-5">
            <div class="card-header">
              <h2>Time: <?= $time->GetNome() ?></h2>
            </div>
            <div class="col-auto m-3">
              <h2>Sexo: <?= $time->GetSexo() ?></h2>
            </div>
            <div class="col-auto m-3">
              <h3>Jogadores Principais no Momento</h3>
              <p>Levantador</p>
              <p>Líbero</p>
              <p>Ponta 1</p>
              <p>Ponta 2</p>
              <p>Oposto</p>
              <p>Central 1</p>
              <p>Central 2</p>
            </div>
          </div>
          <!-- Card para listar jogadores de diferentes posições e adicionar no time -->
          <div class="card">
            <?php
            // Recupera jogadores e os divide em listas por posição para exibição
            $time->DefinirJogadores(JogadorTime::getJogadores('jogador', 'id_jogador', 'id_jogador',  'id_time = ' . $time->GetID()));
            $jogadoresNoTime = [];
            $componentes = new Componentes();

            // Lista jogadores por posição e insere no componente adequado
            foreach ($time->GetJogadores() as $jogador) {
              $componentes->LocalInsercao($jogador->GetID(), $jogador->GetNome(), $jogador->GetPosicao(), $jogador->GetNumeroCamisa());
              array_push($jogadoresNoTime, $jogador->GetID());
            }
            ?>
            <!-- Botão para enviar dados do time -->
            <button type="submit" class="btn m-5" id="btn">Enviar Dados</button>
          </div>
        </form>

        <!-- Formulário para adicionar jogador em cada posição -->
        <form action="../componentes/execucoes/colocar_jogador_time.php" method="post">
          <div class="card m-lg-5 w-100">
            <input type="hidden" name="id_time" value="<?= $time->GetID() ?>">

            <!-- Seletor de jogadores para cada posição (ex. Líbero, Levantador, Oposto, etc.) -->
            <!-- Opções são filtradas de acordo com o sexo do time e jogadores já cadastrados -->
            <label class="m-3" for="novo_jogador_libero">Nov<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "o(a)" : "o") ?> Jogador<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "(a)" : "") ?> Líber<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "o(a)" : "o") ?></label>
            <select class="form-select m-3 w-50" name="novo_jogador_libero">
              <option value="">Escolha uma posição</option>
              <?php
              $liberos = Libero::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', ($sexoProcura == null ? "" : "jogador.sexo_jogador = '" . $sexoProcura . "'") . (count($jogadoresNoTime) ? ' AND libero.id_jogador NOT IN (' . implode(',', $jogadoresNoTime) . ') ' : ''), 'nome_jogador');
              foreach ($liberos as $libero) {
              ?>
                <option value="<?= $libero->GetID() ?>"><?= $libero->GetNome() ?></option>
              <?php
              }
              ?>
            </select>
            <label class="m-3" for="novo_jogador_Levantador">Nov<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "o(a)" : "o") ?> Jogador<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "(a)" : "") ?> Levantador<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "(a)" : "") ?></label>
            <select class="form-select m-3 w-50" name="novo_jogador_Levantador">
              <option value="">Escolha uma posição</option>
              <?php
              $levantadores = Levantador::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', ($sexoProcura == null ? "" : "jogador.sexo_jogador = '" . $sexoProcura . "'") . (count($jogadoresNoTime) ? ' AND levantador.id_jogador NOT IN (' . implode(',', $jogadoresNoTime) . ') ' : ''), 'nome_jogador');
              foreach ($levantadores as $levantador) {
              ?>
                <option value="<?= $levantador->GetID() ?>"><?= $levantador->GetNome() ?></option>
              <?php
              }
              ?>
            </select>
            <label class="m-3" for="novo_jogador_oposto">Nov<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "o(a)" : "o") ?> Jogador<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "(a)" : "") ?> Opost<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "o(a)" : "o") ?></label>
            <select class="form-select m-3 w-50" name="novo_jogador_oposto">
              <option value="">Escolha uma posição</option>
              <?php
              $opostos = OutrasPosicoes::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', ($sexoProcura == null ? "" : "jogador.sexo_jogador = '" . $sexoProcura . "' AND ") . "outras_posicoes.posicao = 'Oposto'" . (count($jogadoresNoTime) ? ' AND outras_posicoes.id_jogador NOT IN (' . implode(',', $jogadoresNoTime) . ')' : ''), 'nome_jogador');
              foreach ($opostos as $oposto) {
              ?>
                <option value="<?= $oposto->GetID() ?>"><?= $oposto->GetNome() ?></option>
              <?php
              }
              ?>
            </select>
            <label class="m-3" for="novo_jogador_ponta_1">Nov<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "o(a)" : "o") ?> Jogador<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "(a)" : "") ?> Ponta 1</label>
            <select class="form-select m-3 w-50" name="novo_jogador_ponta_1">
              <option value="">Escolha uma posição</option>
              <?php
              $pontas1 = OutrasPosicoes::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', ($sexoProcura == null ? "" : "jogador.sexo_jogador = '" . $sexoProcura . "' AND ") . "outras_posicoes.posicao = 'Ponta 1'" . (count($jogadoresNoTime) ? ' AND outras_posicoes.id_jogador NOT IN (' . implode(',', $jogadoresNoTime) . ')' : ''), 'nome_jogador');
              foreach ($pontas1 as $ponta1) {
              ?>
                <option value="<?= $ponta1->GetID() ?>"><?= $ponta1->GetNome() ?></option>
              <?php
              }
              ?>
            </select>
            <label class="m-3" for="novo_jogador_ponta_2">Nov<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "o(a)" : "o") ?> Jogador<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "(a)" : "") ?> Ponta 2</label>
            <select class="form-select m-3 w-50" name="novo_jogador_ponta_2">
              <option value="">Escolha uma posição</option>
              <?php
              $pontas2 = OutrasPosicoes::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', ($sexoProcura == null ? "" : "jogador.sexo_jogador = '" . $sexoProcura . "' AND ") . "outras_posicoes.posicao = 'Ponta 2'" . (count($jogadoresNoTime) ? ' AND outras_posicoes.id_jogador NOT IN (' . implode(',', $jogadoresNoTime) . ')' : ''), 'nome_jogador');
              foreach ($pontas2 as $ponta2) {
              ?>
                <option value="<?= $ponta2->GetID() ?>"><?= $ponta2->GetNome() ?></option>
              <?php
              }
              ?>
            </select>
            <label class="m-3" for="novo_jogador_central">Nov<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "o(a)" : "o") ?> Jogador<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "(a)" : "") ?> Central</label>
            <select class="form-select m-3 w-50" name="novo_jogador_central">
              <option value="">Escolha uma posição</option>
              <?php
              $central = OutrasPosicoes::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', ($sexoProcura == null ? "" : "jogador.sexo_jogador = '" . $sexoProcura . "' AND ") . "outras_posicoes.posicao = 'Central'" . (count($jogadoresNoTime) ? ' AND outras_posicoes.id_jogador NOT IN (' . implode(',', $jogadoresNoTime) . ')' : ''), 'nome_jogador');
              foreach ($central as $central) {
              ?>
                <option value="<?= $central->GetID() ?>"><?= $central->GetNome() ?></option>
              <?php
              }
              ?>
            </select>
            <label class="m-3" for="novo_jogador_outra_posicao">Nov<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "o(a)" : "o") ?> Jogador<?= $time->GetSexo() == 'F' ? "a" : ($time->GetSexo() == 'MIS' ? "(a)" : "") ?> de posição Não Definida</label>
            <select class="form-select m-3 w-50" name="novo_jogador_outra_posicao">
              <option value="">Escolha uma posição</option>
              <?php
              $naoDefinidas = OutrasPosicoes::JuntarTabelas('jogador', 'id_jogador', 'id_jogador', ($sexoProcura == null ? "" : "jogador.sexo_jogador = '" . $sexoProcura . "' AND ") . "outras_posicoes.posicao = 'Não Definida'" . (count($jogadoresNoTime) ? ' AND outras_posicoes.id_jogador NOT IN (' . implode(',', $jogadoresNoTime) . ')' : ''), 'nome_jogador');
              foreach ($naoDefinidas as $naoDefinida) {
              ?>
                <option value="<?= $naoDefinida->GetID() ?>"><?= $naoDefinida->GetNome() ?></option>
              <?php
              }
              ?>
            </select>
            <button type="submit" class="btn m-3" id="btn">Adicionar Jogador</button>
        </form>

        <!-- Link para cadastrar novo jogador -->
        <a href="./cadastrar_jogador.php" type="button" class="btn m-3 " id="btn">Cadastrar Jogador</a>
      </div>
      <!-- Exibe a lista de times por categoria (Masculino, Feminino e Misto) -->
      </div>
    <?php
    }
    ?>
    <div class="d-flex justify-content-center mt-5 mb-5">
      <div class="card p-4 shadow-sm" id="card">

        <h2 class="text-center text-white mb-3">Masculino</h2>
        <?php
        $timeMasculino = Time::GetTimes("sexo_time = 'M'", 'data_hora_criacao');
        foreach ($timeMasculino as $time) {
        ?>
          <a class="btn m-1" id="btn-time" href="./times.php?id_time=<?= $time->GetID() ?>"><?= $time->GetNome() ?></a>
        <?php
        }
        ?>
        <a href="cadastrar_time.php?sexo=M" class="btn" id="btn">Cadastrar Time</a>

        <h2 class="text-center text-white mb-3">Feminino</h2>
        <?php
        $timeFeminino = Time::GetTimes("sexo_time = 'F'", 'data_hora_criacao');
        foreach ($timeFeminino as $time) {
        ?>
          <a class="btn m-1" id="btn-time" href="./times.php?id_time=<?= $time->GetID() ?>"><?= $time->GetNome() ?></a>
        <?php
        }
        ?>
        <a href="cadastrar_time.php?sexo=F" class="btn" id="btn">Cadastrar Time</a>

        <h2 class="text-center text-white mb-3">Misto</h2>
        <?php
        $timeMisto = Time::GetTimes("sexo_time = 'Mis'", 'data_hora_criacao');
        foreach ($timeMisto as $time) {
        ?>
          <a class="btn m-1" id="btn-time" href="./times.php?id_time=<?= $time->GetID() ?>"><?= $time->GetNome() ?></a>
        <?php
        }
        ?>
        <a href="cadastrar_time.php?sexo=Mis" class="btn" id="btn">Cadastrar Time</a>
      </div>
    </div>
    </div>
  </main>

<?php
  // Inclui o footer da página
  include '../componentes/footer.php';
} else
  // Redireciona para a página de login se o usuário não estiver logado
  header("Location: ./login.php");
?>