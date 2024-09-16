// Importações necessárias
import { Validation } from "./classes/validation_class.js";
// Importa a classe `Validation` de um arquivo externo. Esta classe fornece métodos para validar os campos do formulário, como email e senha.

// Elementos HTML
const form = {
    confirmarSenha: () => document.getElementById('confirmar_senha'), // Obtém o elemento do campo de confirmação de senha
    confirmarSenhaErroCorrespondencia: () => document.getElementById('senha_nao_corresponde_erro'), // Obtém o elemento que exibe o erro de correspondência de senha
    email: () => document.getElementById('email'), // Obtém o elemento do campo de email
    emailInvalidoErro: () => document.getElementById('email_invalido_erro'), // Obtém o elemento que exibe o erro de email inválido
    emailRequiredoErro: () => document.getElementById('email_requerido_erro'), // Obtém o elemento que exibe o erro quando o email é obrigatório
    senha: () => document.getElementById('senha'), // Obtém o elemento do campo de senha
    senhaMinLenghtErro: () => document.getElementById('senha_min_length_erro'), // Obtém o elemento que exibe o erro de comprimento mínimo da senha
    senhaRequeridaErro: () => document.getElementById('senha_requerida_erro'), // Obtém o elemento que exibe o erro quando a senha é obrigatória
    inputEhJogador: () => document.getElementById('ejogador'), // Obtém o elemento do campo de seleção se é jogador
    inputNaoEhJogador: () => document.getElementById('naoejogador'), // Obtém o elemento do campo de seleção se não é jogador
    selectJogador: () => document.getElementById('idJogador'), // Obtém o elemento de seleção do jogador
    botaoCadastro: () => document.getElementById("botao_cadastro") // Obtém o elemento do botão de cadastro
};

// Inicializa o valor do seletor de jogador como uma string vazia
form.selectJogador().value = '';

// Cria uma instância da classe `Validation` passando os elementos de email e senha
let validacoes = new Validation(form.email(), form.senha());

// Adiciona um ouvinte de eventos para o campo de email
form.email().addEventListener('input', () => {
    // Chama o método `OnChangeEmailCadastro` da instância de validação para verificar e atualizar os erros de email e o estado do botão de cadastro
    validacoes.OnChangeEmailCadastro(form.emailRequiredoErro, form.emailInvalidoErro, form.botaoCadastro);
});

// Adiciona um ouvinte de eventos para o campo de senha
form.senha().addEventListener('input', () => {
    // Chama o método `OnChangeSenhaRegister` da instância de validação para verificar e atualizar os erros de senha e o estado do botão de cadastro
    validacoes.OnChangeSenhaRegister(form.senhaRequeridaErro, form.senhaMinLenghtErro, form.botaoCadastro, form.confirmarSenha, form.confirmarSenhaErroCorrespondencia);
});

// Adiciona um ouvinte de eventos para o campo de confirmação de senha
form.confirmarSenha().addEventListener('input', () => {
    // Chama o método `OnChangeConfirmarSenha` da instância de validação para verificar e atualizar o erro de correspondência de senha e o estado do botão de cadastro
    validacoes.OnChangeConfirmarSenha(form.confirmarSenha, form.confirmarSenhaErroCorrespondencia, form.botaoCadastro);
});

// Adiciona um ouvinte de eventos para o campo de seleção de jogador
form.inputEhJogador().addEventListener('change', (event) => {
    if (event.target.checked) {
        // Se a opção de ser jogador estiver marcada, exibe o seletor de jogador
        form.selectJogador().style.display = 'block';
    }
});

// Adiciona um ouvinte de eventos para o campo de seleção de jogador
form.inputNaoEhJogador().addEventListener('change', (event) => {
    if (event.target.checked) {
        // Se a opção de ser jogador estiver marcada, exibe o seletor de jogador
        form.selectJogador().style.display = 'none';
        form.selectJogador().valuey = '';
    }
});
