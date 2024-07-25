<?php
require_once './classes/database_class.php';
if (isset($_POST['email']) || isset($_POST['senha'])) {
    if (strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if (strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);
        $database = new Database('usuario');
        $sql_query = $database->select("email = '$email' AND senha = '$senha'");
        $quantidade = $sql_query->rowCount();
        if ($quantidade == 1) {
            $usuario = $sql_query->fetch();
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            header("Location: ../");
        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }
    }
}
