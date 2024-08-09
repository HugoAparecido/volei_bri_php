export class Validation {
    //Toda vez que a classe é istanciada ela já recebe o campo email e senha
    constructor(email, senha) {
        this.email = email;
        this.senha = senha;
    }
    // Função para mudanças no campo email
    OnChangeEmail(ErroEmailRequerido, EmailEmailInvalido, RecuperarBotao, BotaoLogin) {
        this.ToggleButtonDisabled(RecuperarBotao, BotaoLogin);
        this.ToggleEmailErros(ErroEmailRequerido, EmailEmailInvalido);
    }
    // Função para mudanças no campo email do register.html
    OnChangeEmailCadastro(ErroEmailRequerido, EmailEmailInvalido, BotaoCadastro) {
        const email = this.email.value;
        ErroEmailRequerido().style.display = email ? "none" : "block";
        EmailEmailInvalido().style.display = this.ValidarEmail(email) ? "none" : "block";
        this.ToggleBotaoCadastroDisabled(BotaoCadastro);
    }
    // Função para mudanças no campo senha
    OnChangeSenha(RecuperarBotao, BotaoLogin, ErroRequerimentoSenha) {
        this.ToggleButtonDisabled(RecuperarBotao, BotaoLogin);
        this.ToggleSenhaErros(ErroRequerimentoSenha);
    }
    // Função para mudanças no campo email do register.html
    OnChangeSenhaRegister(ErroRequerimentoSenha, senhaMinLenghtError, BotaoCadastro, confirmarSenhaForm, ConfirmarSenhaNaoCorrespondeErro) {
        const senha = this.senha.value;
        ErroRequerimentoSenha().style.display = senha ? "none" : "block";
        senhaMinLenghtError().style.display = senha.length >= 6 ? "none" : "block";
        this.ValidarSenhaNaoCorresponde(confirmarSenhaForm, ConfirmarSenhaNaoCorrespondeErro);
        this.ToggleBotaoCadastroDisabled(BotaoCadastro);
    }
    // Função para mudanças no campo confirmar senha do register.html
    OnChangeConfirmarSenha(confirmarSenha, ConfirmarSenhaNaoCorrespondeErro, BotaoCadastro) {
        this.ValidarSenhaNaoCorresponde(confirmarSenha, ConfirmarSenhaNaoCorrespondeErro);
        this.ToggleBotaoCadastroDisabled(BotaoCadastro);
    }
    // verificar se  verificação de senha é igual a senha
    ValidarSenhaNaoCorresponde(confirmarSenhaForm, ConfirmarSenhaNaoCorrespondeErro) {
        const senha = this.senha.value;
        const confirmarSenha = confirmarSenhaForm().value;
        ConfirmarSenhaNaoCorrespondeErro().style.display = senha == confirmarSenha ? "none" : "block";
    }
    // Mostrar os erros do email
    ToggleEmailErros(ErroEmailRequerido, EmailEmailInvalido) {
        const email = this.email.value;
        ErroEmailRequerido().style.display = email ? "none" : "block";
        EmailEmailInvalido().style.display = this.ValidarEmail(email) ? "none" : "block";
    }
    // Mostrar os erros da senha
    ToggleSenhaErros(ErroRequerimentoSenha) {
        const senha = this.senha.value;
        ErroRequerimentoSenha().style.display = senha ? "none" : "block";
    }
    // Ativar o botao de login
    ToggleButtonDisabled(RecuperarBotao, BotaoLogin) {
        const emailValid = this.EmailValido();
        RecuperarBotao().disabled = !emailValid;
        const senhaValid = this.SenhaValida();
        BotaoLogin().disabled = !emailValid || !senhaValid;
    }
    // Ativar o botão de registrar
    ToggleBotaoCadastroDisabled(BotaoCadastro) {
        BotaoCadastro().disabled = !this.FormValido();
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
        return this.ValidarEmail(email);
    }
    // Se o formulario é válido
    FormValido() {
        const email = this.email.value;
        if (!email || !this.ValidarEmail(email)) {
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
    ValidarEmail(email) {
        return /\S+@\S+\.\S+/.test(email);
    }
}
