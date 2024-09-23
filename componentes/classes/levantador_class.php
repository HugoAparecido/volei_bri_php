<?php
require_once "jogador_class.php";
class Levantador extends Jogador
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
    public function CadastrarLevantador($nome, $sexo, $apelido = null, $numero = null, $altura = null, $peso = null)
    {
        $this->SetAll($nome, $sexo, $apelido, $numero, $altura, $peso);
        //INSERIR O JOGADOR NO BANCO
        $this->Cadastrar();
        $obDatabase = new Database('levantador');
        $this->id_jogador = $obDatabase->insert([
            'id_jogador' => $this->id_jogador
        ]);
        //RETORNAR SUCESSO
        return true;
    }
    public static function JuntarTabelas($tabelaPai, $campoIDFilho, $campoIDPai, $where = null, $order = null, $limit = null)
    {
        return (new Database('levantador'))->selectLeftJoin($tabelaPai, $campoIDFilho, $campoIDPai, $where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}
