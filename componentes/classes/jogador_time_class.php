<?php
require_once 'database_class.php';
class JogadorTime
{
    private int $id_jogador;
    private string $nome_jogador;
    private int $numero_camisa;
    private int $id_time;
    private int $defesa_no_time;
    private int $ataque_dentro_no_time;
    private int $ataque_fora_no_time;
    private int $bloqueio_convertido_no_time;
    private int $bloqueio_errado_no_time;
    private int $passe_a_no_time;
    private int $passe_b_no_time;
    private int $passe_c_no_time;
    private int $passe_d_no_time;
    private int $levantamento_para_oposto_no_time;
    private int $levantamento_para_pipe_no_time;
    private int $levantamento_para_ponta_no_time;
    private int $levantamento_para_centro_no_time;
    private int $errou_levantamento_no_time;
    private string $posicao_jogador;
    private int $saque_fora_no_time;
    private int $saque_ace_cima_no_time;
    private int $saque_ace_viagem_no_time;
    private int $saque_ace_flutuante_no_time;
    private int $saque_cima_no_time;
    private int $saque_viagem_no_time;
    private int $saque_flutuante_no_time;
    public function GetID()
    {
        return $this->id_jogador;
    }
    public function GetPosicao()
    {
        return $this->posicao_jogador;
    }
    public function GetNome()
    {
        return $this->nome_jogador;
    }
    private function SetIDs($id_jogador, $id_time): void
    {
        $this->id_jogador = $id_jogador;
        $this->id_time = $id_time;
    }
    public function Cadastrar($id_jogador, $id_time, $posicao_jogador): bool
    {
        $this->posicao_jogador = $posicao_jogador;
        $this->SetIDs($id_jogador, $id_time);
        $obDatabase = new Database('jogador_no_time');
        $obDatabase->insert([
            'id_jogador' => $this->id_jogador,
            'id_time' => $this->id_time,
            'posicao_jogador' => $this->posicao_jogador,
        ]);
        return true;
    }
    public static function getJogadores($tabelaPai, $campoIDFilho, $campoIDPai, $where = null, $order = null, $limit = null)
    {
        return (new Database('jogador_no_time'))->selectLeftJoin($tabelaPai, $campoIDFilho, $campoIDPai, $where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}
