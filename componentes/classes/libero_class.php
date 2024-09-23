<?php
require_once "jogador_class.php";
class Libero extends Jogador
{
    // Definindo a posição para Líbero
    private function SetAll($nome, $sexo, $apelido, $numero, $altura, $peso)
    {
        $this->nome_jogador = $nome;
        $this->apelido_jogador = $apelido;
        $this->numero_camisa = $numero;
        $this->sexo_jogador = $sexo;
        $this->altura_jogador = $altura;
        $this->peso_jogador = $peso;
        $this->sexo_jogador = $sexo;
        $this->posicao_jogador = "Líbero";
    }
    /**
     * Método responsável por Cadastrar um novo jogador no banco
     * @return boolean
     */
    public function CadastrarLibero($nome, $sexo, $apelido = null, $numero = null, $altura = null, $peso = null)
    {
        $this->SetAll($nome, $sexo, $apelido, $numero, $altura, $peso);
        $jogadores = $this->getJogadores("nome_jogador = '$nome'");
        print_r($jogadores);
        // //INSERIR O JOGADOR NO BANCO
        // $this->Cadastrar();
        // $obDatabase = new Database('libero');
        // $this->id_jogador = $obDatabase->insert([
        //     'id_jogador' => $this->id_jogador
        // ]);
        // //RETORNAR SUCESSO
        // return true;
    }
    /**
     * Método responsável por obter os jogadores do banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getJogadores($where = null, $order = null, $limit = null)
    {
        return (new Database('jogador'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    public static function JuntarTabelas($tabelaPai, $campoIDFilho, $campoIDPai, $where = null, $order = null, $limit = null)
    {
        return (new Database('libero'))->selectLeftJoin($tabelaPai, $campoIDFilho, $campoIDPai, $where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}
