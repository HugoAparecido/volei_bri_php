<?php
// Requer o arquivo que contém a classe de conexão com o banco de dados
require_once 'database_class.php';

// Classe JogadorTime que representa a relação entre um jogador e um time
class JogadorTime
{
    // Atributos privados da classe
    private int $id_jogador; // Identificador único do jogador
    private int $id_jogador_time;
    private string $nome_jogador; // Nome do jogador
    private int $numero_camisa; // Número da camisa do jogador
    private int $id_time; // Identificador do time ao qual o jogador pertence

    // Atributos relacionados a estatísticas do jogador no time
    private int $defesa_jogador_no_time; // Defesas realizadas pelo jogador no time
    private int $erro_defesa_no_time; // Defesas realizadas pelo jogador no time
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
    private ?int $saque_fora_no_time; // Saques fora do time
    private ?int $saque_ace_no_time; // Saques ace do tipo flutuante
    private ?int $saque_cima_no_time; // Saques do tipo cima
    private ?int $saque_viagem_no_time; // Saques do tipo viagem
    private ?int $saque_flutuante_no_time; // Saques do tipo flutuante

    // Método para obter o ID do jogador
    public function GetIDJogador()
    {
        return $this->id_jogador;
    }
    // Método para obter o ID do jogador
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

    public function GetPasses()
    {
        return '[' . $this->passe_a_no_time . ',' . $this->passe_b_no_time . ',' . $this->passe_c_no_time . ',' . $this->passe_d_no_time . ']';
    }

    public function GetDefesas()
    {
        return '[' . $this->defesa_jogador_no_time . ',' . $this->erro_defesa_no_time . ']';
    }

    public function GetAtaques()
    {
        return '[' . $this->ataque_dentro_no_time . ',' . $this->ataque_fora_no_time . ']';
    }

