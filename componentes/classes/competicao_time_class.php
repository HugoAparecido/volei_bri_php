<?php
class CompeticaoTime
{
    // Atributos privados da classe
    private int $id_competicao;

    private int $id_time;


    // Atributos relacionados a estatísticas do jogador no time

    /**
     * Defesas realizadas pelo jogador no time
     * @var int
     */
    private int $defesa_no_time;

    private int $erro_defesa_no_time;

    /**
     * Ataques realizados pelo jogador dentro do time
     * @var int
     */
    private int $ataque_dentro_no_time;

    /**
     * Ataques realizados pelo jogador fora do time
     * @var int
     */
    private int $ataque_fora_no_time;

    /**
     * Bloqueios convertidos com sucesso pelo jogador no time
     * @var int
     */
    private int $bloqueio_convertido_no_time;

    /**
     * Bloqueios errados realizados pelo jogador no time
     * @var int
     */
    private int $bloqueio_errado_no_time;

    /**
     * Passes do tipo A realizados pelo jogador no time
     * @var int
     */
    private int $passe_a_no_time;

    /**
     * Passes do tipo B realizados pelo jogador no time
     * @var int
     */
    private int $passe_b_no_time;

    /**
     * Passes do tipo C realizados pelo jogador no time
     * @var int
     */
    private int $passe_c_no_time;

    /**
     * Passes do tipo D realizados pelo jogador no time
     * @var int
     */
    private int $passe_d_no_time;

    /**
     * Levantamentos para o jogador oposto realizados pelo jogador no time
     * @var int
     */
    private int $levantamento_para_oposto_no_time;

    /**
     * Levantamentos para o jogador de pipe realizados pelo jogador no time
     * @var int
     */
    private int $levantamento_para_pipe_no_time;

    /**
     * Levantamentos para o jogador de ponta realizados pelo jogador no time
     * @var int
     */
    private int $levantamento_para_ponta_no_time;

    /**
     * Levantamentos para o jogador de centro realizados pelo jogador no time
     * @var int
     */
    private int $levantamento_para_centro_no_time;

    /**
     * Contador de levantamentos errados realizados pelo jogador no time
     * @var int
     */
    private int $errou_levantamento_no_time;

    // Atributos relacionados ao saque do jogador no time

    /**
     * Saques realizados fora pelo jogador no time
     * @var int
     */
    private int $saque_fora_no_time;

    /**
     * Saques ace realizados pelo jogador no time
     * @var int
     */
    private int $saque_ace_no_time;

    /**
     * Saques do tipo cima realizados pelo jogador no time
     * @var int
     */
    private int $saque_cima_no_time;

    /**
     * Saques do tipo viagem realizados pelo jogador no time
     * @var int
     */
    private int $saque_viagem_no_time;

    /**
     * Saques do tipo flutuante realizados pelo jogador no time
     * @var int
     */
    private int $saque_flutuante_no_time;

    // Métodos para obter estatísticas específicas em formato de array
    public function GetPasses()
    {
        return '[' . ($this->passe_a_no_time ?? 0) . ',' . ($this->passe_b_no_time ?? 0) . ',' . ($this->passe_c_no_time ?? 0) . ',' . ($this->passe_d_no_time ?? 0) . ']';
    }

    public function GetDefesas()
    {
        return [($this->defesa_no_time ?? 0), ($this->erro_defesa_no_time ?? 0)];
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

    // Método privado chamado "SetIDs" para definir os IDs de competição e time
    private function SetIDs(array $ids)
    {
        // Define o ID da competição usando o primeiro valor do array $ids
        $this->id_competicao = $ids[0];

        // Define o ID do time usando o segundo valor do array $ids
        $this->id_time = $ids[1];
    }

    // Método público para cadastrar a relação entre competição e time
    public function Cadastrar(array $ids)
    {
        // Chama o método "SetIDs" para definir os IDs de competição e time
        $this->SetIDs($ids);

        // Cria uma nova instância da classe Database para manipulação da tabela 'competicao_time'
        $obDatabase = new Database('competicao_time');

        // Insere os dados de competição e time na tabela 'competicao_time'
        $obDatabase->insert([
            'id_competicao' => $this->id_competicao, // ID da competição
            'id_time' => $this->id_time              // ID do time
        ]);
    }

    /**
     * Método responsável por atualizar as estatísticas de um time em uma competição
     * @param int $idCompeticao ID da competição
     * @param int $idTime ID do time
     * @param array $valores Array contendo as estatísticas a serem atualizadas
     */
    public function AtualizarEstatisticas($idCompeticao, $idTime, $valores)
    {
        // Modifica as chaves do array de valores para refletir o formato esperado no banco de dados
        $valores = $this->ModificarChavesArray($valores);

        // Cria uma nova instância da classe Database para interagir com a tabela 'competicao_time'
        $obDatabase = new Database('competicao_time');

        // Atualiza as estatísticas na tabela 'competicao_time' com os valores modificados, 
        // aplicando a condição para um registro específico (baseado no ID da competição e do time)
        $obDatabase->AtualizarEstatisticas('id_competicao = ' . $idCompeticao . ' AND id_time = ' . $idTime, $valores);
    }

    public static function GetCompeticoesTime($where = null, $order = null, $limit = null, $fields = '*')
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'competicao'
        // Realiza uma consulta usando os parâmetros fornecidos e retorna os resultados como objetos da classe Competicao
        return (new Database('competicao_time'))
            ->select($where, $order, $limit, $fields)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    public static function GetCompeticaoTime($id)
    {
        return (new Database('competicao_time'))->select('id_competicao = ' . $id)->fetchObject(self::class);
    }

    /**
     * Método privado que modifica as chaves do array de valores, adicionando o sufixo '_no_time' a cada chave
     * para refletir o formato esperado no banco de dados
     * @param array $valores Array com as estatísticas a serem atualizadas
     * @return array Array com as chaves modificadas
     */
    private function ModificarChavesArray($valores)
    {
        // Obtém as chaves originais do array de valores
        $chaves = array_keys($valores);

        // Inicializa um novo array para armazenar as chaves modificadas
        $novasChaves = [];

        // Itera por cada chave original e adiciona o sufixo '_no_time' a ela
        foreach ($chaves as $chave) {
            array_push($novasChaves, $chave . '_no_time');
        }

        // Combina as novas chaves com os valores originais e retorna o array modificado
        return $valores = array_combine($novasChaves, $valores);
    }
}
