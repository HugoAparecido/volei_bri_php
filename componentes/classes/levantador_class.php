<?php
// Inclui a classe Jogador que a classe Levantador irá estender
require_once "jogador_class.php";

class Levantador extends Jogador
{
    private $ataque_dentro;
    private $ataque_errado;
    private $bloqueio_convertido;
    private $bloqueio_errado;
    private $errou_levantamento;
    private $levantamento_para_oposto;
    private $levantamento_para_ponta;
    private $levantamento_para_pipe;
    private $levantamento_para_centro;
    private $saque_fora;
    private $saque_cima;
    private $saque_flutuante;
    private $saque_viagem;
    private $saque_cima_ace;
    private $saque_flutuante_ace;
    private $saque_viagem_ace;
    // Definindo a posição do jogador como 'Levantador'
    private function SetAll($nome, $sexo, $apelido, $numero, $altura, $peso)
    {
        // Atribui os parâmetros às propriedades da classe
        $this->nome_jogador = $nome; // Nome do jogador
        $this->apelido_jogador = $apelido; // Apelido do jogador
        $this->numero_camisa = $numero; // Número da camisa do jogador
        $this->sexo_jogador = $sexo; // Sexo do jogador
        $this->altura_jogador = $altura; // Altura do jogador
        $this->peso_jogador = $peso; // Peso do jogador
        $this->posicao_jogador = "Levantador"; // Define a posição como 'Levantador'
    }

    /**
     * Método responsável por cadastrar um novo jogador no banco
     * @return boolean
     */
    public function CadastrarLevantador($nome, $sexo, $apelido = null, $numero = null, $altura = null, $peso = null)
    {
        // Chama o método SetAll para atribuir os valores ao jogador
        $this->SetAll($nome, $sexo, $apelido, $numero, $altura, $peso);

        // Busca jogadores já cadastrados com o mesmo nome
        $jogadores = $this->getJogadores("nome_jogador = '$nome'");

        // Verifica se já existe um jogador com esse nome
        if (count($jogadores) > 0) {
            // Se encontrado, pega o ID do jogador existente
            $this->id_jogador = $jogadores[0]->id_jogador;
            // Cria uma nova instância da classe Database para manipulação da tabela 'levantador'
            $obDatabase = new Database('levantador');
            // Insere o ID do jogador na tabela 'levantador'
            $this->id_jogador = $obDatabase->insert([
                'id_jogador' => $this->id_jogador
            ]);
        } else {
            // Se não encontrado, insere o jogador no banco
            $this->Cadastrar(); // Método da classe pai para cadastrar o jogador
            $obDatabase = new Database('levantador'); // Cria nova instância da classe Database
            // Insere o ID do jogador na tabela 'levantador'
            $this->id_jogador = $obDatabase->insert([
                'id_jogador' => $this->id_jogador
            ]);
        }
        // Retorna verdadeiro indicando sucesso na operação
        return true;
    }

    /**
     * Método responsável por obter os jogadores do banco de dados
     * @param string $where Condição de filtragem dos registros
     * @param string $order Ordem dos registros
     * @param string $limit Limite de registros retornados
     * @return array Array de objetos do tipo Levantador
     */
    public static function getJogadores($where = null, $order = null, $limit = null)
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'jogador'
        return (new Database('jogador'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsável por juntar tabelas usando LEFT JOIN
     * @param string $tabelaPai Nome da tabela pai para o JOIN
     * @param string $campoIDFilho Nome do campo ID da tabela filha
     * @param string $campoIDPai Nome do campo ID da tabela pai
     * @param string $where Condição de filtragem dos registros
     * @param string $order Ordem dos registros
     * @param string $limit Limite de registros retornados
     * @return array Array de objetos do tipo Levantador
     */
    public static function JuntarTabelas($tabelaPai, $campoIDFilho, $campoIDPai, $where = null, $order = null, $limit = null)
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'levantador'
        return (new Database('levantador'))->selectLeftJoin($tabelaPai, $campoIDFilho, $campoIDPai, $where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}
