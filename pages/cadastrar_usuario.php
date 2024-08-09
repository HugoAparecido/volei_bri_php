<?php
include('../componentes/protect.php');
if (isset($_SESSION['id_usuario']) && $_SESSION['treinador']) {
  // define o caminho do icone em uma constante
  define('FAVICON', "../img/bolas.ico");
  // define o caminho do css da página
  define('FOLHAS_DE_ESTILO', array("../css/cadastro.css", "../css/style.css"));
  // define o caminho da logo no header
  define('LOGO_HEADER', "../img/bolas.png");
  // define os nomes dasa páginas e seus respectivos caminhos
  define('OUTRAS_PAGINAS', array(['Página Principal', '../index.php'], ['Times', './times.php'], ['Estatísticas', './estatisticas.php']));
  include '../componentes/header.php';
?>
  <main>
    <a href="#">
      <img src="../img/Logo.png" alt="Logo">
    </a>
    <form action="cadastroClienteExe.php" method="post">
      <fieldset>
        <legend>Cadastro</legend>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" aria-describedby="EmailCliente" required>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" aria-describedby="SenhaCliente" required>
        <label for="confirmasenha">confirmar Senha:</label>
        <input type="password" name="confirmsenha" id="confirmasenha" aria-describedby="ConfirmaSenhaCliente" required>
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
