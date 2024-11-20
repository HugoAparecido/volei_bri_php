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
        $where = ($where != null) ? 'WHERE ' . $where : ''; // Define a cláusula WHERE, se houver
        $order = ($order != null) ? 'ORDER BY ' . $order : ''; // Define a cláusula ORDER BY, se houver
        $limit = ($limit != null) ? 'LIMIT ' . $limit : ''; // Define a cláusula LIMIT, se houver

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
        $where = ($where != null) ? 'WHERE ' . $where : ''; // Define a cláusula WHERE, se houver
        $order = ($order != null) ? 'ORDER BY ' . $order : ''; // Define a cláusula ORDER BY, se houver
        $limit = ($limit != null) ? 'LIMIT ' . $limit : ''; // Define a cláusula LIMIT, se houver

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
     * @param string $where Condição para exclusão dos dados no formato SQL (ex.: "id = 1").
     * @return boolean Retorna true indicando que a exclusão foi realizada com sucesso.
     */
    public function delete($where)
    {
        // MONTA A QUERY
        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where; // Monta a query SQL de exclusão com base na tabela e condição fornecida.

        // EXECUTA A QUERY
        $this->execute($query); // Executa a query SQL usando o método execute().

        // RETORNA SUCESSO
        return true; // Retorna true indicando que a exclusão foi bem-sucedida.
    }

    /**
     * Método responsável por somar valores de campos específicos no banco de dados
     * @param array $fields Lista de campos a serem somados (ex.: ["campo1", "campo2"]).
     * @param string|null $where Condição opcional para filtrar a soma (ex.: "status = 'ativo'").
     * @return mixed Retorna o resultado da execução da query.
     */
    public function SomarCampos($fields, $where = null)
    {
        // DADOS DA QUERY
        $where = ($where != null) ? 'WHERE ' . $where : ''; // Se a condição WHERE for fornecida, a adiciona à query; caso contrário, deixa vazio.

        $sums = ' '; // Variável para armazenar os cálculos de soma.
        foreach ($fields as $field) {
            $sums .= 'SUM(' . $field . ') AS ' . $field . ', '; // Para cada campo, monta a soma e o alias com o nome do campo.
        }
        $sums = substr($sums, 0, -2); // Remove a última vírgula para garantir que a query fique válida.

        // MONTA A QUERY
        $query = 'SELECT ' . $sums . ' FROM ' . $this->table . ' ' . $where; // Monta a query SQL para selecionar as somas dos campos especificados.

        return $this->execute($query); // Executa a query e retorna o resultado.
    }

    /**
     * Método responsável por atualizar estatísticas somando valores nos campos existentes
     * @param string $where Condição para definir quais registros serão atualizados (ex.: "id = 1").
     * @param array $values Array associativo contendo os campos e os valores a serem somados (ex.: ["campo1" => 5, "campo2" => 10]).
     * @return boolean Retorna true indicando que a operação foi bem-sucedida.
     */
    public function AtualizarEstatisticas($where, $values)
    {
        // DADOS DA QUERY
        $fields = array_keys($values); // Obtém as chaves (nomes dos campos) do array de valores.

        $locais = ' SET '; // Inicializa a cláusula SET da query SQL.
        foreach ($fields as $field) {
            $locais .= ' ' . $field . ' = ' . $field . ' + ?, '; // Para cada campo, adiciona um incremento com o valor correspondente.
        }
        $locais = substr($locais, 0, -2); // Remove a última vírgula para manter a query válida.

        // MONTA A QUERY
        $query = 'UPDATE ' . $this->table . $locais . ' WHERE ' . $where; // Monta a query de atualização com a cláusula WHERE.

        $this->execute($query, array_values($values)); // Executa a query de atualização com os valores a serem somados.

        // RETORNA SUCESSO
        return true; // Retorna true para indicar que a operação foi bem-sucedida.
    }
}