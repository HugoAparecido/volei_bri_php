<?php
// Importa a classe Jogador que provavelmente contém as propriedades e métodos básicos de um jogador
require_once "jogador_class.php";

// Classe OutrasPosicoes que herda da classe Jogador
class OutrasPosicoes extends Jogador
{
    // Propriedades para armazenar dados do jogador
    private $id_posicao; // ID da posição do jogador
    public $id_jogador; // ID do jogador
    private $passe_a; // Contador de passes do tipo A
    private $passe_b; // Contador de passes do tipo B
    private $passe_c; // Contador de passes do tipo C
    private $passe_d; // Contador de passes (provavelmente um erro de digitação)
    private $bloqueio_convertido; // Contador de bloqueios convertidos
    private $bloqueio_errado; // Contador de bloqueios errados
    private $ataque_dentro; // Contador de ataques realizados dentro
    private $ataque_fora; // Contador de ataques realizados fora
    private $saque_ace; // Contador de saques ace
    private $saque_cima; // Contador de saques acima
    private $saque_flutuante; // Contador de saques flutuantes
    private $saque_viagem; // Contador de saques em viagem
    private $saque_fora; // Contador de saques errados
    protected $posicao; // Posicao do jogador

    /**
     * Método privado para definir todos os atributos do jogador
     * 
     * @param string $nome Nome completo do jogador
     * @param string $sexo Sexo do jogador
     * @param string $posicao Posição do jogador em campo
     * @param string $apelido Apelido ou nome curto do jogador
     * @param int $numero Número da camisa do jogador
     * @param float $altura Altura do jogador em metros
     * @param float $peso Peso do jogador em quilogramas
     */
    private function SetAll($nome, $sexo, $posicao, $apelido, $numero, $altura, $peso)
    {
        // Atribui os valores recebidos aos atributos da classe
        $this->nome_jogador = $nome; // Nome completo do jogador
        $this->apelido_jogador = $apelido; // Apelido ou nome curto do jogador
        $this->numero_camisa = $numero; // Número da camisa do jogador
        $this->sexo_jogador = $sexo; // Sexo do jogador (ex.: "M" ou "F")
        $this->altura_jogador = $altura; // Altura do jogador em metros
        $this->peso_jogador = $peso; // Peso do jogador em quilogramas
        $this->posicao = $posicao; // Posição do jogador em campo (ex.: "Líbero", "Atacante")
    }

    public function GetPosicao()
    {
        return $this->posicao;
    }

    /**
     * Método responsável por cadastrar um novo jogador no banco de dados
     * @return boolean Retorna verdadeiro em caso de sucesso
     */
    public function CadastrarPosicao($nome, $sexo, $posicao, $apelido = null, $numero = null, $altura = null, $peso = null)
    {
        // Chama SetAll para definir os atributos do jogador
        $this->SetAll($nome, $sexo, $posicao, $apelido, $numero, $altura, $peso);

        // Verifica se o jogador já existe no banco de dados
        $jogadores = $this->getJogadores("nome_jogador = '$nome'");
        if (count($jogadores) > 0) {
            // Se o jogador existe, armazena o ID do jogador encontrado
            $this->id_jogador = $jogadores[0]->id_jogador;

            // Cria uma nova instância do banco de dados para inserir a posição
            $obDatabase = new Database('outras_posicoes');

            // Insere a posição do jogador no banco de dados
            $this->id_posicao = $obDatabase->insert([
                'id_jogador' => $this->id_jogador,
                'posicao' => $this->posicao
            ]);
        } else {
            // Se o jogador não existe, o método Cadastrar() deve inserir o jogador no banco
            $this->Cadastrar(); // Método da classe pai para cadastrar o jogador

            // Cria nova instância do banco de dados
            $obDatabase = new Database('outras_posicoes');

            // Insere a posição do novo jogador
            $this->id_posicao = $obDatabase->insert([
                'id_jogador' => $this->id_jogador,
                'posicao' => $this->posicao
            ]);
        }
        // Aqui poderia retornar um valor booleano indicando sucesso
    }

    /**
     * Método para juntar tabelas no banco de dados
     * @param string $tabelaPai Nome da tabela pai
     * @param string $campoIDFilho Campo da tabela filha
     * @param string $campoIDPai Campo da tabela pai
     * @param string $where Condição para a consulta
     * @param string $order Ordem dos resultados
     * @param string $limit Limite de resultados
     * @return array Retorna um array com os resultados da junção
     */
    public static function JuntarTabelas($tabelaPai, $campoIDFilho, $campoIDPai, $where = null, $order = null, $limit = null)
    {
        // Executa uma junção de tabelas e retorna os resultados como objetos da classe atual
        return (new Database('outras_posicoes'))->selectLeftJoin($tabelaPai, $campoIDFilho, $campoIDPai, $where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    // Método público chamado "AtualizarEstatisticas" para atualizar as estatísticas de um jogador em uma posição específica
    public function AtualizarEstatisticas($idJogador, $posicao, $valores)
    {
        // Cria uma nova instância da classe Database para manipular a tabela 'outras_posicoes'
        // A tabela 'outras_posicoes' é provavelmente usada para armazenar estatísticas de jogadores que não são líberos ou levantadores
        $obDatabase = new Database('outras_posicoes');

        // Chama o método "AtualizarEstatisticas" da classe Database
        // A condição de filtro usa o ID do jogador e a posição para garantir que a atualização seja feita corretamente
        // O filtro "id_jogador = $idJogador AND posicao = '$posicao'" seleciona o jogador específico e a posição dele
        // O argumento "$valores" é um array contendo os campos e seus novos valores
        $obDatabase->AtualizarEstatisticas('id_jogador = ' . $idJogador . " AND posicao = '" . $posicao . "'", $valores);
    }

    /**
     * Método responsável por buscar um jogador com base em seu ID
     * @param integer $id ID do jogador
     * @return Jogador Objeto do jogador
     */
    public static function getJogador($id)
    {
        // Realiza a consulta para buscar um jogador pelo ID e retorna o objeto correspondente
        return (new Database('outras_posicoes'))->select('id_posicao = ' . $id)->fetchObject(self::class);
    }

    /**
     * Método responsável por obter todos os jogadores do banco de dados
     * @param string $where Condição para a consulta
     * @param string $order Ordenação da consulta
     * @param string $limit Limite de resultados
     * @return array Lista de jogadores
     */
    public static function getJogadoresPosicao($where = null, $order = null, $limit = null)
    {
        // Realiza a consulta no banco de dados e retorna um array de objetos da classe Jogador
        return (new Database('outras_posicoes'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}