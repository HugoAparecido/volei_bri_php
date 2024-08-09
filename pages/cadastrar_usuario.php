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
  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" href="../img/Logo.png" type="image/x-icon">
  </head>

  <body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg" id="nav">
      <div class="container-fluid" id="nav_container">
        <a class="navbar-brand" href="#">
          <img src="../img/Logo.png" alt="Logo" id="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
          aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../index.html">Página Principal</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../pages/times.html">Times</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../pages/estatisticas.html">Visualizar estatísticas</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <main class="d-flex justify-content-center align-items-center flex-grow-1">
      <div class="text-center w-25">
        <div class="p-4 border rounded-5" style="background-color: #7AB5CB; margin: auto;">
          <a href="#">
            <img src="../img/Logo.png" alt="Logo" class="img-fluid mb-1" style="max-width: 80px;">
          </a>
          <form action="cadastroClienteExe.php" method="post">
            <fieldset>
              <legend class="text-center mb-4">Cadastro</legend>
              <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="text" name="email" id="email" class="form-control" aria-describedby="EmailCliente" required>
              </div>
              <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" name="senha" id="senha" class="form-control" aria-describedby="SenhaCliente" required>
              </div>
              <div class="mb-3">
                <label for="confirmasenha" class="form-label">confirmar Senha:</label>
                <input type="password" name="confirmsenha" id="confirmasenha" class="form-control" aria-describedby="ConfirmaSenhaCliente" required>
              </div>
              <div class="text-center mb-3">
                <button type="submit" class="btn btn-primary">Cadastrar-se</button>
              </div>
              <div class="text-center mb-3">
                <a href="login.php">Fazer Login</a>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </main>
  <?php
  include '../componentes/footer.php';
} else {
  ?>
    <script>
      window.location.href = "./times.php"
    </script><?php
            }
