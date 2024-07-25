<?php
require_once "database_class.php";
class Usuario
{
    /**
     * Identificador único do Usuário
     * @var integer
     */
    public $id_usuario;
    /**
     * Nome do Usuário
     * @var string
     */
    public $nome_usuario;
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
    public static function Logar($email, $senha)
    {
        return (new Database('usuario'))->select("email_usuario = '$email' AND senha_usuario = '$senha'")->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}
