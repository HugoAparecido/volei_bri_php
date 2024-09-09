<?php
include('../componentes/protect.php');
// define o caminho do icone em uma constante
define('FAVICON', "../img/bolas.ico");
// define o caminho do css da página
define('FOLHAS_DE_ESTILO', array("../css/index.css", "../css/times.css"));
// define o caminho da logo no header
define('LINK_LOGIN', './login.php');
define('LOGO_HEADER', "../img/bolas.png");
// define os nomes dasa páginas e seus respectivos caminhos
define('OUTRAS_PAGINAS', array(['Página Principal', '../index.php'], ['Times', './times.php'], ['Estatísticas', './estatisticas.php'], ['Login', './login.php'], ['Registrar Usuário', './registro.php']));
include '../componentes/header.php';
if (isset($_SESSION['id_usuario'])) {
?>
    <button type="button" class="botao_deslogar" id="logout"><a href="../componentes/logout.php">Sair</a></button>
    <div class="tabela"><?php } ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Número</th>
                <th>Posição</th>
                <th>Sexo</th>
            </tr>
        </thead>
        <tbody id="jogadores_cadastrados">
            <?php
            $resultados = '';
            foreach ($vagas as $vaga) {
                $resultados .=
                    '<tr>
            <td>' . $vaga->id . '</td>
            <td>' . $vaga->titulo . '</td>
            <td>' . $vaga->descricao . '</td>
            <td>' . ($vaga->ativo == 's' ? 'Ativo' : 'Inativo') . '</td>
            <td>' . date('d/m/Y à\s H:i:s', strtotime($vaga->data)) . '</td>
            <td>
                <a href="editar.php?id=' . $vaga->id . '">
                    <button type="button" class="btn btn-primary">Editar</button>
                </a>
                <a href="excluir.php?id=' . $vaga->id . '">
                    <button type="button" class="btn btn-danger">Excluir</button>
                </a>
            </td>
        </tr>';
            }
            $resultados = strlen($resultados) ? $resultados :
                '<tr>
        <td colspan="6" class="text-center">Nenhuma vaga encontrada</td>
    </tr>';
            ?>
        </tbody>
    </table>
    </div>
    <div>
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="..." class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Nome Jogador: </h5>
                        <p class="card-title">Posição</p>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Fundamento
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Passe</a></li>
                                <li><a class="dropdown-item" href="#">Ataque</a></li>
                                <li><a class="dropdown-item" href="#">Defesa...</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>