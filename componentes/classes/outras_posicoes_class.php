<?php
require_once "jogador_class.php";
class OutrasPosicoes extends Jogador
{
    // Definindo a posição para Oposto ou Ponta 1 ou Ponta 2 ou Central ou Não Definida
    // public function __construct($id = null, $nome = null, $apelido = null, $numero = null, $altura = null, $peso = null, $sexo = null, $posicao = null)
    // {
    //     $this->id_jogador = $id;
    //     $this->nome_jogador = $nome;
    //     $this->apelido_jogador = $apelido;
    //     $this->numero_camisa = $numero;
    //     $this->sexo_jogador = $sexo;
    //     $this->altura_jogador = $altura;
    //     $this->peso_jogador = $peso;
    //     $this->sexo_jogador = $sexo;
    //     $this->posicao_jogador = $posicao;
    // }
    /**
     * Método responsável por Cadastrar um novo jogador no banco
     * @return boolean
     */
    public function CadastrarPosicao()
    {
        //INSERIR O JOGADOR NO BANCO
        $this->Cadastrar();
        $obDatabase = new Database('outras_posicoes');
        $this->id_jogador = $obDatabase->insert([
            'id_jogador' => $this->id_jogador
        ]);
        //RETORNAR SUCESSO
        return true;
    }
    /**
     * Método responsável por obter os jogadores do banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getJogadores($where = null, $order = null, $limit = null)
    {
        return (new Database('jogador'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}
