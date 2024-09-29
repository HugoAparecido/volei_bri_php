<?php
require_once "jogador_class.php";
class OutrasPosicoes extends Jogador
{
    private $id_posicao;
    // Definindo a posição para Líbero
    private function SetAll($nome, $sexo, $posicao, $apelido, $numero, $altura, $peso)
    {
        $this->nome_jogador = $nome;
        $this->apelido_jogador = $apelido;
        $this->numero_camisa = $numero;
        $this->sexo_jogador = $sexo;
        $this->altura_jogador = $altura;
        $this->peso_jogador = $peso;
        $this->sexo_jogador = $sexo;
        $this->posicao_jogador = $posicao;
    }
    /**
     * Método responsável por Cadastrar um novo jogador no banco
     * @return boolean
     */
    public function CadastrarPosicao($nome, $sexo, $posicao, $apelido = null, $numero = null, $altura = null, $peso = null)
    {
        $this->SetAll($nome, $sexo, $posicao, $apelido, $numero, $altura, $peso);
        $jogadores = $this->getJogadores("nome_jogador = '$nome'");
        if (count($jogadores) > 0) {
            $this->id_jogador = $jogadores[0]->id_jogador;
            $obDatabase = new Database('outras_posicoes');
            $this->id_posicao = $obDatabase->insert([
                'id_jogador' => $this->id_jogador,
                'posicao' => $this->posicao_jogador
            ]);
        } else {
            //INSERIR O JOGADOR NO BANCO
            $this->Cadastrar();
            $obDatabase = new Database('outras_posicoes');
            $this->id_posicao = $obDatabase->insert([
                'id_jogador' => $this->id_jogador,
                'posicao' => $this->posicao_jogador
            ]);
        }
        //RETORNAR SUCESSO
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
    public static function JuntarTabelas($tabelaPai, $campoIDFilho, $campoIDPai, $where = null, $order = null, $limit = null)
    {
        return (new Database('outras_posicoes'))->selectLeftJoin($tabelaPai, $campoIDFilho, $campoIDPai, $where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}
