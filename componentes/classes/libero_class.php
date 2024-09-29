<?php
// Inclui a classe Jogador que a classe Libero irá estender
require_once "jogador_class.php";

class Libero extends Jogador
{
    // Definindo a posição do jogador como 'Líbero'
    private function SetAll($nome, $sexo, $apelido, $numero, $altura, $peso)
    {
        // Atribui os parâmetros às propriedades da classe
        $this->nome_jogador = $nome; // Nome do jogador
        $this->apelido_jogador = $apelido; // Apelido do jogador
        $this->numero_camisa = $numero; // Número da camisa do jogador
        $this->sexo_jogador = $sexo; // Sexo do jogador
        $this->altura_jogador = $altura; // Altura do jogador
        $this->peso_jogador = $peso; // Peso do jogador
        $this->posicao_jogador = "Líbero"; // Define a posição como 'Líbero'
    }

    /**
     * Método responsável por cadastrar um novo jogador no banco
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
            $obDatabase = new Database('libero'); // Cria nova instância da classe Database
            // Insere o ID do jogador na tabela 'libero'
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
     * @return array Array de objetos do tipo Libero
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
     * @return array Array de objetos do tipo Libero
     */
    public static function JuntarTabelas($tabelaPai, $campoIDFilho, $campoIDPai, $where = null, $order = null, $limit = null)
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'libero'
        return (new Database('libero'))->selectLeftJoin($tabelaPai, $campoIDFilho, $campoIDPai, $where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}
