<?php
// Inclui a classe de banco de dados que fornece métodos para interagir com o banco de dados
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
     * Retorna o ID do usuário
     * @return integer
     */
    public function GetID()
    {
        return $this->id_usuario;
    }

    /**
     * Retorna o nome do usuário
     * @return string
     */
    public function GetNomeUsuario()
    {
        return $this->nome_usuario; // Correção: Retornar $this->nome_usuario em vez de $this->id_usuario
    }

    /**
     * Verifica se o usuário é um treinador
     * @return bool
     */
    public function GetTreinador()
    {
        return $this->treinador;
    }

    /**
     * Tenta logar um usuário com o e-mail e senha fornecidos
     * @param string $email E-mail do usuário
     * @param string $senha Senha do usuário
     * @return array Lista de usuários que correspondem ao e-mail e senha
     */
    public static function Logar($email, $senha)
    {
        // Cria uma nova instância da classe Database e faz uma consulta para encontrar usuários com o e-mail e senha fornecidos
        return (new Database('usuario'))->select("email_usuario = '$email' AND senha_usuario = '$senha'")->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Desloga o usuário e redireciona para a página especificada
     * @param string $redirecionar URL para redirecionar após o logout
     */
    public static function Deslogar($redirecionar)
    {
        // Destrói a sessão do usuário
        session_destroy();
        // Redireciona para a URL fornecida
        header("Location: $redirecionar");
    }

    /**
     * Cadastra um novo usuário no banco de dados
     * @param string $nome Nome do usuário
     * @param string $email E-mail do usuário
     * @param string $senha Senha do usuário
     * @param bool $jogador Indica se o usuário é um jogador
     * @param bool $treinador Indica se o usuário é um treinador
     * @param int|null $id_jogador ID do jogador (opcional)
     * @return bool Retorna true se o usuário foi cadastrado com sucesso
     */
    public function Cadastrar($nome, $email, $senha, $jogador, $treinador, $id_jogador = null)
    {
        $this->nome_usuario = $nome;
        $this->email_usuario = $email;
        $this->senha_usuario = $senha;
        $this->jogador = $jogador;
        $this->treinador = $treinador;
        $this->id_jogador = $id_jogador;
        // Cria uma nova instância da classe Database para realizar a operação de inserção
        $obDatabase = new Database('usuario');
        // Insere os dados do usuário no banco de dados
        $this->id_usuario = $obDatabase->insert([
            'nome_usuario' => $this->nome_usuario,
            'email_usuario' => $this->email_usuario,
            'senha_usuario' => $this->senha_usuario,
            'jogador' => $this->jogador,
            'id_jogador' => $this->id_jogador,
            'treinador' => $this->treinador
        ]);

        // Retorna true indicando sucesso na operação de cadastro
        return true;
    }
}
