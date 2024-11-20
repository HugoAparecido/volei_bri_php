<?php
// Requer o arquivo que contém a classe de conexão com o banco de dados
require_once "database_class.php";

// Classe Jogador que representa um jogador no sistema
class Jogador
{
    /**
     * Identificador único do jogador
     * @var integer
     */
    protected $id_jogador;

    /**
     * Nome do Jogador
     * @var string
     */
    protected $nome_jogador;

    /**
     * Apelido do jogador
     * @var string
     */
    protected $apelido_jogador;

    /**
     * Posição do jogador (ex: Líbero, Levantador)
     * @var string
     */
    protected $posicao;

    /**
     * Número da camisa do jogador
     * @var int
     */
    protected $numero_camisa;

    /**
     * Altura do jogador em metros
     * @var float
     */
    protected $altura_jogador;

    /**
     * Peso do jogador em quilogramas
     * @var float
     */
    protected $peso_jogador;

    /**
     * Sexo do jogador (M ou F)
     * @var string
     */
    protected $sexo_jogador;

    /**
     * Defesas do jogador
     * @var int
     */
    protected $defesa_jogador;

    /**
     * Erros Defesas do jogador
     * @var int
     */
    protected $erro_defesa;

    // Métodos para obter os dados do jogador (getters)

    /**
     * Retorna o ID do jogador
     * @return integer
     */
    public function GetID()
    {
        return $this->id_jogador;
    }

    /**
     * Retorna o nome do jogador
     * @return string
     */
    public function GetNome()
    {
        return $this->nome_jogador;
    }

    /**
     * Retorna o número da camisa, se for 0 retorna uma string vazia
     * @return string
     */
    public function GetNumeroCamisa()
    {
        return ($this->numero_camisa == 0 ? "" : $this->numero_camisa);
    }

    /**
     * Retorna o apelido do jogador
     * @return string
     */
    public function GetApelido()
    {
        return $this->apelido_jogador;
    }

    /**
     * Retorna o sexo do jogador
     * @return string
     */
    public function GetSexo()
    {
        return $this->sexo_jogador;
    }

    /**
     * Retorna a altura do jogador
     * @return float
     */
    public function GetAltura()
    {
        return $this->altura_jogador;
    }

    /**
     * Retorna o peso do jogador
     * @return float
     */
    public function GetPeso()
    {
        return $this->peso_jogador;
    }

    /**
     * Método responsável por cadastrar um novo jogador no banco de dados
     * @return boolean
     */
    protected function Cadastrar()
    {
        // Cria uma nova instância da classe Database para interagir com a tabela 'jogador'
        $obDatabase = new Database('jogador');

        // Insere os dados do jogador na tabela e armazena o ID gerado
        $this->id_jogador = $obDatabase->insert([
            'nome_jogador' => $this->nome_jogador,
            'apelido_jogador' => $this->apelido_jogador,
            'numero_camisa' => $this->numero_camisa,
            'altura_jogador' => $this->altura_jogador,
            'peso_jogador' => $this->peso_jogador,
            'sexo_jogador' => $this->sexo_jogador
        ]);

        // Retorna sucesso
        return true;
    }

    // Método público chamado "DefinirDadosAtualizar" para definir os dados de um jogador
    public function DefinirDadosAtualizar(array $dados)
    {
        // Define o ID do jogador usando o primeiro valor do array $dados
        $this->id_jogador = $dados[0];

        // Define o nome do jogador usando o segundo valor do array $dados
        $this->nome_jogador = $dados[1];

        // Define o apelido do jogador usando o terceiro valor do array $dados
        $this->apelido_jogador = $dados[2];

        // Define o número da camisa do jogador usando o quarto valor do array $dados
        $this->numero_camisa = $dados[3];

        // Define a altura do jogador usando o quinto valor do array $dados
        $this->altura_jogador = $dados[4];

        // Define o peso do jogador usando o sexto valor do array $dados
        $this->peso_jogador = $dados[5];
    }

    /**
     * Método responsável por atualizar os dados do jogador no banco de dados
     * @return boolean
     */
    public function Atualizar()
    {
        // Atualiza os dados do jogador com base no ID
        return (new Database('jogador'))->update('id_jogador = ' . $this->id_jogador, [
            'nome_jogador' => $this->nome_jogador,
            'numero_camisa' => $this->numero_camisa,
            'apelido_jogador' => $this->apelido_jogador,
            'altura_jogador' => $this->altura_jogador,
            'peso_jogador' => $this->peso_jogador
        ]);
    }

    /**
     * Método responsável por excluir o jogador do banco de dados
     * @return boolean
     */
    protected function Excluir()
    {
        // Exclui o jogador da tabela com base no ID
        return (new Database('jogador'))->delete('id = ' . $this->id_jogador);
    }

    /**
     * Método responsável por obter todos os jogadores do banco de dados
     * @param string $where Condição para a consulta
     * @param string $order Ordenação da consulta
     * @param string $limit Limite de resultados
     * @return array Lista de jogadores
     */
    public static function getJogadores($where = null, $order = null, $limit = null)
    {
        // Realiza a consulta no banco de dados e retorna um array de objetos da classe Jogador
        return (new Database('jogador'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsável por buscar um jogador com base em seu ID
     * @param integer $id ID do jogador
     * @return Jogador Objeto do jogador
     */
    public static function getJogador($id)
    {
        // Realiza a consulta para buscar um jogador pelo ID e retorna o objeto correspondente
        return (new Database('jogador'))->select('id_jogador = ' . $id)->fetchObject(self::class);
    }

    /**
     * Atualiza as estatísticas de defesas de um jogador específico no banco de dados.
     * 
     * @param int $idJogador ID do jogador cujas defesas serão atualizadas
     * @param array $valores Dados atualizados das estatísticas de defesa para o jogador
     */
    public function AtualizarDefesas($idJogador, $valores)
    {
        // Cria uma nova instância da classe Database para interagir com o banco de dados, 
        // configurando o acesso à tabela 'jogador'
        $obDatabase = new Database('jogador');

        // Atualiza as estatísticas do jogador com base na condição 'id_jogador = $idJogador', 
        // utilizando o array $valores para definir os novos valores das colunas
        $obDatabase->AtualizarEstatisticas('id_jogador = ' . $idJogador, $valores);
    }
}
