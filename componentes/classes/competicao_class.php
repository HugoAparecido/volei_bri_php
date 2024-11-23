<?php
// Importa a classe de manipulação de banco de dados
require_once "database_class.php";

// Declaração da classe Competicao
class Competicao
{
    // Propriedades privadas da classe Competicao
    private int $id_competicao;             // ID da competição
    private int $id_time_desafiante;        // ID do time desafiante
    private ?int $id_time_desafiado;        // ID do time desafiado (pode ser nulo)
    private string $data_hora_competicao;   // Data e hora da competição
    private string $nome_competicao;        // Nome da competição

    // Método privado para definir todas as propriedades usando um array de dados
    private function SetAll(array $dados)
    {
        // Define o nome da competição
        $this->nome_competicao = $dados[0];

        // Define o ID do time desafiante
        $this->id_time_desafiante = $dados[1];

        // Define o ID do time desafiado (pode ser nulo)
        $this->id_time_desafiado = $dados[2];
    }

    // Método público para obter o ID da competição
    public function GetID()
    {
        return $this->id_competicao;
    }

    // Método público para obter o nome da competição
    public function GetNome()
    {
        return $this->nome_competicao;
    }

    public function GetDesafiante()
    {
        return $this->id_time_desafiante;
    }

    public function GetDesafiado()
    {
        return $this->id_time_desafiado;
    }

    public function GetData()
    {
        return $this->data_hora_competicao;
    }

    // Método para cadastrar uma nova competição
    public function Cadastrar(array $dados)
    {
        // Define todas as propriedades usando o array de dados fornecido
        $this->SetAll($dados);

        // Define a data e hora da competição para o momento atual
        $this->data_hora_competicao = date('Y-m-d H:i:s');

        // Cria uma nova instância da classe Database para manipulação da tabela 'competicao'
        $obDatabase = new Database('competicao');

        // Insere os dados da competição na tabela 'competicao' e armazena o ID gerado
        $this->id_competicao = $obDatabase->insert([
            'nome_competicao' => $this->nome_competicao,          // Nome da competição
            'id_time_desafiante' => $this->id_time_desafiante,    // ID do time desafiante
            'id_time_desafiado' => $this->id_time_desafiado,      // ID do time desafiado
            'data_hora_competicao' => $this->data_hora_competicao // Data e hora da competição
        ]);
    }

    // Método estático para obter uma lista de competições
    public static function GetCompeticoes($where = null, $order = null, $limit = null, $fields = '*')
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'competicao'
        // Realiza uma consulta usando os parâmetros fornecidos e retorna os resultados como objetos da classe Competicao
        return (new Database('competicao'))
            ->select($where, $order, $limit, $fields)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}