    public function GetBloqueios()
    {
        return '[' . $this->bloqueio_convertido_no_time . ',' . $this->bloqueio_errado_no_time . ']';
    }
    public function GetSaques()
    {
        return '[' . ($this->saque_ace_no_time ?? 0) . ',' . ($this->saque_viagem_no_time ?? 0) . ',' . ($this->saque_flutuante_no_time ?? 0) . ',' . ($this->saque_cima_no_time ?? 0) . ',' . ($this->saque_fora_no_time ?? 0) . ']';
    }
    public function GetLeavtamentos()
    {
        return '[' . $this->levantamento_para_centro_no_time . ',' . $this->levantamento_para_oposto_no_time . ',' . $this->levantamento_para_pipe_no_time . ',' . $this->levantamento_para_ponta_no_time . ',' . $this->errou_levantamento_no_time . ']';
    }
    // Método privado para definir o ID do jogador e do time
    private function SetIDs($id_jogador, $id_time): void
    {
        $this->id_jogador = $id_jogador; // Atribui o ID do jogador
        $this->id_time = $id_time; // Atribui o ID do time
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

    // Método estático para obter jogadores relacionados a um time
    public static function getJogadores($tabelaPai, $campoIDFilho, $campoIDPai, $where = null, $order = null, $limit = null)
    {
        // Realiza a consulta no banco de dados utilizando um LEFT JOIN
        return (new Database('jogador_no_time'))->selectLeftJoin($tabelaPai, $campoIDFilho, $campoIDPai, $where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    public static function getJogadoresTime($where = null, $order = null, $limit = null, $fields = null)
    {
        // Realiza a consulta no banco de dados e retorna um array de objetos da classe Jogador
        return (new Database('jogador_no_time'))->select($where, $order, $limit, $fields)->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    public static function GetEstatiticasSomaGeralDefesas($idTime)
    {
        return (new Database('jogador_no_time'))->SomarCampos([
            'defesa_jogador_no_time', // Defesas realizadas pelo jogador no time
            'erro_defesa_no_time'
        ], 'id_time = ' . $idTime)->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    public static function GetEstatiticasSomaGeralPasses($jogadorTime, $tabelaBanco)
    {
        return (new Database($tabelaBanco))->SomarCampos([
            'passe_a_no_time', // Passes do tipo A realizados no time
            'passe_b_no_time', // Passes do tipo B realizados no time
            'passe_c_no_time', // Passes do tipo C realizados no time
            'passe_d_no_time' // Passes do tipo D realizados no time
        ], 'id_jogador_time IN (' . implode(',', $jogadorTime) . ')')->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    public static function GetEstatiticasSomaGeralSaques($jogadorTime, $tabelaBanco)
    {
        return (new Database($tabelaBanco))->SomarCampos([
            'saque_fora_no_time', // Saques fora do time
            'saque_ace_no_time', // Saques ace
            'saque_cima_no_time', // Saques do tipo cima
            'saque_viagem_no_time', // Saques do tipo viagem
            'saque_flutuante_no_time', // Saques do tipo flutuante
        ], 'id_jogador_time IN (' . implode(',', $jogadorTime) . ')')->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    public static function GetEstatiticasSomaGeral($idTime)
    {
        return (new Database('jogador_no_time'))->SomarCampos([
            'defesa_jogador_no_time', // Defesas realizadas pelo jogador no time
            'erro_defesa_no_time',
            'ataque_dentro_no_time', // Ataques realizados dentro do time
            'ataque_fora_no_time', // Ataques realizados fora do time
            'bloqueio_convertido_no_time', // Bloqueios convertidos no time
            'bloqueio_errado_no_time', // Bloqueios errados no time
            'passe_a_no_time', // Passes do tipo A realizados no time
            'passe_b_no_time', // Passes do tipo B realizados no time
            'passe_c_no_time', // Passes do tipo C realizados no time
            'passe_d_no_time', // Passes do tipo D realizados no time
            'levantamento_para_oposto_no_time', // Levantamentos para jogador oposto
            'levantamento_para_pipe_no_time', // Levantamentos para jogador de pipe
            'levantamento_para_ponta_no_time', // Levantamentos para jogador de ponta
            'levantamento_para_centro_no_time', // Levantamentos para jogador de centro
            'errou_levantamento_no_time', // Contador de levantamentos errados
            // Atributos relacionados ao saque do jogador no time
            'saque_fora_no_time', // Saques fora do time
            'saque_ace_cima_no_time', // Saques ace do tipo cima
            'saque_ace_viagem_no_time', // Saques ace do tipo viagem
            'saque_ace_flutuante_no_time', // Saques ace do tipo flutuante
            'saque_cima_no_time', // Saques do tipo cima
            'saque_viagem_no_time', // Saques do tipo viagem
            'saque_flutuante_no_time', // Saques do tipo flutuante
        ], 'id_time = ' . $idTime)->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    public function AtualizarEstatisticas($idJogador, $idTime, $posicao, $defesas, $valores)
    {
        $valores = $this->ModificarChavesArray($valores);
        $defesas = $this->ModificarChavesArray($defesas);
        // Cria uma nova instância da classe Database para interagir com a tabela 'jogador_no_time'
        $obDatabase = new Database('jogador_no_time');
        $obDatabase->AtualizarEstatisticas('id_jogador = ' . $idJogador . ' AND id_time = ' . $idTime, $defesas);
        $idJogadorTime = $obDatabase->select('id_jogador = ' . $idJogador . ' AND id_time = ' . $idTime, null, null, 'id_jogador_time')->fetchAll()[0]['id_jogador_time'];
        var_dump($idJogadorTime);
        switch ($posicao) {
            case 'Levantador':
                $levantador = new Database('levantador_no_time');
                $levantador->AtualizarEstatisticas('id_jogador_time = ' . $idJogadorTime, $valores);
                break;
            case 'Líbero':
                $libero = new Database('libero_no_time');
                $libero->AtualizarEstatisticas('id_jogador_time = ' . $idJogadorTime, $valores);
                break;
            default:
                $outrasPosicoes = new Database('outras_posicoes_no_time');
                $outrasPosicoes->AtualizarEstatisticas('id_jogador_time = ' . $idJogadorTime, $valores);
                break;
        }
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
