<?php
require_once "database_class.php";
class Usuario
{
    /**
     * Identificador único do Usuário
     * @var integer
     */
    private $id_usuario;
    /**
     * Nome do Usuário
     * @var string
     */
    private $nome_usuario;
    /**
     * Email do Usuário
     * @var string
     */
    private $email_usuario;
    /**
     * Senha do Usuário
     * @var string
     */
    private $senha_usuario;
    /**
     * É jogador
     * @var bool
     */
    private $jogador;
    /**
     * ID caso seja jogador
     * @var int
     */
    private $id_jogador;
    /**
     * É treinador
     * @var bool
     */
    private $treinador;
    /**
     * Método responsável por o usuário que tenha o email e a senha correspondentes
     * @param string $email
     * @param string $senha
     * @return array
     */
    public function __construct($nome = null, $senha = null, $email = null, $jogador = null, $id_jogador = null, $treinador = null){
    $this->$id_usuario = $nome;
    $this->$nome_usuario = $senha;
    $this->$email_usuario = $email;
    $this->$senha_usuario = $jogador;
    $this->$jogador = $id_jogador;
    $this->$id_jogador = $id_jogador;
    $this->$treinador = $treinador;
    }
    public static function Logar($email, $senha)
    {
        return (new Database('usuario'))->select("email_usuario = '$email' AND senha_usuario = '$senha'")->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    public static function Deslogar($redirecionar) {
        session_destroy();
        header("Location: $redirecionar");
    }
    public static function Cadastrar(){
        if($this->treinador){
        //INSERIR O USUÁRIO NO BANCO
        $obDatabase = new Database('usuario');
        $this->id = $obDatabase->insert([
            'nome' => $this->nome,
            'nome_usuario' => $this->nome_usuario,
            'email_usuario' => $this->email_usuario,
            'senha_usuario' => $this->senha_usuario,
            'jogador' => $this->jogador,
            'id_jogador' => $this->id_jogador,
            'treinador' => $this->treinador
        ]);
        //RETORNAR SUCESSO
        return true;}
    }
}
