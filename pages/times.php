<?php
if (isset($_SESSION['id_usuario'])) {
  // define o caminho do icone em uma constante
  define('FAVICON', "../img/logo-volei.ico");
  // define o caminho do css da página
  define('FOLHAS_DE_ESTILO', array("../css/index.css", "../css/times.css"));
  // define o caminho da logo no header
  define('LOGO_HEADER', "../img/raposa2.png");
  // define os nomes dasa páginas e seus respectivos caminhos
  define('OUTRAS_PAGINAS', array(['Página Principal', '../index.php'], ['Times', './times.php'], ['Estatísticas', './estatisticas.php'], ['Login', './login.php'], ['Registrar Usuário', './login.php']));
  include '../componentes/header.php';
?>
  <main>
    <div class="insercoes" id="insercoes">
      <section class="time">
        <h2 id="time_exportado">
          </h1>
          <h2 id="sexo_time"></h2>
      </section>
      <section class="jogadores">
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
        <h3>Jogadores Principais no Momento</h3>
        <div id="jogadores_principais" class="jogadores_principais_pai">
          <div>
            <p>Levantador</p>
            <div id="jogadores_principais_levantador" class="containerItemPrincipal jogadores_principais">
            </div>
          </div>
          <div>
            <p>Líbero</p>
            <div id="jogadores_principais_libero" class="containerItemPrincipal jogadores_principais">
            </div>
          </div>
          <div>
            <p>Ponta 1</p>
            <div id="jogadores_principais_ponta_1" class="containerItemPrincipal jogadores_principais">
            </div>
          </div>
          <div>
            <p>Ponta 2</p>
            <div id="jogadores_principais_ponta_2" class="containerItemPrincipal jogadores_principais">
            </div>
          </div>
          <div>
            <p>Oposto</p>
            <div id="jogadores_principais_oposto" class="containerItemPrincipal jogadores_principais">
            </div>
          </div>
          <div>
            <p>Central 1</p>
            <div id="jogadores_principais_central_1" class="containerItemPrincipal jogadores_principais">
            </div>
          </div>
          <div>
            <p>Central 2</p>
            <div id="jogadores_principais_central_2" class="containerItemPrincipal jogadores_principais">
            </div>
          </div>
        </div>
        <form action="">
          <div id="jogadores_no_time" class="containerItem"></div>
          <div id="adicionar_jogador">
            <label class="form-label" for="novo_jogador">Novo Jogador</label>
            <select class="form-select" name="novo_jogador" id="novo_jogador"></select>
            <button id="adicionar_jogador_button" type="button" class="btn botao_time">Adicionar
              Jogador</button>
          </div>
          <button id="salvar_informacoes" type="button" class="botao_time btn">Enviar Dados</button>
        </form>
        <button type="button" class="btn botao_time"><a href="./cadastrar_jogador.html" class="nav-link">Cadastrar
            Jogador</a></button>
      </section>
    </div>
    <div class="times">
      <section>
        <h2>Masculino</h2>
        <div id="times_masculinos"></div>
        <button class="btn" style="background-color: #F24405;"><a href="cadastrar_time.html?sexo=M" class="nav-link">Cadastrar
            Time</a></button>
      </section>
      <section>
        <h2>Feminino</h2>
        <div id="times_femininos"></div>
        <button class="btn" style="background-color: #F24405;"><a href="cadastrar_time.html?sexo=F" class="nav-link">Cadastrar
            Time</a></button>
      </section>
      <section>
        <h2>Misto</h2>
        <div id="times_misto"></div>
        <button class="btn " style="background-color: #F24405;"><a href="cadastrar_time.html?sexo=Mis" class="nav-link">Cadastrar
            Time</a></button>
      </section>
    </div>
  </main>
<?php
  include '../componentes/footer.php';
} else {
?>
  <script>
    window.location.href = "./login.php"
  </script><?php
          }
