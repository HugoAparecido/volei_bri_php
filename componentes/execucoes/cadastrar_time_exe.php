<div class="loader"></div>
<script src="../../js/loading.js" defer></script>
<?php
// Inclui a classe `Time`, necessária para manipular as informações do time
require_once '../classes/time_class.php';

// Inicia a sessão para acessar dados do usuário logado
session_start();

// Recebe os dados do formulário enviados via POST
$nomeTime = $_POST['nome_time'];          // Nome do time
$sexoTime = $_POST['sexo_time'];          // Sexo do time (masculino, feminino, etc.)
$instituicaoTime = $_POST['instituicao']; // ID da instituição do time

// Verifica se todas as variáveis necessárias foram enviadas
if (isset($nomeTime) && isset($sexoTime) && isset($instituicaoTime)) {
    // Cria uma nova instância da classe `Time`
    $time = new Time();

    // Chama o método `Cadastrar` da classe `Time` para salvar os dados do time no banco de dados
    // Os parâmetros incluem o nome do time, sexo, ID do usuário logado e ID da instituição
    $time->Cadastrar($nomeTime, $sexoTime, (int)$_SESSION['id_usuario'], (int)$instituicaoTime);

    // Redireciona o usuário para a página de visualização dos times após o cadastro
    header("Location: ../../pages/times.php");
} else {
    // Se algum dado estiver ausente, redireciona o usuário para a página de cadastro do time
    header("Location: ../../pages/cadastrar_time.php");
}