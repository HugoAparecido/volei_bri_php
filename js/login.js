// importações necessárias
import { Validation } from "./classes/validation_class.js"; // Importa a classe `Validation` de um arquivo externo, que fornece métodos para validar os campos do formulário.

// Elementos htmls
const form = {
    email: () => document.getElementById('email'), // Função que retorna o elemento HTML com o ID 'email'.
    erroEmailInvalido: () => document.getElementById("email-invalido-erro"), // Função que retorna o elemento HTML para exibir erros de email inválido.
    erroEmailRequerido: () => document.getElementById("email-requerido-erro"), // Função que retorna o elemento HTML para exibir erros quando o email é requerido e não fornecido.
    botaoLogin: () => document.getElementById("login-botao"), // Função que retorna o botão de login.
    senha: () => document.getElementById('senha'), // Função que retorna o elemento HTML com o ID 'senha'.
    erroSenhaRequerida: () => document.getElementById("senha-requerido-erro"), // Função que retorna o elemento HTML para exibir erros quando a senha é requerida e não fornecida.
    recuperarSenha: () => document.getElementById("recuperar-senha-botao"), // Função que retorna o botão para recuperar senha.
    cadastrar: () => document.getElementById("cadastrar-botao") // Função que retorna o botão para cadastro (não utilizado no restante do código).
}

// validacoes
let validacoes = new Validation(form.email(), form.senha()); // Cria uma instância da classe `Validation`, passando os campos de email e senha para serem validados.

// eventos
form.email().addEventListener('input', () => { // Adiciona um ouvinte de evento para mudanças no campo de email.
    validacoes.OnChangeEmail( // Quando o conteúdo do campo de email muda, chama o método `OnChangeEmail` da instância `validacoes`.
        form.erroEmailRequerido, // Passa a função para obter o elemento de erro para email requerido.
        form.erroEmailInvalido, // Passa a função para obter o elemento de erro para email inválido.
        form.recuperarSenha, // Passa a função para obter o botão de recuperação de senha.
        form.botaoLogin // Passa a função para obter o botão de login.
    );
});

form.senha().addEventListener('input', () => { // Adiciona um ouvinte de evento para mudanças no campo de senha.
    validacoes.OnChangeSenha( // Quando o conteúdo do campo de senha muda, chama o método `OnChangeSenha` da instância `validacoes`.
        form.recuperarSenha, // Passa a função para obter o botão de recuperação de senha.
        form.botaoLogin, // Passa a função para obter o botão de login.
        form.erroSenhaRequerida // Passa a função para obter o elemento de erro para senha requerida.
    );
});

form.recuperarSenha().addEventListener('click', () => { // Adiciona um ouvinte de evento para o clique no botão de recuperação de senha.
    window.location.href = './recuperar_senha.php' // Redireciona o navegador para a página de recuperação de senha.
});
