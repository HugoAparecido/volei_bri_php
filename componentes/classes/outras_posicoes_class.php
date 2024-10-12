<?php
// Importa a classe Jogador que provavelmente contém as propriedades e métodos básicos de um jogador
require_once "jogador_class.php";

// Classe OutrasPosicoes que herda da classe Jogador
class OutrasPosicoes extends Jogador
{
    // Propriedades para armazenar dados do jogador
    private $id_posicao; // ID da posição do jogador
    private $passe_a; // Contador de passes do tipo A
    private $passe_b; // Contador de passes do tipo B
    private $passe_c; // Contador de passes do tipo C
    private $passe_; // Contador de passes (provavelmente um erro de digitação)
    private $bloqueio_convertido; // Contador de bloqueios convertidos
    private $bloqueio_errado; // Contador de bloqueios errados
    private $ataque_dentro; // Contador de ataques realizados dentro
    private $ataque_fora; // Contador de ataques realizados fora
    private $saque_ace_cima; // Contador de saques ace
    private $saque_ace_flutuante; // Contador de saques flutuantes ace
    private $saque_ace_viagem; // Contador de saques em viagem ace
    private $saque_cima; // Contador de saques acima
    private $saque_flutuante; // Contador de saques flutuantes
    private $saque_viagem; // Contador de saques em viagem
    private $saque_errado; // Contador de saques errados

    // Método privado para definir todos os atributos do jogador
    private function SetAll($nome, $sexo, $posicao, $apelido, $numero, $altura, $peso)
    {
        // Atribui os valores recebidos aos atributos da classe
        $this->nome_jogador = $nome; // Nome do jogador
        $this->apelido_jogador = $apelido; // Apelido do jogador
        $this->numero_camisa = $numero; // Número da camisa do jogador
        $this->sexo_jogador = $sexo; // Sexo do jogador
        $this->altura_jogador = $altura; // Altura do jogador
        $this->peso_jogador = $peso; // Peso do jogador
        $this->posicao_jogador = $posicao; // Define a posição do jogador
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
                'posicao' => $this->posicao_jogador
            ]);
        } else {
            // Se o jogador não existe, o método Cadastrar() deve inserir o jogador no banco
            $this->Cadastrar(); // Método da classe pai para cadastrar o jogador

            // Cria nova instância do banco de dados
            $obDatabase = new Database('outras_posicoes');

            // Insere a posição do novo jogador
            $this->id_posicao = $obDatabase->insert([
                'id_jogador' => $this->id_jogador,
                'posicao' => $this->posicao_jogador
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
    public function AtualizarEstatisticas($idJogador, $posicao, $valores)
    {
        // Cria uma nova instância da classe Database para interagir com a tabela 'jogador_no_time'
        $obDatabase = new Database('outras_posicoes');
        $obDatabase->AtualizarEstatisticas('id_jogador = ' . $idJogador . " AND posicao = '" . $posicao . "'", $valores);
    }
}
