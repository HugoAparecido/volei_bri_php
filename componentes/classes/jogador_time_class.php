<?php
// Requer o arquivo que contém a classe de conexão com o banco de dados
require_once "database_class.php";

// Classe JogadorTime que representa a relação entre um jogador e um time
class JogadorTime
{
    // Atributos privados da classe
    private int $id_jogador; // Identificador único do jogador
    private int $id_jogador_time; // Identificador da relação entre jogador e time
    private string $nome_jogador; // Nome do jogador
    private int $numero_camisa; // Número da camisa do jogador
    private int $id_time; // Identificador do time ao qual o jogador pertence

    /**
     * Apelido do jogador
     * @var string
     */
    protected $apelido_jogador;

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

    // Atributos relacionados a estatísticas do jogador no time
    private ?int $defesa_jogador_no_time; // Defesas realizadas pelo jogador no time
    private ?int $erro_defesa_no_time; // Erros de defesa do jogador no time
    private ?int $ataque_dentro_no_time; // Ataques convertidos dentro do time
    private ?int $ataque_fora_no_time; // Ataques perdidos fora do time
    private ?int $bloqueio_convertido_no_time; // Bloqueios convertidos no time
    private ?int $bloqueio_errado_no_time; // Bloqueios errados no time
    private ?int $passe_a_no_time; // Passes do tipo A realizados no time
    private ?int $passe_b_no_time; // Passes do tipo B realizados no time
    private ?int $passe_c_no_time; // Passes do tipo C realizados no time
    private ?int $passe_d_no_time; // Passes do tipo D realizados no time
    private ?int $levantamento_para_oposto_no_time; // Levantamentos para jogador oposto
    private ?int $levantamento_para_pipe_no_time; // Levantamentos para jogador pipe
    private ?int $levantamento_para_ponta_no_time; // Levantamentos para jogador ponta
    private ?int $levantamento_para_centro_no_time; // Levantamentos para jogador central
    private ?int $errou_levantamento_no_time; // Erros de levantamento no time
    private ?string $posicao_jogador; // Posição do jogador no time

    // Atributos relacionados ao saque do jogador no time
    private ?int $saque_fora_no_time; // Saques errados fora do time
    private ?int $saque_ace_no_time; // Saques ace no time
    private ?int $saque_cima_no_time; // Saques altos realizados pelo jogador
    private ?int $saque_viagem_no_time; // Saques do tipo viagem
    private ?int $saque_flutuante_no_time; // Saques do tipo flutuante

    // Método para obter o ID do jogador
    public function GetIDJogador()
    {
        return $this->id_jogador;
    }

    // Método para obter o ID do jogador no time
    public function GetID()
    {
        return $this->id_jogador_time;
    }

    // Método para obter a posição do jogador
    public function GetPosicao()
    {
        return $this->posicao_jogador;
    }

    // Método para obter o nome do jogador
    public function GetNome()
    {
        return $this->nome_jogador;
    }

    // Método para obter o número da camisa do jogador
    public function GetNumeroCamisa()
    {
        return $this->numero_camisa;
    }

    // Métodos para obter estatísticas específicas em formato de array
    public function GetPasses()
    {
        return '[' . ($this->passe_a_no_time ?? 0) . ',' . ($this->passe_b_no_time ?? 0) . ',' . ($this->passe_c_no_time ?? 0) . ',' . ($this->passe_d_no_time ?? 0) . ']';
    }

    public function GetDefesas()
    {
        return '[' . ($this->defesa_jogador_no_time ?? 0) . ',' . ($this->erro_defesa_no_time ?? 0) . ']';
    }

    public function GetAtaques()
    {
        return '[' . ($this->ataque_dentro_no_time ?? 0) . ',' . ($this->ataque_fora_no_time ?? 0) . ']';
    }

    public function GetBloqueios()
    {
        return '[' . ($this->bloqueio_convertido_no_time ?? 0) . ',' . ($this->bloqueio_errado_no_time ?? 0) . ']';
    }

