<?php
require_once "./jogador_class.php";
class Libero extends Jogador
{
    // Definindo a posição para Líbero
    public function __construct()
    {
        $this->posicao = "Líbero";
    }
}