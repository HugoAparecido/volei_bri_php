<?php
require_once "./jogador_class.php";
class OutrasPosicoes extends Jogador
{
    // Definindo a posição para Oposto ou Ponta 1 ou Ponta 2 ou Central ou Não Definida
    public function __construct($posicao)
    {
        $this->posicao = $posicao;
    }
}