<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vôlei BRI</title>
    <link rel="shortcut icon" href="<?= FAVICON ?>" type="image/x-icon">
    <?php
    foreach (FOLHAS_DE_ESTILO as $link_css) {
    ?>
        <link rel="stylesheet" href="<?= $link_css ?>">
    <?php } ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <header>
        <!--Barra de Navegação-->
        <nav class="navbar navbar-expand-lg bg-body-tertiary" id="nav">
            <div class="container-fluid" id="nav_container">
                <a class="navbar-brand" href="#">
                    <img src="<?= LOGO_HEADER ?>" alt="Logo" id="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <?php
                        foreach (OUTRAS_PAGINAS as $pagina) {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?= $pagina[1] ?>"><?= $pagina[0] ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>