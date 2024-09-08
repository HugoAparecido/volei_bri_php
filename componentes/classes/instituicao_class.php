<?php
// Inclui a classe de manipulação do banco de dados
require_once "database_class.php";

class Instituicao
{
    /**
     * Identificador único da Inatituição
     * @var integer
     */
    public $id_instituicao;

    /**
     * Nome da Instituição
     * @var string
     */
    public $nome_instituicao;

    /**
     * Tipo da instituição
     * @var string
     */
    public $tipo_instituicao;

    public function GetID()
    {
        return $this->id_instituicao;
    }
    public function GetNome()
    {
        return $this->nome_instituicao;
    }
    public function GetTipo()
    {
        return $this->tipo_instituicao;
    }
    /**
     * Método responsável por cadastrar uma nova instituicao no banco
     * @return boolean
     */
    public function Cadastrar($nome, $tipo)
    {
        $this->nome_instituicao = $nome;
        $this->tipo_instituicao = $tipo;
        // Cria uma nova instância da classe Database para manipulação da tabela 'instituicao'
        $obDatabase = new Database('instituicao');

        // Insere um novo registro na tabela 'instituicao' com os dados do objeto
        $this->id_instituicao = $obDatabase->insert([
            'nome_instituicao' => $this->nome_instituicao,
            'tipo_instituicao' => $this->tipo_instituicao
        ]);

        // Retorna verdadeiro indicando sucesso na operação
        return true;
    }

    /**
     * Método responsável por atualizar os dados da instituicao no banco
     * @return boolean
     */
    public function Atualizar()
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'instituicao'
        return (new Database('instituicao'))->update('id = ' . $this->id_instituicao, [
            'nome_instituicao' => $this->nome_instituicao,
            'tipo_instituicao' => $this->tipo_instituicao
        ]);
    }

    /**
     * Método responsável por excluir uma instituicao do banco
     * @return boolean
     */
    public function Excluir()
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'instituicao'
        return (new Database('instituicao'))->delete('id = ' . $this->id_instituicao);
    }

    /**
     * Método responsável por obter a lista de instituicoes do banco de dados
     * @param string $where Condição de filtragem dos registros
     * @param string $order Ordem dos registros
     * @param string $limit Limite de registros retornados
     * @return array Array de objetos do tipo Instituicao
     */
    public static function GetInstituicoes($where = null, $order = null, $limit = null)
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'instituicao'
        return (new Database('instituicao'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsável por buscar uma instituição específico com base em seu ID
     * @param integer $id_instituicao Identificador da instituição
     * @return Instituicao Objeto do tipo Instituicao correspondente ao ID fornecido
     */
    public static function GetInstituicao($id_instituicao)
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'instituicao'
        return (new Database('instituicao'))->select('id = ' . $id_instituicao)->fetchObject(self::class);
    }
}