    public function GetSaques()
    {
        return '[' . ($this->saque_ace_no_time ?? 0) . ',' . ($this->saque_viagem_no_time ?? 0) . ',' . ($this->saque_flutuante_no_time ?? 0) . ',' . ($this->saque_cima_no_time ?? 0) . ',' . ($this->saque_fora_no_time ?? 0) . ']';
    }

    public function GetLevantamentos()
    {
        return '[' . ($this->levantamento_para_centro_no_time ?? 0) . ',' . ($this->levantamento_para_oposto_no_time ?? 0) . ',' . ($this->levantamento_para_pipe_no_time ?? 0) . ',' . ($this->levantamento_para_ponta_no_time ?? 0) . ',' . ($this->errou_levantamento_no_time ?? 0) . ']';
    }

    // Método privado para definir IDs do jogador e do time
    private function SetIDs($id_jogador, $id_time): void
    {
        $this->id_jogador = $id_jogador;
        $this->id_time = $id_time;
    }

    // Método para cadastrar um jogador em um time
    public function Cadastrar($id_jogador, $id_time, $posicao_jogador): bool
    {
        // Define a posição do jogador
        $this->posicao_jogador = $posicao_jogador;

        // Define os IDs do jogador e do time
        $this->SetIDs($id_jogador, $id_time);

        // Cria uma nova instância da classe Database para interagir com a tabela 'jogador_no_time'
        $obDatabase = new Database('jogador_no_time');

        // Insere os dados do jogador e do time na tabela
        $this->id_jogador_time = $obDatabase->insert([
            'id_jogador' => $this->id_jogador,
            'id_time' => $this->id_time,
            'posicao_jogador' => $this->posicao_jogador,
        ]);

        // Define o tipo de posição do jogador e insere na respectiva tabela
        switch ($posicao_jogador) {
            case 'Levantador':
                $levantador = new Database('levantador_no_time');
                $levantador->insert(['id_jogador_time' => $this->id_jogador_time]);
                break;
            case 'Líbero':
                $libero = new Database('libero_no_time');
                $libero->insert(['id_jogador_time' => $this->id_jogador_time]);
                break;
            default:
                $outraPosicoes = new Database('outras_posicoes_no_time');
                $outraPosicoes->insert(['id_jogador_time' => $this->id_jogador_time]);
                break;
        }

        return true; // Retorna sucesso
    }

