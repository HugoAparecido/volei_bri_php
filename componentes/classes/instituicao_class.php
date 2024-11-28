<?php
// Inclui a classe de manipulação do banco de dados
require_once "database_class.php"; // Carrega a classe que gerencia as operações no banco de dados

class Instituicao
{
    /**
     * Identificador único da Instituição
     * @var integer
     */
    public $id_instituicao; // Propriedade para armazenar o ID da instituição

    /**
     * Nome da Instituição
     * @var string
     */
    public $nome_instituicao; // Propriedade para armazenar o nome da instituição

    /**
     * Tipo da instituição
     * @var string
     */
    public $tipo_instituicao; // Propriedade para armazenar o tipo da instituição

    // Métodos para obter os valores das propriedades

    public function GetID()
    {
        return $this->id_instituicao; // Retorna o ID da instituição
    }

    public function GetNome()
    {
        return $this->nome_instituicao; // Retorna o nome da instituição
    }

    public function GetTipo()
    {
        return $this->tipo_instituicao; // Retorna o tipo da instituição
    }
    /**
     * Método responsável por cadastrar uma nova instituição no banco
     * @return boolean
     */
    public function Cadastrar($nome, $tipo)
    {
        // Atribui os parâmetros às propriedades da classe
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
     * Método responsável por atualizar os dados da instituição no banco
     * @return boolean
     */
    public function Atualizar($nome, $tipo)
    {
        // Atribui os parâmetros às propriedades da classe
        $this->nome_instituicao = $nome;
        $this->tipo_instituicao = $tipo;
        // Cria uma nova instância da classe Database para manipulação da tabela 'instituicao'
        return (new Database('instituicao'))->update('id_instituicao = ' . $this->id_instituicao, [
            'nome_instituicao' => $this->nome_instituicao,
            'tipo_instituicao' => $this->tipo_instituicao
        ]);
    }

    /**
     * Método responsável por excluir uma instituição do banco
     * @return boolean
     */
    public function Excluir()
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'instituicao'
        return (new Database('instituicao'))->delete('id_instituicao = ' . $this->id_instituicao);
    }

    /**
     * Método responsável por obter a lista de instituições do banco de dados
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
     * Método responsável por buscar uma instituição específica com base em seu ID
     * @param integer $id_instituicao Identificador da instituição
     * @return Instituicao Objeto do tipo Instituicao correspondente ao ID fornecido
     */
    public static function GetInstituicao($id_instituicao)
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'instituicao'
        return (new Database('instituicao'))->select('id_instituicao = ' . $id_instituicao)->fetchObject(self::class);
    }
}