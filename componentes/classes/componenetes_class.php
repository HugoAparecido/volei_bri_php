<?php
// Inclui a classe 'OutrasPosicoes' que contém métodos relacionados a jogadores
require_once "outras_posicoes_class.php";

class Componentes
{
    // Método estático para gerar opções de jogadores para um formulário
    public static function InputJogadores()
    {
        // Obtém a lista de jogadores usando um método da classe 'OutrasPosicoes'
        $jogadores = OutrasPosicoes::getJogadores();

        // Itera sobre cada jogador na lista
        foreach ($jogadores as $jogador) {
            // Cria um elemento <option> para cada jogador
            // O valor do option é o ID do jogador, e o texto exibido inclui o número da camisa e o nome do jogador
            echo "<option value='" . $jogador->id_jogador . "'>" . $jogador->numero_camisa . " : " . $jogador->nome_jogador . "</option>";
        }
    }
}
