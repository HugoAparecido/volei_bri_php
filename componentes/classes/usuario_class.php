<?php
// Inclui a classe de banco de dados que fornece métodos para interagir com o banco de dados
require_once "database_class.php"; // Importa a classe de manipulação de banco de dados
require_once "outras_posicoes_class.php"; // Importa outra classe relacionada a posições

// Definição da classe Usuario
class Usuario
{
    /**
     * Identificador único do Usuário
     * @var integer
     */
    private $id_usuario; // ID único do usuário

    /**
     * Nome do Usuário
     * @var string
     */
    private $nome_usuario; // Nome do usuário

    /**
     * Email do Usuário
     * @var string
     */
    private $email_usuario; // Email do usuário

    /**
     * Senha do Usuário
     * @var string
     */
    private $senha_usuario_site; // Senha do usuário para autenticação

    /**
     * Indica se o usuário é jogador
     * @var bool
     */
    private $jogador; // Verdadeiro se o usuário é jogador, falso caso contrário

    /**
     * ID caso seja jogador
     * @var int
     */
    private $id_jogador; // ID do jogador, se o usuário for um jogador

    /**
     * Indica se o usuário é treinador
     * @var bool
     */
    private $treinador; // Verdadeiro se o usuário é treinador, falso caso contrário

    /**
     * Retorna o ID do usuário
     * @return integer
     */
    public function GetID()
    {
        return $this->id_usuario; // Retorna o ID do usuário
    }

    /**
     * Retorna o nome do usuário
     * @return string
     */
    public function GetNomeUsuario()
    {
        return $this->nome_usuario; // Retorna o nome do usuário
    }

    /**
     * Retorna o email do usuário
     * @return string
     */
    public function GetEmailUsuario()
    {
        return $this->email_usuario; // Retorna o email do usuário
    }

    /**
     * Verifica se o usuário é um treinador
     * @return bool
     */
    public function GetTreinador()
    {
        return $this->treinador; // Retorna se o usuário é um treinador
    }

    /**
     * Verifica se o usuário é um jogador
     * @return bool
     */
    public function GetJogador()
    {
        return $this->jogador; // Retorna se o usuário é um jogador
    }

    /**
     * Retorna a senha do usuário
     * @return string
     */
    public function GetSenha()
    {
        return $this->senha_usuario_site; // Retorna a senha do usuário
    }

    /**
     * Configura todos os atributos do usuário
     *
     * Este método é responsável por definir os valores para as propriedades do usuário, incluindo nome, email, senha,
     * se o usuário é jogador ou treinador e o ID do jogador.
     *
     * @param string $nome Nome do usuário
     * @param string $email Email do usuário
     * @param string $senha Senha do usuário
     * @param bool $jogador Indica se o usuário é um jogador (true) ou não (false)
     * @param bool $treinador Indica se o usuário é um treinador (true) ou não (false)
     * @param int $id_jogador ID do jogador, caso o usuário seja um jogador
     */
    private function SetAll($nome, $email, $senha, $jogador, $treinador, $id_jogador)
    {
        // Define o nome do usuário
        $this->nome_usuario = $nome;

        // Define o email do usuário
        $this->email_usuario = $email;

        // Define a senha do usuário
        $this->senha_usuario_site = $senha;

        // Define se o usuário é um jogador
        $this->jogador = $jogador;

        // Define se o usuário é um treinador
        $this->treinador = $treinador;

        // Define o ID do jogador, se aplicável
        $this->id_jogador = $id_jogador;
    }

    /**
     * Tenta logar um usuário com o e-mail fornecido
     * @param string $email E-mail do usuário
     * @return array Lista de usuários que correspondem ao e-mail
     */
    public static function Logar($email)
    {
        // Cria uma nova instância da classe Database e faz uma consulta para encontrar usuários com o e-mail fornecido
        return (new Database('usuario'))->select("email_usuario = '$email'", null, 1)->fetchAll(PDO::FETCH_CLASS, self::class);
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
        // Configura todos os atributos do usuário
        $this->SetAll($nome, $email, password_hash($senha, PASSWORD_BCRYPT), $jogador, $treinador, $id_jogador);
        // Cria uma nova instância da classe Database para realizar a operação de inserção
        $obDatabase = new Database('usuario');
        // Insere os dados do usuário no banco de dados
        $this->id_usuario = $obDatabase->insert([
            'nome_usuario' => $this->nome_usuario,
            'email_usuario' => $this->email_usuario,
            'senha_usuario_site' => $this->senha_usuario_site,
            'jogador' => $this->jogador,
            'id_jogador' => $this->id_jogador,
            'treinador' => $this->treinador
        ]);

        // Retorna true indicando sucesso na operação de cadastro
        return true;
    }

    /**
     * Atualiza os dados do usuário no banco de dados
     * @param string $nome Nome do usuário
     * @param string $email E-mail do usuário
     * @param string $senha Senha do usuário
     * @param bool $jogador Indica se o usuário é um jogador
     * @param bool $treinador Indica se o usuário é um treinador
     * @param int|null $id_jogador ID do jogador (opcional)
     * @return boolean Retorna true se a atualização for bem-sucedida
     */
    public function Atualizar($nome, $email, $senha, $jogador, $treinador, $id_jogador = null)
    {
        // Configura todos os atributos do usuário
        $this->SetAll($nome, $email, password_hash($senha, PASSWORD_DEFAULT), $jogador, $treinador, $id_jogador);
        // Cria uma nova instância da classe Database para manipulação da tabela 'usuario'
        return (new Database('usuario'))->update('id = ' . $this->id_usuario, [
            'nome_usuario' => $this->nome_usuario,
            'email_usuario' => $this->email_usuario,
            'senha_usuario_site' => $this->senha_usuario_site,
            'jogador' => $this->jogador,
            'id_jogador' => $this->id_jogador,
            'treinador' => $this->treinador
        ]);
    }

    /**
     * Exclui o usuário do banco de dados
     * @return boolean Retorna true se a exclusão for bem-sucedida
     */
    public function Excluir()
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'usuario'
        return (new Database('usuario'))->delete('id = ' . $this->id_usuario);
    }

    /**
     * Obtém uma lista de usuários do banco de dados
     * @param string|null $where Condição de filtragem dos registros
     * @param string|null $order Ordem dos registros
     * @param string|null $limit Limite de registros retornados
     * @return array Array de objetos do tipo Usuario
     */
    public static function GetUsuarios($where = null, $order = null, $limit = null)
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'usuario'
        return (new Database('usuario'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Obtém um usuário específico com base em seu ID
     * @param integer $id_usuario Identificador do usuário
     * @return Usuario Objeto do tipo Usuario correspondente ao ID fornecido
     */
    public static function GetUsuario($id_usuario)
    {
        // Cria uma nova instância da classe Database para manipulação da tabela 'usuario'
        return (new Database('usuario'))->select('id = ' . $id_usuario)->fetchObject(self::class);
    }
}