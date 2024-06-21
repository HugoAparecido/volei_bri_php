<?php
require_once "./database_class.php";
abstract class Jogador
{
    /**
     * Identificador único do joagador
     * @var integer
     */
    public $id;
    /**
     * Nome do Jogador
     * @var string
     */
    public $nome;
    /**
     * Posição
     * @var string
     */
    protected $posicao;
    /**
     * Número da camisa
     * @var int
     */
    public $num_camisa;
    /**
     * Apelido do jogador
     * @var string
     */
    public $apelido;
    /**
     * Altura do jogador
     * @var float
     */
    public $altura;
    /**
     * Peso do jogador
     * @var float
     */
    public $peso;
    /**
     * Sexo do jogador
     * @var string(M/F)
     */
    public $sexo;
    /**
     * Método responsável porCcadastrar um novo jogador no banco
     * @return boolean
     */
    /**
     * Defesas do joagador
     * @var int
     */
    protected $defesa;
    public function Cadastrar()
    {
        //INSERIR O JOGADOR NO BANCO
        $obDatabase = new Database('jogador');
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
