// importações necessárias
import { Validation } from "./classes/validation_class.js";
// Elementos htmls
const form = {
    email: () => document.getElementById('email'),
    erroEmailInvalido: () => document.getElementById("email-invalid-error"),
    erroEmailRequerido: () => document.getElementById("email-required-error"),
    botaoLogin: () => document.getElementById("login-button"),
    senha: () => document.getElementById('password'),
    erroSenhaRequerida: () => document.getElementById("password-required-error"),
    recuperarSenha: () => document.getElementById("recover-password-button"),
    cadastrar: () => document.getElementById("cadastrar-button")
}
// validacoes
let validacoes = new Validation(form.email(), form.senha());
// eventos
form.email().addEventListener('input', () => {
    validacoes.OnChangeEmail(form.erroEmailRequerido, form.erroEmailInvalido, form.recuperarSenha, form.botaoLogin);
});
form.senha().addEventListener('input', () => {
    validacoes.OnChangeSenha(form.recuperarSenha, form.botaoLogin, form.erroSenhaRequerida)
});
form.recuperarSenha().addEventListener('click', () => {
    window.location.href = './recuperar_senha.php'
})