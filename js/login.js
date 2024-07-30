// importações necessárias
import { Validation } from "./classes/validation_class.js";
// Elementos htmls
const form = {
    email: () => document.getElementById('email'),
    emailInvalidError: () => document.getElementById("email-invalid-error"),
    emailRequiredError: () => document.getElementById("email-required-error"),
    loginButton: () => document.getElementById("login-button"),
    senha: () => document.getElementById('senha'),
    senhaRequiredError: () => document.getElementById("senha-required-error"),
    recoverSenha: () => document.getElementById("recover-senha-button"),
    register: () => document.getElementById("register-button")
}
// validacoes
let validacoes = new Validation(form.email(), form.senha());
form.email().addEventListener('input', () => {
    validacoes.OnChangeEmail(form.emailRequiredError, form.emailInvalidError, form.recoverSenha, form.loginButton);
});
form.senha().addEventListener('input', () => {
    validacoes.OnChangeSenha(form.recoverSenha, form.loginButton, form.senhaRequiredError)
});
// eventos