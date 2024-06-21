<?php
require_once "./jogador_class.php";
class Levantador extends Jogador
{
    // Definindo a posição para Levantador
    public function __construct()
    {
        $this->posicao = "Levantador";
    }
}