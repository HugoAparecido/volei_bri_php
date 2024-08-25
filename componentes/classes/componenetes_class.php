<?php
require_once "outras_posicoes_class.php";
class Componentes
{
    public static function InputJogadores()
    {
        $jogadores = OutrasPosicoes::getJogadores();
        foreach ($jogadores as $jogador) {
            echo "<option value='" . $jogador->id_jogador . "'>" . $jogador->numero_camisa . " : " . $jogador->nome_jogador . "</option>";
        }
    }
}
