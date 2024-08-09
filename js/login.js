// importações necessárias
import { Validation } from "./classes/validation_class.js";
// Elementos htmls
const form = {
    email: () => document.getElementById('email'),
    erroEmailIvalido: () => document.getElementById("email-invalid-error"),
    erroEmailRequerido: () => document.getElementById("email-required-error"),
    botaoLogin: () => document.getElementById("login-button"),
    senha: () => document.getElementById('senha'),
    erroSenhaRequerida: () => document.getElementById("senha-required-error"),
    recuperarSenha: () => document.getElementById("recover-senha-button"),
    cadastrar: () => document.getElementById("cadastrar-button")
}
// validacoes
let validacoes = new Validation(form.email(), form.senha());
form.email().addEventListener('input', () => {
    validacoes.OnChangeEmail(form.erroEmailRequerido, form.erroEmailIvalido, form.recuperarSenha, form.botaoLogin);
});
form.senha().addEventListener('input', () => {
    validacoes.OnChangeSenha(form.recuperarSenha, form.botaoLogin, form.erroSenhaRequerida)
});
// eventos