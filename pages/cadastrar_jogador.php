<?php
// include('../componentes/protect.php');
// if (isset($_SESSION['id_usuario'])) {
    // define o caminho do icone em uma constante
    define('FAVICON', "../img/logo-volei.ico");
    // define o caminho do css da página
    define('FOLHAS_DE_ESTILO', array("../css/style.css", "../css/cadastro.css"));
    // define o caminho da logo no header
    define('LOGO_HEADER', "../img/bolas.png");
    define('LOGO_USUARIO', "../img/login.png");
    // define os nomes dasa páginas e seus respectivos caminhos
    define('OUTRAS_PAGINAS', array(['Página Principal', '../index.php'], ['Times', './times.php'], ['Estatísticas', './estatisticas.php'], ['Login', './login.php'], ['Registrar Usuário', './registro.php']));
    include '../componentes/header.php';
?>
    <main class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
<div class="d-grip gap-2 mb-3 fixed-top" id="botao_flutuante">
<button type="button" class="btn" id="logout"><a href="../componentes/logout.php">Sair</a></button>
</div>
    <div class="card p-4 shadow-sm" id="card">
        <form action="../componentes/cadastrar_jogador_exe.php" method="post">
                <h2 class="text-center text-white mb-4">Cadastrar Jogador</h2>
                <div class="mb-3">
                    <label for="nome_jogador">Nome: </label>
                    <input type="text" class="form-control" id="nome_jogador" name="nome_jogador" required>
                </div>
                <div class="mb-3">
                    <label for="apelido_jogador">Apelido: </label>
                    <input type="text" class="form-control" id="apelido_jogador" name="apelido_jogador">
                </div>
                <div class="mb-3">
                    <label for="num_camisa_jogador">Número da camisa do jogador: </label>
                    <input type="number" class="form-control" id="num_camisa_jogador" name="num_camisa_jogador">
                </div>
                <div class="mb-3">
                    <label for="posicao_jogador">Posição do jogador: </label>
                    <select name="posicao_jogador" class="form-select" id="posicao_jogador" required>
                        <option value="Não Definida">Não definida</option>
                        <option value="Levantador">Levantador</option>
                        <option value="Central">Central</option>
                        <option value="Ponta 1">Ponta 1</option>
                        <option value="Ponta 2">Ponta 2</option>
                        <option value="Oposto">Oposto</option>
                        <option value="Líbero">Líbero</option>
                    </select>
                </div> 
                <div class="mb-3">
                    <label for="sexo_jogador">Sexo do jogador: </label>
                    <select name="sexo_jogador" class="form-select" id="sexo_jogador" required>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="altura_jogador">Altura do jogador: </label>
                    <input type="text" class="form-control" id="altura_jogador" name="altura_jogador">
                </div>
                <div class="mb-3">
                    <label for="peso_jogador">Peso do jogador: </label>
                    <input type="text" class="form-control" id="peso_jogador" name="peso_jogador"><br>
                </div>
                <div class="d-grid gap-2 mb-3">
                    <button id="cadastrar_jogador" class="btn">Cadastar Jogador</button>
                </div>
        </form>
            <div class="d-grid gap-2 mb-3">
                <button id="update_jogadores_cadastrados" class="btn"><a href="./atualizar_jogador.php">Atualizar Jogador
                    Existente</a></button>
            </div>
            <div class="d-grid gap-2 mb-3">
                <button id="mostrar_jogadores_cadastrados" class="btn"><a href="./exibir_jogador.php"> Mostar Jogadores Cadastrados</a></button>
            </div>
    </div>
    </main>
<?php
    include '../componentes/footer.php';
?>
<!-- } else {// 
//     <script>
//         window.location.href = "./login.php"
//     </script>
//             } -->