    // Métodos estáticos para obter dados de jogadores relacionados a um time com base em parâmetros específicos
    public static function getJogadores($tabelaPai, $campoIDFilho, $campoIDPai, $where = null, $order = null, $limit = null)
    {
        return (new Database('jogador_no_time'))->selectLeftJoin($tabelaPai, $campoIDFilho, $campoIDPai, $where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getJogadoresTime($where = null, $order = null, $limit = null, $fields = null)
    {
        return (new Database('jogador_no_time'))->select($where, $order, $limit, $fields)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    // Métodos estáticos para obter somas das estatísticas gerais de defesa, passe e saque
    public static function GetEstatiticasSomaGeralDefesas($idTime)
    {
        return (new Database('jogador_no_time'))->SomarCampos([
            'defesa_jogador_no_time',
            'erro_defesa_no_time'
        ], 'id_time = ' . $idTime)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function GetEstatiticasSomaGeralPasses($jogadorTime, $tabelaBanco)
    {
        return (new Database($tabelaBanco))->SomarCampos([
            'passe_a_no_time',
            'passe_b_no_time',
            'passe_c_no_time',
            'passe_d_no_time'
        ], 'id_jogador_time IN (' . implode(',', $jogadorTime) . ')')->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function GetEstatiticasSomaGeralSaques($jogadorTime, $tabelaBanco)
    {
        return (new Database($tabelaBanco))->SomarCampos([
            'saque_fora_no_time',
            'saque_ace_no_time',
            'saque_cima_no_time',
            'saque_viagem_no_time',
            'saque_flutuante_no_time'
        ], 'id_jogador_time IN (' . implode(',', $jogadorTime) . ')')->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function GetEstatiticasSomaGeralAtaques($jogadorTime, $tabelaBanco)
    {
        return (new Database($tabelaBanco))->SomarCampos([
            'ataque_dentro_no_time',
            'ataque_fora_no_time'
        ], 'id_jogador_time IN (' . implode(',', $jogadorTime) . ')')->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function GetEstatiticasSomaGeralBloqueios($jogadorTime, $tabelaBanco)
    {
        return (new Database($tabelaBanco))->SomarCampos([
            'bloqueio_convertido_no_time',
            'bloqueio_errado_no_time'
        ], 'id_jogador_time IN (' . implode(',', $jogadorTime) . ')')->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function GetEstatiticasSomaGeralLevantamentos($jogadorTime, $tabelaBanco)
    {
        return (new Database($tabelaBanco))->SomarCampos([
            'levantamento_para_centro_no_time',
            'levantamento_para_oposto_no_time',
            'levantamento_para_pipe_no_time',
            'levantamento_para_ponta_no_time',
            'errou_levantamento_no_time'
        ], 'id_jogador_time IN (' . implode(',', $jogadorTime) . ')')->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public function AtualizarEstatisticas($idJogador, $idTime, $posicao, $defesas, $valores)
    {
        // Modifica as chaves do array de valores e defesas para o formato correto, se necessário
        $valores = $this->ModificarChavesArray($valores);
        $defesas = $this->ModificarChavesArray($defesas);

        // Cria uma nova instância da classe Database para interagir com a tabela 'jogador_no_time'
        $obDatabase = new Database('jogador_no_time');

        // Atualiza as estatísticas de defesas do jogador na tabela 'jogador_no_time'
        // A condição WHERE especifica o jogador e o time usando os IDs fornecidos
        $obDatabase->AtualizarEstatisticas('id_jogador = ' . $idJogador . ' AND id_time = ' . $idTime, $defesas);

        // Busca o 'id_jogador_time' correspondente ao jogador e time fornecidos para identificar a relação específica
        $idJogadorTime = $obDatabase->select('id_jogador = ' . $idJogador . ' AND id_time = ' . $idTime, null, null, 'id_jogador_time')->fetchAll()[0]['id_jogador_time'];

        // Atualiza as estatísticas do jogador na tabela específica com base em sua posição
        switch ($posicao) {
            case 'levantador':
                // Cria uma instância para a tabela de levantadores e atualiza as estatísticas de valores para este jogador
                $levantador = new Database('levantador_no_time');
                $levantador->AtualizarEstatisticas('id_jogador_time = ' . $idJogadorTime, $valores);
                break;

            case 'líbero':
                // Cria uma instância para a tabela de líberos e atualiza as estatísticas de valores para este jogador
                $libero = new Database('libero_no_time');
                $libero->AtualizarEstatisticas('id_jogador_time = ' . $idJogadorTime, $valores);
                break;

            default:
                // Para posições que não sejam levantador ou líbero, cria uma instância para a tabela de outras posições
                $outrasPosicoes = new Database('outras_posicoes_no_time');
                $outrasPosicoes->AtualizarEstatisticas('id_jogador_time = ' . $idJogadorTime, $valores);
                break;
        }
    }
    // Função privada chamada "ModificarChavesArray" que recebe um array como parâmetro.
    private function ModificarChavesArray($valores)
    {
        // Obtém todas as chaves do array passado como argumento.
        $chaves = array_keys($valores);

        // Inicializa um novo array para armazenar as chaves modificadas.
        $novasChaves = [];

        // Itera sobre cada chave do array original.
        foreach ($chaves as $chave) {
            // Adiciona a string "_no_time" ao final de cada chave e armazena no array $novasChaves.
            array_push($novasChaves, $chave . '_no_time');
        }

        // Combina as novas chaves modificadas com os valores originais do array.
        // O array_combine() cria um novo array onde $novasChaves são as chaves e $valores são os valores.
        return $valores = array_combine($novasChaves, $valores);
    }
}
