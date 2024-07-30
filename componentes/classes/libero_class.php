<?php
require_once "./jogador_class.php";
class Libero extends Jogador
{
    // Definindo a posição para Líbero
    public function __construct($id = null, $nome = null, $apelido = null, $numero = null, $altura = null, $peso = null, $sexo = null)
    {
        $this->id_jogador = $id;
        $this->nome_jogador = $nome;
        $this->apelido_jogador = $apelido;
        $this->numero_camisa = $numero;
        $this->sexo_jogador = $sexo;
        $this->altura_jogador = $altura;
        $this->peso_jogador = $peso;
        $this->sexo_jogador = $sexo;
        $this->posicao_jogador = "Líbero";
    }
    /**
     * Método responsável por Cadastrar um novo jogador no banco
     * @return boolean
     */
    public function CadastrarLibero()
    {
        //INSERIR O JOGADOR NO BANCO
        $this->Cadastrar();
        $obDatabase = new Database('libero');
        $this->id_jogador = $obDatabase->insert([
            'id_jogador' => $this->id_jogador
        ]);
        //RETORNAR SUCESSO
        return true;
    }
}
