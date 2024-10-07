<?php
// Inclui a definição da classe `Usuario`, que deve conter os métodos necessários para manipulação de dados de usuário
require_once '../classes/usuario_class.php';

// Obtém os valores enviados pelo formulário via POST
$nomeUsuario = $_POST['nome']; // Nome do usuário
$emailUsuario = $_POST['email']; // Email do usuário
$senhaUsuario = $_POST['senha']; // Senha do usuário
$eJogador = $_POST['jogador']; // Indica se o usuário é um jogador (1 para sim, 0 para não)
$eTreinador = $_POST['treinador']; // Indica se o usuário é um treinador (1 para sim, 0 para não)

// Verifica se todos os campos necessários foram enviados
if (isset($nomeUsuario) && isset($emailUsuario) && isset($senhaUsuario) && isset($eJogador) && isset($eTreinador)) {
    // Cria uma nova instância da classe `Usuario`
    $usuario = new Usuario();

    // Verifica se o campo `idJogador` está definido na requisição POST
    if (isset($_POST['idJogador'])) {
        // Se o campo `idJogador` está presente, chama o método `Cadastrar` passando o ID do jogador como argumento adicional
        $usuario->Cadastrar($nomeUsuario, $emailUsuario, $senhaUsuario, $eJogador, $eTreinador, intval($_POST['idJogador']));
    } else {
        // Se o campo `idJogador` não está presente, chama o método `Cadastrar` sem o ID do jogador
        $usuario->Cadastrar($nomeUsuario, $emailUsuario, $senhaUsuario, $eJogador, $eTreinador);
    }

    // Redireciona para a página de times após o cadastro ser realizado com sucesso
    header("Location: ../../pages/times.php");
} else {
    // Se algum dos campos obrigatórios não está presente, redireciona de volta para a página de cadastro de usuário
    header("Location: ../../pages/cadastrar_usuario.php");
}
