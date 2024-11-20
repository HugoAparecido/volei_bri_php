<?php
// Inclui a classe Jogador que a classe Levantador irá estender
require_once "jogador_class.php";

// Classe Levantador que herda da classe Jogador
class Levantador extends Jogador
{
    // Atributos específicos da classe Levantador
    private $ataque_dentro; // Contador de ataques realizados dentro do time
    private $ataque_fora; // Contador de ataques errados
    private $bloqueio_convertido; // Contador de bloqueios convertidos
    private $bloqueio_errado; // Contador de bloqueios errados
    private $errou_levantamento; // Contador de levantamentos errados
    private $levantamento_para_oposto; // Contador de levantamentos para jogador oposto
    private $levantamento_para_ponta; // Contador de levantamentos para jogador de ponta
    private $levantamento_para_pipe; // Contador de levantamentos para jogador de pipe
    private $levantamento_para_centro; // Contador de levantamentos para jogador de centro
    private $saque_fora; // Contador de saques fora do time
    private $saque_cima; // Contador de saques do tipo cima
    private $saque_flutuante; // Contador de saques do tipo flutuante
    private $saque_viagem; // Contador de saques do tipo viagem
    private $saque_ace; // Contador de saques ace
    // Método privado para definir os atributos do jogador
    private function SetAll($nome, $sexo, $apelido, $numero, $altura, $peso)
    {
        // Atribui os parâmetros às propriedades da classe
        $this->nome_jogador = $nome; // Nome do jogador
        $this->apelido_jogador = $apelido; // Apelido do jogador
        $this->numero_camisa = $numero; // Número da camisa do jogador
        $this->sexo_jogador = $sexo; // Sexo do jogador
        $this->altura_jogador = $altura; // Altura do jogador
        $this->peso_jogador = $peso; // Peso do jogador
        $this->posicao = "Levantador"; // Define a posição como 'Levantador'
    }

    /**
     * Método responsável por cadastrar um novo jogador do tipo Levantador no banco
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

            // Cria nova instância da classe Database
            $obDatabase = new Database('levantador');

            // Insere o ID do jogador na tabela 'levantador'
            $this->id_jogador = $obDatabase->insert([
                'id_jogador' => $this->id_jogador
            ]);
        }

        // Retorna verdadeiro indicando sucesso na operação
        return true;
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

    // Método público chamado "AtualizarEstatisticas" para atualizar estatísticas de um jogador
    public function AtualizarEstatisticas($idJogador, $valores)
    {
        // Cria uma nova instância da classe Database para manipular a tabela 'levantador'
        $obDatabase = new Database('levantador');

        // Chama o método "AtualizarEstatisticas" da classe Database para atualizar os dados
        // O primeiro argumento é a condição "id_jogador = $idJogador", onde o ID do jogador será usado como filtro
        // O segundo argumento "$valores" é o array com os dados a serem atualizados
        $obDatabase->AtualizarEstatisticas('id_jogador = ' . $idJogador, $valores);
    }

    /**
     * Método responsável por buscar um jogador com base em seu ID
     * @param integer $id ID do jogador
     * @return Jogador Objeto do jogador
     */
    public static function getJogador($id)
    {
        // Realiza a consulta para buscar um jogador pelo ID e retorna o objeto correspondente
        return (new Database('levantador'))->select('id_jogador = ' . $id)->fetchObject(self::class);
    }
}