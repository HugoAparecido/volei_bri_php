<?php
class Database
{
    /**
     * Host de conexão com o banco de dados
     * @var string
     */
    const HOST = 'localhost'; // Define o host do banco de dados

    /**
     * Nome do banco de dados
     * @var string
     */
    const NAME = 'dados_volei'; // Nome do banco de dados a ser usado

    /**
     * Usuário do banco
     * @var string
     */
    const USER = 'root'; // Nome do usuário para conexão

    /**
     * Senha de acesso ao banco de dados
     * @var string
     */
    const PASS = ""; // Senha do usuário para conexão (vazia, nesse caso)

    /**
     * Nome da tabela
     * @var string
     */
    private $table; // Armazena o nome da tabela para operações

    /**
     * Instância de conexão com o banco de dados
     * @var PDO
     */
    private $connection; // Armazena a conexão PDO com o banco

    /** 
     * Define a tabela e instância de conexão 
     */
    public function __construct($table = null)
    {
        $this->table = $table; // Define a tabela a ser utilizada
        $this->SetConnection(); // Estabelece a conexão com o banco de dados
    }

    /**
     * Método responsável por criar uma conexão com o banco de dados
     */
    private function SetConnection()
    {
        try {
            // Cria uma nova instância PDO para conexão com o banco
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            // Define o modo de erro do PDO para lançar exceções
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Em caso de erro, encerra a execução e exibe a mensagem de erro
            die('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Método responsável por executar queries dentro do banco de dados
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params = [])
    {
        try {
            // Prepara a query para execução
            $statement = $this->connection->prepare($query);
            // Executa a query com os parâmetros fornecidos
            $statement->execute($params);
            return $statement; // Retorna a instância PDOStatement resultante
        } catch (PDOException $e) {
            // Em caso de erro, encerra a execução e exibe a mensagem de erro
            die('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Método responsável por inserir dados no banco
     * @param array [ field => value ]
     * @return integer ID inserido
     */
    public function insert($values)
    {
        // DADOS DA QUERY
        $fields = array_keys($values); // Obtém os campos da array de valores
        $binds = array_pad([], count($fields), '?'); // Prepara os placeholders para a query

        // MONTA A QUERY
        $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';
        echo $query; // Exibe a query para depuração

        // EXECUTA O INSERT
        $this->execute($query, array_values($values)); // Executa a query de inserção

        // RETORNA O ID INSERIDO
        return $this->connection->lastInsertId(); // Retorna o ID do último registro inserido
    }

    /**
     * Método responsável por executar uma consulta no banco
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        // DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : ''; // Define a cláusula WHERE, se houver
        $order = strlen($order) ? 'ORDER BY ' . $order : ''; // Define a cláusula ORDER BY, se houver
        $limit = strlen($limit) ? 'LIMIT ' . $limit : ''; // Define a cláusula LIMIT, se houver

        // MONTA A QUERY
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;
        return $this->execute($query); // Executa a query e retorna o resultado
    }

    /**
     * Método responsável por executar uma consulta com LEFT JOIN
     * @param string $tabelaPai
     * @param string $campoIDFilho
     * @param string $campoIDPai
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public function selectLeftJoin($tabelaPai, $campoIDFilho, $campoIDPai, $where = null, $order = null, $limit = null, $fields = '*')
    {
        // DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : ''; // Define a cláusula WHERE, se houver
        $order = strlen($order) ? 'ORDER BY ' . $order : ''; // Define a cláusula ORDER BY, se houver
        $limit = strlen($limit) ? 'LIMIT ' . $limit : ''; // Define a cláusula LIMIT, se houver

        // MONTA A QUERY
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' LEFT JOIN ' . $tabelaPai . ' ON ' . $this->table . '.' . $campoIDFilho . ' = ' . $tabelaPai . '.' . $campoIDPai . ' ' . $where . ' ' . $order . ' ' . $limit;
        return $this->execute($query); // Executa a query e retorna o resultado
    }

    /**
     * Método responsável por executar atualizações no banco de dados
     * @param string $where
     * @param array $values [ field => value ]
     * @return boolean
     */
    public function update($where, $values)
    {
        // DADOS DA QUERY
        $fields = array_keys($values); // Obtém os campos da array de valores

        // MONTA A QUERY
        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;

        // EXECUTAR A QUERY
        $this->execute($query, array_values($values)); // Executa a query de atualização

        // RETORNA SUCESSO
        return true; // Indica que a operação foi bem-sucedida
    }

    /**
     * Método responsável por excluir dados do banco
     * @param string $where
     * @return boolean
     */
    public function delete($where)
    {
        // MONTA A QUERY
        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where; // Monta a query de exclusão

        // EXECUTA A QUERY
        $this->execute($query); // Executa a query de exclusão

        // RETORNA SUCESSO
        return true; // Indica que a operação foi bem-sucedida
    }
    public function SomarCampos($fields, $where = null)
    {
        // DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : ''; // Define a cláusula WHERE, se houver
        $sums = ' ';
        foreach ($fields as $field) {
            $sums .= 'SUM(' . $field . ') AS ' . $field . ', ';
        }
        $sums = substr($sums, 0, -2);

        // MONTA A QUERY
        $query = 'SELECT ' . $sums . ' FROM ' . $this->table . ' ' . $where;
        return $this->execute($query); // Executa a query e retorna o resultado
    }
    public function AtualizarEstatisticas($where, $values)
    {

        // DADOS DA QUERY
        $fields = array_keys($values); // Obtém os campos da array de valores

        $locais = ' SET ';
        foreach ($fields as $field) {
            $locais .= ' ' . $field . ' = ' . $field . ' + ?, ';
        }
        $locais = substr($locais, 0, -2);
        // MONTA A QUERY
        $query = 'UPDATE ' . $this->table . $locais . ' WHERE ' . $where;
        $this->execute($query, array_values($values)); // Executa a query de atualização

        // RETORNA SUCESSO
        return true; // Indica que a operação foi bem-sucedida
    }
}
