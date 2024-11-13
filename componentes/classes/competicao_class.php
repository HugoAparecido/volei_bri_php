<?php
require_once "database_class.php";
class Competicao
{
    private int $id_competicao;
    private int $id_time_desafiante;
    private ?int $id_time_desafiado;
    private string $data_hora_competicao;
    private string $nome_competicao;
    private function SetAll(array $dados)
    {
        $this->nome_competicao = $dados[0];
        $this->id_time_desafiante = $dados[1];
        $this->id_time_desafiado = $dados[2];
    }
    public function GetID()
    {
        return $this->id_competicao;
    }
    public function GetNome()
    {
        return $this->nome_competicao;
    }
    public function Cadastrar(array $dados)
    {
        $this->SetAll($dados);
        $this->data_hora_competicao = date('Y-m-d H:i:s');
        $obDatabase = new Database('competicao');
        // Insere os dados do jogador na tabela e armazena o ID gerado
        $this->id_competicao = $obDatabase->insert([
            'nome_competicao' => $this->nome_competicao,
            'id_time_desafiante' => $this->id_time_desafiante,
            'id_time_desafiado' => $this->id_time_desafiado,
            'data_hora_competicao' => $this->data_hora_competicao
        ]);
    }
    public static function GetCompeticoes($where = null, $order = null, $limit = null, $fields = '*')
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'competicao'
        return (new Database('competicao'))->select($where, $order, $limit, $fields)->fetchAll(PDO::FETCH_CLASS, self::class); // Retorna todos os times com base nas condições
    }
}
