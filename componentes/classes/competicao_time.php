<?php
class CompeticaoTime
{
    // Atributos privados da classe

    /**
     * Identificador único do jogador
     * @var int
     */
    private int $id_jogador;

    /**
     * Identificador do jogador dentro de um time específico
     * @var int
     */
    private int $id_jogador_time;

    /**
     * Nome do jogador
     * @var string
     */
    private string $nome_jogador;

    /**
     * Número da camisa do jogador
     * @var int
     */
    private int $numero_camisa;

    /**
     * Identificador do time ao qual o jogador pertence
     * @var int
     */
    private int $id_time;


    // Atributos relacionados a estatísticas do jogador no time

    /**
     * Defesas realizadas pelo jogador no time
     * @var int
     */
    private int $defesa_no_time;

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

    /**
     * Posição do jogador no time (ex.: levantador, atacante, defensor)
     * @var string
     */
    private string $posicao_jogador;


    // Atributos relacionados ao saque do jogador no time

    /**
     * Saques realizados fora pelo jogador no time
     * @var int
     */
    private int $saque_fora_no_time;

    /**
     * Saques ace do tipo cima realizados pelo jogador no time
     * @var int
     */
    private int $saque_ace_cima_no_time;

    /**
     * Saques ace do tipo viagem realizados pelo jogador no time
     * @var int
     */
    private int $saque_ace_viagem_no_time;

    /**
     * Saques ace do tipo flutuante realizados pelo jogador no time
     * @var int
     */
    private int $saque_ace_flutuante_no_time;

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
