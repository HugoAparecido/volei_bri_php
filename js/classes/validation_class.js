export class Validation {
    //Toda vez que a classe é istanciada ela já recebe o campo email e senha
    constructor(email, senha) {
        this.email = email;
        this.senha = senha;
    }
    // Função para mudanças no campo email
    OnChangeEmail(emailRequiredError, emailInvalidError, recoverSenha, loginButton) {
        this.ToggleButtonDisabled(recoverSenha, loginButton);
        this.ToggleEmailErrors(emailRequiredError, emailInvalidError);
    }
    // Função para mudanças no campo email do register.html
    OnChangeEmailRegister(emailRequiredError, emailInvalidError, registerButton) {
        const email = this.email.value;
        emailRequiredError().style.display = email ? "none" : "block";
        emailInvalidError().style.display = this.ValidateEmail(email) ? "none" : "block";
        this.ToggleRegisterButtonDisabled(registerButton);
    }
    // Função para mudanças no campo senha
    OnChangeSenha(recoverSenha, loginButton, senhaRequiredError) {
        this.ToggleButtonDisabled(recoverSenha, loginButton);
        this.ToggleSenhaErrors(senhaRequiredError);
    }
    // Função para mudanças no campo email do register.html
    OnChangeSenhaRegister(senhaRequiredError, senhaMinLenghtError, registerButton, confirmarSenhaForm, confirmarSenhaDoesntMatchError) {
        const senha = this.senha.value;
        senhaRequiredError().style.display = senha ? "none" : "block";
        senhaMinLenghtError().style.display = senha.length >= 6 ? "none" : "block";
        this.ValidateSenhaMatch(confirmarSenhaForm, confirmarSenhaDoesntMatchError);
        this.ToggleRegisterButtonDisabled(registerButton);
    }
    // Função para mudanças no campo confirmar senha do register.html
    OnChangeConfirmarSenha(confirmarSenha, confirmarSenhaDoesntMatchError, registerButton) {
        this.ValidateSenhaMatch(confirmarSenha, confirmarSenhaDoesntMatchError);
        this.ToggleRegisterButtonDisabled(registerButton);
    }
    // verificar se  verificação de senha é igual a senha
    ValidateSenhaMatch(confirmarSenhaForm, confirmarSenhaDoesntMatchError) {
        const senha = this.senha.value;
        const confirmarSenha = confirmarSenhaForm().value;
        confirmarSenhaDoesntMatchError().style.display = senha == confirmarSenha ? "none" : "block";
    }
    // Mostrar os erros do email
    ToggleEmailErrors(emailRequiredError, emailInvalidError) {
        const email = this.email.value;
        emailRequiredError().style.display = email ? "none" : "block";
        emailInvalidError().style.display = this.ValidateEmail(email) ? "none" : "block";
    }
    // Mostrar os erros da senha
    ToggleSenhaErrors(senhaRequiredError) {
        const senha = this.senha.value;
        senhaRequiredError().style.display = senha ? "none" : "block";
    }
    // Ativar o botao de login
    ToggleButtonDisabled(recoverSenha, loginButton) {
        const emailValid = this.EmailValido();
        recoverSenha().disabled = !emailValid;
        const senhaValid = this.SenhaValida();
        loginButton().disabled = !emailValid || !senhaValid;
    }
    // Ativar o botão de registrar
    ToggleRegisterButtonDisabled(registerButton) {
        registerButton().disabled = !this.IsFormValid();
    }
    // Se o campo senha tem um valor diferente de ""
    SenhaValida() {
        const senha = this.senha.value
        if (!senha) {
            return false;
        }
        return true;
    }
    // Se o campo senha tem um valor diferente de ""
    EmailValido() {
        const email = this.email.value;
        if (!email) {
            return false;
        }
        return this.ValidateEmail(email);
    }
    // Se o formulario é válido
    IsFormValid() {
        const email = this.email.value;
        if (!email || !this.ValidateEmail(email)) {
            return false;
        }
        const senha = this.senha.value;
        // se a senha tiver menos de 6 caracteres ele não aceitará
        if (!senha || senha.length < 6) {
            return false;
        }
        return true;
    }
    // Forma para validar o email
    ValidateEmail(email) {
        return /\S+@\S+\.\S+/.test(email);
    }
    // Funções para evitar erros
    RemoverDepoisDoSegundoCaractere(str, char) { //Função gerada pela IA Bing e adapatada para a aplicação
        var partes = str.split(char);
        if (partes.length <= 2) {
            return str; // O caractere não aparece duas vezes
        }
        return partes[0] + char + partes[1]; // Retorna a string até o segundo caractere
    }
    TratarInputTextComoNumber(constInput) {
        constInput.value = this.RemoverDepoisDoSegundoCaractere(constInput.value, '.')
        constInput.value = this.RemoverDepoisDoSegundoCaractere(constInput.value, ',')
        constInput.value = constInput.value.replace(',', '.')
        constInput.addEventListener('input', function (e) {
            // Verificando se o valor é um número de ponto flutuante
            if (!/^[-+]?[0-9]*\.?[0-9]+$/g.test(this.value)) {
                // Se não for, limpa o valor
                this.value = '';
            }
        });
    }
    VerificarTimeSelecionadoExistente() {
        if (localStorage.getItem("timeAtualID") === null) {
            window.location.href = "./times.html";
        }
    }
}
