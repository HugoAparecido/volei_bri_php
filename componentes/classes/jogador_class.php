<?php
require_once "database_class.php";
abstract class Jogador
{
    /**
     * Identificador único do jogador
     * @var integer
     */
    public $id_jogador;
    /**
     * Nome do Jogador
     * @var string
     */
    public $nome_jogador;
    /**
     * Apelido do jogador
     * @var string
     */
    protected $apelido_jogador;
    /**
     * Posição
     * @var string
     */
    protected $posicao_jogador;
    /**
     * Número da camisa
     * @var int
     */
    public $numero_camisa;
    /**
     * Altura do jogador
     * @var float
     */
    protected $altura_jogador;
    /**
     * Peso do jogador
     * @var float
     */
    protected $peso_jogador;
    /**
     * Sexo do jogador
     * @var string(M/F)
     */
    protected $sexo_jogador;
    /**
     * Defesas do joagador
     * @var int
     */
    protected $defesa_jogador;
    /**
     * Método responsável por Cadastrar um novo jogador no banco
     * @return boolean
     */
    public function Cadastrar()
    {
        //INSERIR O JOGADOR NO BANCO
        $obDatabase = new Database('jogador');
        $this->id_jogador = $obDatabase->insert([
            'nome_jogador' => $this->nome_jogador,
            'apelido_jogador' => $this->apelido_jogador,
            'numero_camisa' => $this->numero_camisa,
            'altura_jogador' => $this->altura_jogador,
            'peso_jogador' => $this->peso_jogador,
            'sexo_jogador' => $this->sexo_jogador
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
        return (new Database('jogador'))->update('id = ' . $this->id_jogador, [
            'nome_jogador' => $this->nome_jogador,
            'numero_camisa' => $this->numero_camisa,
            'apelido_jogador' => $this->apelido_jogador,
            'altura_jogador' => $this->altura_jogador,
            'peso_jogador' => $this->peso_jogador,
            'sexo_jogador' => $this->sexo_jogador
        ]);
    }
    /**
     * Método responsável por excluir o jogador do banco
     * @return boolean
     */
    public function Excluir()
    {
        return (new Database('jogador'))->delete('id = ' . $this->id_jogador);
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
//Select para puxar os dados no time e também os dados da posição
//SELECT * FROM jogador INNER JOIN libero on libero.id_jogador = jogador.id_jogador INNER JOIN jogador_no_time on jogador_no_time.id_jogador = jogador.id_jogador;