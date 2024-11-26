<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vôlei BRI</title>

    <!-- Favicon da página, usando o caminho definido na constante FAVICON -->
    <link rel="shortcut icon" href="<?= FAVICON ?>" type="image/x-icon">

    <?php
    // Inclui cada arquivo CSS da lista definida na constante FOLHAS_DE_ESTILO
    foreach (FOLHAS_DE_ESTILO as $link_css) {
    ?>
    <link rel="stylesheet" href="<?= $link_css ?>">
    <?php } ?>

    <!-- Inclui o CSS do Bootstrap para estilização da página -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="<?= SCRIPT_LOADING ?>" defer></script>
</head>

<body class="bg-light">
    <header>
        <!-- Barra de Navegação -->
        <nav class="navbar navbar-expand-lg" id="nav" style="background-color:#FDDE5C;">
            <div class="container-fluid" id="nav_container">

                <!-- Logo da barra de navegação -->
                <a class="navbar-brand" href="#">
                    <img src="<?= LOGO_HEADER ?>" alt="Logo" id="logo">
                </a>

                <!-- Botão para expandir ou colapsar o menu em telas pequenas -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarToggleExternalContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Conteúdo do menu de navegação -->
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <?php
                        // Gera os links para as outras páginas, usando as constantes em OUTRAS_PAGINAS
                        foreach (OUTRAS_PAGINAS as $pagina) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="<?= $pagina[1] ?>"><?= $pagina[0] ?></a>
                        </li>
                        <?php }
                        if (isset($_SESSION['id_usuario'])) {
                            foreach (LINK_USUARIO_CADASTRADO as $pagina) {
                            ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="<?= $pagina[1] ?>"><?= $pagina[0] ?></a>
                        </li>
                        <?php }
                        }

                        // Se o usuário for um treinador, exibe links para cadastrar usuário e instituição
                        if (isset($_SESSION['treinador']) && $_SESSION['treinador']) { ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= LINK_CADASTRO_USUARIO ?>">Cadastrar
                                Usuário</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="<?= LINK_CADASTRO_INSTITUICAO ?>">Cadastrar Instituição</a>
                        </li>
                        <?php }

                        // Exibe o link de login se o usuário não estiver logado
                        if (!isset($_SESSION['id_usuario'])) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= LINK_LOGIN ?>">Login</a>
                        </li>
                        <?php }
                        ?>
                    </ul>
                </div>
            </div>

            <!-- Exibe o nome do usuário logado na barra de navegação -->
            <?php
            if (isset($_SESSION['id_usuario'])) { ?>
            <a class="navbar-brand">
                <?= $_SESSION['nome_usuario'] ?>
            </a>
            <?php } ?>
        </nav>
    </header>
    <?php
    if (isset($_SESSION['error'])) { ?>
    <div>
        <p><?= $_SESSION['error'] ?></p>
    </div>
    <?php unset($_SESSION['error']);
    } ?>