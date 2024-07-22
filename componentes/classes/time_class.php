<?php
require_once "./database_class.php";
abstract class Time
{
    /**
     * Identificador único do time
     * @var integer
     */
    public $id;
    /**
     * Nome do Jogador
     * @var string
     */
    public $nome;
    /**
     * Jogadores que estão no time
     * @var string
     */
    protected $posicao;
    /**
     * Sexo do jogador
     * @var string(M/F)
     */
    public $sexo;
    /**
     * Método responsável por Cadastrar um novo time no banco
     * @return boolean
     */
    public function Cadastrar()
    {
        //INSERIR O JOGADOR NO BANCO
        $obDatabase = new Database('time');
        $this->id = $obDatabase->insert([
            'nome' => $this->nome,
            'posicao' => $this->posicao,
            'num_camisa' => $this->num_camisa,
            'apelido' => $this->apelido,
            'altura' => $this->altura,
            'peso' => $this->peso,
            'sexo' => $this->sexo
        ]);
        //RETORNAR SUCESSO
        return true;
    }
    /**
     * Método responsável por atualizar os jogadores no banco
     * @return boolean
     */
    public function Atualizar()
    {
        return (new Database('jogador'))->update('id = ' . $this->id, [
            'nome' => $this->nome,
            'posicao' => $this->posicao,
            'num_camisa' => $this->num_camisa,
            'apelido' => $this->apelido,
            'altura' => $this->altura,
            'peso' => $this->peso,
            'sexo' => $this->sexo
        ]);
    }
    /**
     * Método responsável por excluir o jogador do banco
     * @return boolean
     */
    public function Excluir()
    {
        return (new Database('jogador'))->delete('id = ' . $this->id);
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
    /**
     * Método responsável por buscar um jogador com base em seu ID
     * @param integer $id
     * @return jogador
     */
    public static function getJogador($id)
    {
        return (new Database('jogador'))->select('id = ' . $id)->fetchObject(self::class);
    }
}
