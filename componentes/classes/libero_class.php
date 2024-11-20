<?php
// Inclui a classe Jogador que a classe Libero irá estender
require_once "jogador_class.php";

// Classe Libero que herda da classe Jogador
class Libero extends Jogador
{
    // Atributos específicos da classe Libero
    private $passe_a; // Contador de passes do tipo A
    private $passe_b; // Contador de passes do tipo B
    private $passe_c; // Contador de passes do tipo C
    private $passe_d; // Contador de passes do tipo D

    /**
     * Método privado para definir os atributos do jogador
     * 
     * @param string $nome Nome completo do jogador
     * @param string $sexo Sexo do jogador
     * @param string $apelido Apelido ou nome curto do jogador
     * @param int $numero Número da camisa do jogador
     * @param float $altura Altura do jogador em metros
     * @param float $peso Peso do jogador em quilogramas
     */
    private function SetAll($nome, $sexo, $apelido, $numero, $altura, $peso)
    {
        // Atribui os parâmetros recebidos às propriedades da classe
        $this->nome_jogador = $nome; // Nome completo do jogador
        $this->apelido_jogador = $apelido; // Apelido ou nome curto do jogador
        $this->numero_camisa = $numero; // Número da camisa do jogador
        $this->sexo_jogador = $sexo; // Sexo do jogador (ex.: "M" ou "F")
        $this->altura_jogador = $altura; // Altura do jogador em metros
        $this->peso_jogador = $peso; // Peso do jogador em quilogramas

        // Define a posição padrão do jogador como "Líbero"
        $this->posicao = "Líbero";
    }


    /**
     * Método responsável por cadastrar um novo jogador do tipo Líbero no banco
     * @return boolean
     */
    public function CadastrarLibero($nome, $sexo, $apelido = null, $numero = null, $altura = null, $peso = null)
    {
        // Chama o método SetAll para atribuir os valores ao jogador
        $this->SetAll($nome, $sexo, $apelido, $numero, $altura, $peso);

        // Busca jogadores já cadastrados com o mesmo nome
        $jogadores = $this->getJogadores("nome_jogador = '$nome'");

        // Verifica se já existe um jogador com esse nome
        if (count($jogadores) > 0) {
            // Se encontrado, pega o ID do jogador existente
            $this->id_jogador = $jogadores[0]->id_jogador;

            // Cria uma nova instância da classe Database para manipulação da tabela 'libero'
            $obDatabase = new Database('libero');

            // Insere o ID do jogador na tabela 'libero'
            $this->id_jogador = $obDatabase->insert([
                'id_jogador' => $this->id_jogador
            ]);
        } else {
            // Se não encontrado, insere o jogador no banco
            $this->Cadastrar(); // Método da classe pai para cadastrar o jogador

            // Cria nova instância da classe Database
            $obDatabase = new Database('libero');

            // Insere o ID do jogador na tabela 'libero'
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
     * @return array Array de objetos do tipo Libero
     */
    public static function JuntarTabelas($tabelaPai, $campoIDFilho, $campoIDPai, $where = null, $order = null, $limit = null)
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'libero'
        return (new Database('libero'))->selectLeftJoin($tabelaPai, $campoIDFilho, $campoIDPai, $where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    // Método público chamado "AtualizarEstatisticas" para atualizar estatísticas de um jogador líbero
    public function AtualizarEstatisticas($idJogador, $valores)
    {
        // Cria uma nova instância da classe Database para manipular a tabela 'libero'
        // A tabela 'libero' provavelmente armazena estatísticas específicas para jogadores que atuam como líbero
        $obDatabase = new Database('libero');

        // Chama o método "AtualizarEstatisticas" da classe Database
        // O primeiro argumento é a condição de filtro "id_jogador = $idJogador", que seleciona o jogador a ser atualizado
        // O segundo argumento "$valores" é um array contendo os dados a serem atualizados, no formato 'coluna' => 'novo valor'
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
        return (new Database('libero'))->select('id_jogador = ' . $id)->fetchObject(self::class);
    }
}
