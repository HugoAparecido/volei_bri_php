<?php
class CompeticaoTime
{
    // Atributos privados da classe
    private int $id_jogador; // Identificador único do jogador
    private int $id_jogador_time;
    private string $nome_jogador; // Nome do jogador
    private int $numero_camisa; // Número da camisa do jogador
    private int $id_time; // Identificador do time ao qual o jogador pertence

    // Atributos relacionados a estatísticas do jogador no time
    private int $defesa_no_time; // Defesas realizadas pelo jogador no time
    private int $ataque_dentro_no_time; // Ataques realizados dentro do time
    private int $ataque_fora_no_time; // Ataques realizados fora do time
    private int $bloqueio_convertido_no_time; // Bloqueios convertidos no time
    private int $bloqueio_errado_no_time; // Bloqueios errados no time
    private int $passe_a_no_time; // Passes do tipo A realizados no time
    private int $passe_b_no_time; // Passes do tipo B realizados no time
    private int $passe_c_no_time; // Passes do tipo C realizados no time
    private int $passe_d_no_time; // Passes do tipo D realizados no time
    private int $levantamento_para_oposto_no_time; // Levantamentos para jogador oposto
    private int $levantamento_para_pipe_no_time; // Levantamentos para jogador de pipe
    private int $levantamento_para_ponta_no_time; // Levantamentos para jogador de ponta
    private int $levantamento_para_centro_no_time; // Levantamentos para jogador de centro
    private int $errou_levantamento_no_time; // Contador de levantamentos errados
    private string $posicao_jogador; // Posição do jogador no time

    // Atributos relacionados ao saque do jogador no time
    private int $saque_fora_no_time; // Saques fora do time
    private int $saque_ace_cima_no_time; // Saques ace do tipo cima
    private int $saque_ace_viagem_no_time; // Saques ace do tipo viagem
    private int $saque_ace_flutuante_no_time; // Saques ace do tipo flutuante
    private int $saque_cima_no_time; // Saques do tipo cima
    private int $saque_viagem_no_time; // Saques do tipo viagem
    private int $saque_flutuante_no_time; // Saques do tipo flutuante
    public function AtualizarEstatisticas($idCompeticao, $idTime, $valores)
    {
        $valores = $this->ModificarChavesArray($valores);
        // Cria uma nova instância da classe Database para interagir com a tabela 'competicao_time'
        $obDatabase = new Database('competicao_time');
        $obDatabase->AtualizarEstatisticas('id_competicao = ' . $idCompeticao . ' AND id_time = ' . $idTime, $valores);
    }
    private function ModificarChavesArray($valores)
    {
        $chaves = array_keys($valores);
        $novasChaves = [];
        foreach ($chaves as $chave) {
            array_push($novasChaves, $chave . '_no_time');
        }
        return $valores = array_combine($novasChaves, $valores);
    }
}
