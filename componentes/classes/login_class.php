<?php
require_once "./database_class.php";
class Usuario
{
    /**
     * Identificador único do Usuário
     * @var integer
     */
    private $id;
    /**
     * Nome do Usuário
     * @var string
     */
    private $nome;
    /**
     * Email do Usuário
     * @var string
     */
    private $email;
    /**
     * Senha do Usuário
     * @var string
     */
    private $senha;
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
    public function Logar($email, $senha)
    {
        $usuario = (new Database('usuario'))->select('email_usuario = ' . $email . ' AND senha_usuario = ' . $senha)->fetchAll(PDO::FETCH_CLASS, self::class);
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
    }
}