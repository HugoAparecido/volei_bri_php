<?php
// Verifica se a sessão já foi iniciada
if (!isset($_SESSION)) {
    session_start(); // Inicia uma nova sessão se nenhuma estiver ativa
}
