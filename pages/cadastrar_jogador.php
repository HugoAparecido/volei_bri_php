<?php
include('../componentes/protect.php');
if (isset($_SESSION['id_usuario'])) {
    // define o caminho do icone em uma constante
    define('FAVICON', "../img/logo-volei.ico");
    // define o caminho do css da página
    define('FOLHAS_DE_ESTILO', array("../css/index.css", "../css/cadastro.css"));
    // define o caminho da logo no header
    define('LOGO_HEADER', "../img/bolas.png");
    // define os nomes dasa páginas e seus respectivos caminhos
    define('OUTRAS_PAGINAS', array(['Página Principal', '../index.php'], ['Times', './times.php'], ['Estatísticas', './estatisticas.php'], ['Login', './login.php'], ['Registrar Usuário', './registro.php']));
    include '../componentes/header.php';
?>
    <button type="button" class="botao_deslogar" id="logout"><a href="../componentes/logout.php">Sair</a></button>
    <main class="container text-center">
        <section id="jogador">
            <form action="../componentes/cadastrar_jogador_exe.php" method="post">
                <fieldset>
                    <legend>Cadastrar Jogador</legend>
                    <div class="linha_unica">
                        <label class="form-label" for="nome_jogador">Nome: </label>
                        <input class="form-control" type="text" id="nome_jogador" name="nome_jogador" required>
                    </div>
                    <div class="linha_unica">
                        <label class="form-label" for="apelido_jogador">Apelido: </label>
                        <input class="form-control" type="text" id="apelido_jogador" name="apelido_jogador">
                    </div>
                    <div class="linha_unica">
                        <label class="form-label" for="num_camisa_jogador">Número da camisa do jogador: </label>
                        <input class="form-control" type="number" id="num_camisa_jogador" name="num_camisa_jogador">
                    </div>
                    <div class="linha_unica">
                        <label class="form-label" for="posicao_jogador">Posição do jogador: </label>
                        <select class="form-select" name="posicao_jogador" id="posicao_jogador" required>
                            <option value="Não Definida">Não definida</option>
                            <option value="Levantador">Levantador</option>
                            <option value="Central">Central</option>
                            <option value="Ponta 1">Ponta 1</option>
                            <option value="Ponta 2">Ponta 2</option>
                            <option value="Oposto">Oposto</option>
                            <option value="Líbero">Líbero</option>
                        </select>
                    </div>
                    <div class="linha_unica">
                        <label class="form-label" for="sexo_jogador">Sexo do jogador: </label>
                        <select class="form-select" name="sexo_jogador" id="sexo_jogador" required>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                    </div>
                    <div class="linha_unica">
                        <label class="form-label" for="altura_jogador">Altura do jogador: </label>
                        <input class="form-control" type="text" id="altura_jogador" name="altura_jogador">
                    </div>
                    <div class="linha_unica">
                        <label class="form-label" for="peso_jogador">Peso do jogador: </label>
                        <input class="form-control" type="text" id="peso_jogador" name="peso_jogador"><br>
                    </div>
                    <button id="cadastrar_jogador" class="btn " type="submit" style="background-color: #FDDE5C;">Cadastar Jogador</button>
                </fieldset>
            </form>
            <button id="update_jogadores_cadastrados" class="btn"><a href="./atualizar_jogador.php" style="color:  rgb(0, 0, 0);">Atualizar Jogador
                    Existente</a></button>
            <button id="mostrar_jogadores_cadastrados" class="btn " style="background-color: #FDDE5C;"><a href="./exibir_jogador.php"> Mostar Jogadores Cadastrados</a></button>
        </section>
    </main>
<?php
    include '../componentes/footer.php';
} else {
?>
    <script>
        window.location.href = "./login.php"
    </script><?php
            }
