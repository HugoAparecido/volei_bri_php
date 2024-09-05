<?php
require_once "./database_class.php";
class Time
{
    /**
     * Identificador único do time
     * @var integer
     */
    public $id_time;
    /**
     * Nome do Time
     * @var string
     */
    public $nome_time;
    /**
     * Data de criação do time
     * @var string
     */
    public $data_hora_criacao;
    /**
     * Sexo do Time
     * @var string(M/F/MIS)
     */
    public $sexo_time;
    /**
     * Usuário que cadastrou o time
     * @var int
     */
    public $id_usuario;
    /**
     * Instituição do time
     * @var int
     */
    public $id_istituicao;
    /**
     * Método responsável por Cadastrar um novo time no banco
     * @return boolean
     */
    public function Cadastrar()
    {
        //DEFINIR A DATA
        $this->data_hora_criacao = date('Y-m-d H:i:s');
        //INSERIR O TIME NO BANCO
        $obDatabase = new Database('time');
        $this->id_time = $obDatabase->insert([
            'nome_time' => $this->nome_time,
            'data_hora_criacao' => $this->data_hora_criacao,
            'sexo_time' => $this->sexo_time,
            'id_usuario' => $this->id_usuario,
            'id_istituicao' => $this->id_istituicao
        ]);
        //RETORNAR SUCESSO
        return true;
    }
    /**
     * Método responsável por atualizar os times no banco
     * @return boolean
     */
    public function Atualizar()
    {
        return (new Database('time'))->update('id = ' . $this->id_time, [
            'nome_time' => $this->nome_time,
            'data_hora_criacao' => $this->data_hora_criacao,
            'sexo_time' => $this->sexo_time,
            'id_istituicao' => $this->id_istituicao
        ]);
    }
    /**
     * Método responsável por excluir o time do banco
     * @return boolean
     */
    public function Excluir()
    {
        return (new Database('time'))->delete('id = ' . $this->id_time);
    }
    /**
     * Método responsável por obter os times do banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function GetTimes($where = null, $order = null, $limit = null)
    {
        return (new Database('time'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    /**
     * Método responsável por buscar um time com base em seu ID
     * @param integer $id_time
     * @return time
     */
    public static function GetTime($id_time)
    {
        return (new Database('time'))->select('id = ' . $id_time)->fetchObject(self::class);
    }
}
