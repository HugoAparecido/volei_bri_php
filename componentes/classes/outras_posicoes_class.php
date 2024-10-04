<?php
// Importa a classe Jogador que provavelmente contém as propriedades e métodos básicos de um jogador
require_once "jogador_class.php";

class OutrasPosicoes extends Jogador
{
    // Propriedade para armazenar o ID da posição do jogador
    private $id_posicao;
    private $passe_a;
    private $passe_b;
    private $passe_c;
    private $passe_;
    private $bloqueio_convertido;
    private $bloqueio_errado;
    private $ataque_dentro;
    private $ataque_fora;
    private $saque_ace_cima;
    private $saque_ace_flutuante;
    private $saque_ace_viagem;
    private $saque_cima;
    private $saque_flutuante;
    private $saque_viagem;
    private $saque_errado;

    // Método privado para definir todos os atributos do jogador
    private function SetAll($nome, $sexo, $posicao, $apelido, $numero, $altura, $peso)
    {
        // Atribui os valores recebidos aos atributos da classe
        $this->nome_jogador = $nome;
        $this->apelido_jogador = $apelido;
        $this->numero_camisa = $numero;
        $this->sexo_jogador = $sexo;
        $this->altura_jogador = $altura;
        $this->peso_jogador = $peso;
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
            $this->Cadastrar();
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
}
