<?php
require_once "jogador_class.php";
class OutrasPosicoes extends Jogador
{
    // Definindo a posição para Líbero
    private function SetAll($nome, $sexo, $apelido, $numero, $altura, $peso)
    {
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
    public function CadastrarPosicao($nome, $sexo, $apelido = null, $numero = null, $altura = null, $peso = null)
    {
        $this->SetAll($nome, $sexo, $apelido, $numero, $altura, $peso);
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
