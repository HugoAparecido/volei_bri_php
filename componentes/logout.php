<?php
// Verifica se a sessão já foi iniciada
if (!isset($_SESSION)) {
    session_start(); // Inicia a sessão caso ainda não tenha sido iniciada
}

// Destroi todas as variáveis de sessão, efetivamente fazendo o logout do usuário
session_destroy();

// Redireciona o usuário para a página inicial após o logout
header("Location: ../index.php");
