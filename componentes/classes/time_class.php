<?php
// Inclui a classe de manipulação do banco de dados
require_once "database_class.php"; // Importa a classe para interagir com o banco de dados
require_once 'jogador_time_class.php'; // Importa a classe JogadorTime que provavelmente gerencia os jogadores no time

class Time
{
    /**
     * Identificador único do time
     * @var integer
     */
    private $id_time; // ID único do time

    /**
     * Nome do Time
     * @var string
     */
    private $nome_time; // Nome do time

    /**
     * Data de criação do time
     * @var string
     */
    private $data_hora_criacao; // Data e hora de criação do time

    /**
     * Sexo do Time
     * @var string(M/F/MIS)
     */
    private $sexo_time; // Sexo do time (Masculino, Feminino ou Misto)

    /**
     * Usuário que cadastrou o time
     * @var int
     */
    private $id_usuario; // ID do usuário que cadastrou o time

    /**
     * Instituição do time
     * @var int
     */
    private $id_istituicao; // ID da instituição à qual o time pertenceprivate $jogadores; // Lista de jogadores do time

    private $jogadores; // Lista de jogadores do time

    /**
     * Método para definir os jogadores do time
     * 
     * @param array $jogadores Array contendo objetos dos jogadores que compõem o time
     */
    public function DefinirJogadores($jogadores)
    {
        $this->jogadores = $jogadores; // Atribui a lista de jogadores à propriedade $jogadores
    }

    /**
     * Método para obter os jogadores do time
     * 
     * @return array Retorna a lista de jogadores do time
     */
    public function GetJogadores()
    {
        return $this->jogadores; // Retorna a lista de jogadores do time
    }

    /**
     * Método privado para definir todas as propriedades do time
     * 
     * @param string $nome Nome do time
     * @param string $sexo_time Categoria do time baseada em sexo (ex.: "Masculino" ou "Feminino")
     * @param int $id_usuario ID do usuário responsável pelo cadastro do time
     * @param int $id_istituicao ID da instituição associada ao time
     */
    private function SetALL($nome, $sexo_time, $id_usuario, $id_istituicao)
    {
        $this->nome_time = $nome; // Nome do time
        $this->sexo_time = $sexo_time; // Categoria do time (masculino/feminino)
        $this->id_usuario = $id_usuario; // ID do usuário responsável pelo cadastro
        $this->id_istituicao = $id_istituicao; // ID da instituição associada
    }

    // Métodos getters para obter informações do time

    /**
     * Método para obter o ID do time
     * 
     * @return int Retorna o ID do time
     */
    public function GetID()
    {
        return $this->id_time; // Retorna o ID do time
    }

    /**
     * Método para obter o nome do time
     * 
     * @return string Retorna o nome do time
     */
    public function GetNome()
    {
        return $this->nome_time; // Retorna o nome do time
    }

    /**
     * Método para obter a categoria do time
     * 
     * @return string Retorna a categoria do time baseada em sexo (masculino/feminino)
     */
    public function GetSexo()
    {
        return $this->sexo_time; // Retorna a categoria do time (masculino/feminino)
    }


    /**
     * Método responsável por cadastrar um novo time no banco
     * @return boolean Retorna verdadeiro indicando sucesso na operação
     */
    public function Cadastrar($nome, $sexo_time, $id_usuario, $id_istituicao)
    {
        // Chama o método SetALL para atribuir os valores ao time
        $this->SetALL($nome, $sexo_time, $id_usuario, $id_istituicao);
        // Define a data e hora atuais para a criação do time
        $this->data_hora_criacao = date('Y-m-d H:i:s');

        // Cria uma nova instância da classe Database para manipulação da tabela 'time'
        $obDatabase = new Database('time');

        // Insere um novo registro na tabela 'time' com os dados do objeto
        $this->id_time = $obDatabase->insert([
            'nome_time' => $this->nome_time, // Nome do time
            'data_hora_criacao' => $this->data_hora_criacao, // Data e hora de criação
            'sexo_time' => $this->sexo_time, // Sexo do time
            'id_usuario' => $this->id_usuario, // ID do usuário que cadastrou
            'id_instituicao' => $this->id_istituicao // ID da instituição
        ]);

        // Retorna verdadeiro indicando sucesso na operação
        return true;
    }

    /**
     * Método responsável por atualizar os dados do time no banco
     * @return boolean Retorna verdadeiro indicando sucesso na operação
     */
    public function Atualizar()
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'time'
        return (new Database('time'))->update('id = ' . $this->id_time, [
            'nome_time' => $this->nome_time, // Atualiza o nome do time
            'data_hora_criacao' => $this->data_hora_criacao, // Atualiza a data de criação
            'sexo_time' => $this->sexo_time, // Atualiza o sexo do time
            'id_istituicao' => $this->id_istituicao // Atualiza o ID da instituição
        ]);
    }

    /**
     * Método responsável por excluir um time do banco
     * @return boolean Retorna verdadeiro indicando sucesso na operação
     */
    public function Excluir()
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'time'
        return (new Database('time'))->delete('id = ' . $this->id_time); // Remove o time com base no ID
    }

    /**
     * Método responsável por obter a lista de times do banco de dados
     * @param string $where Condição de filtragem dos registros
     * @param string $order Ordem dos registros
     * @param string $limit Limite dos registros retornados
     * @return array Array de objetos do tipo Time
     */
    public static function GetTimes($where = null, $order = null, $limit = null, $fields = '*')
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'time'
        return (new Database('time'))->select($where, $order, $limit, $fields)->fetchAll(PDO::FETCH_CLASS, self::class); // Retorna todos os times com base nas condições
    }

    /**
     * Método responsável por buscar um time específico com base em seu ID
     * @param integer $id_time Identificador do time
     * @return Time Objeto do tipo Time correspondente ao ID fornecido
     */
    public static function GetTime($id_time)
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'time'
        return (new Database('time'))->select('id_time = ' . $id_time)->fetchObject(self::class); // Retorna o time com base no ID
    }

    // Método para adicionar um jogador ao time
    public function AdicionarJogadorAoTime($id_jogador, $id_time, $posicao_jogador)
    {
        // Cria uma nova instância da classe JogadorTime
        $jogador = new JogadorTime();
        // Cadastra o jogador com as informações fornecidas
        $jogador->Cadastrar($id_jogador, $id_time, $posicao_jogador);
    }
}
