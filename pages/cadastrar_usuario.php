<?php
// include('../componentes/protect.php');
include('../componentes/classes/componenetes_class.php');
if (isset($_SESSION['id_usuario']) && $_SESSION['treinador']) {
  // define o caminho do icone em uma constante
  define('FAVICON', "../img/bolas.ico");
  // define o caminho do css da página
  define('FOLHAS_DE_ESTILO', array("../css/cadastro.css", "../css/style.css"));
  // define o caminho da logo no header
  define('LOGO_HEADER', "../img/bolas.png");
  define('LOGO_USUARIO', "../img/login.png");
  // define os nomes dasa páginas e seus respectivos caminhos
  define('OUTRAS_PAGINAS', array(['Página Principal', '../index.php'], ['Times', './times.php'], ['Estatísticas', './estatisticas.php']));
  include '../componentes/header.php';
?>
  <main>
    <a href="#">
      <img src="../img/Logo.png" alt="Logo">
    </a>
    <form action="../componentes/cadastrar_usuario_exe.php" method="post">
      <fieldset>
        <legend>Cadastro</legend>
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" required>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <label for="confirmasenha">confirmar Senha:</label>
        <input type="password" name="confirmasenha" id="confirmasenha" required>
        <label>É jogador</label>
        <input type="radio" name="jogador" id="ejogador" value="1">
        <label for="ejogador">Sim</label>
        <input type="radio" name="jogador" id="naoejogador" value="0">
        <label for="naoejogador">Não</label>
        <label for="idJogador">Qual jogador é?</label>
        <select name="idJogador" id="idJogador">
          <?php Componentes::InputJogadores() ?>
        </select>
        <label>É Treinador</label>
        <input type="radio" name="treinador" id="etreinador" value="1">
        <label for="etreinador">Sim</label>
        <input type="radio" name="treinador" id="naoetreinador" value="0">
        <label for="naoetreinador">Não</label>
        <button type="submit">Cadastrar</button>
      </fieldset>
    </form>
  </main>
<?php
  include '../componentes/footer.php';
} else {
?>
  <script>
    window.location.href = "./times.php"
  </script><?php
          }
