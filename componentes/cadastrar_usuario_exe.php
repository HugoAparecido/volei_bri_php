<?php
require_once './classes/usuario_class.php';
$nomeUsuario = $_POST['nome'];
$emailUsuario = $_POST['email'];
$senhaUsuario = $_POST['senha'];
$eJogador = $_POST['jogador'];
$eTreinador = $_POST['treinador'];
if (isset($nomeUsuario) && isset($emailUsuario) && isset($senhaUsuario) && isset($eJogador) && isset($eTreinador)) {
    $usuario = new Usuario();
    if (isset($_POST['idJogador']))
        $usuario->Cadastrar($nomeUsuario, $emailUsuario, $senhaUsuario, $eJogador, $eTreinador, intval($_POST['idJogador']));
    else
        $usuario->Cadastrar($nomeUsuario, $emailUsuario, $senhaUsuario, $eJogador, $eTreinador);
    header("Location: ../pages/times.php");
} else {
?>
    <script>
        alert("Não foi possível cadastrar o Usuário")
    </script>
<?php
    header("Location: ../pages/cadastrar_usuario.php");
}
