<?php
// Inclui a classe de manipulação do banco de dados
require_once "database_class.php";

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
     * Método responsável por cadastrar um novo time no banco
     * @return boolean
     */
    public function Cadastrar()
    {
        // Define a data e hora atuais para a criação do time
        $this->data_hora_criacao = date('Y-m-d H:i:s');

        // Cria uma nova instância da classe Database para manipulação da tabela 'time'
        $obDatabase = new Database('time');

        // Insere um novo registro na tabela 'time' com os dados do objeto
        $this->id_time = $obDatabase->insert([
            'nome_time' => $this->nome_time,
            'data_hora_criacao' => $this->data_hora_criacao,
            'sexo_time' => $this->sexo_time,
            'id_usuario' => $this->id_usuario,
            'id_istituicao' => $this->id_istituicao
        ]);

        // Retorna verdadeiro indicando sucesso na operação
        return true;
    }

    /**
     * Método responsável por atualizar os dados do time no banco
     * @return boolean
     */
    public function Atualizar()
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'time'
        return (new Database('time'))->update('id = ' . $this->id_time, [
            'nome_time' => $this->nome_time,
            'data_hora_criacao' => $this->data_hora_criacao,
            'sexo_time' => $this->sexo_time,
            'id_istituicao' => $this->id_istituicao
        ]);
    }

    /**
     * Método responsável por excluir um time do banco
     * @return boolean
     */
    public function Excluir()
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'time'
        return (new Database('time'))->delete('id = ' . $this->id_time);
    }

    /**
     * Método responsável por obter a lista de times do banco de dados
     * @param string $where Condição de filtragem dos registros
     * @param string $order Ordem dos registros
     * @param string $limit Limite de registros retornados
     * @return array Array de objetos do tipo Time
     */
    public static function GetTimes($where = null, $order = null, $limit = null)
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'time'
        return (new Database('time'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsável por buscar um time específico com base em seu ID
     * @param integer $id_time Identificador do time
     * @return Time Objeto do tipo Time correspondente ao ID fornecido
     */
    public static function GetTime($id_time)
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'time'
        return (new Database('time'))->select('id = ' . $id_time)->fetchObject(self::class);
    }
}
