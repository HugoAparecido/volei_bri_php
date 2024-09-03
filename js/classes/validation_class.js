export class Validation {
    // Construtor da classe, recebe e inicializa os campos de email e senha
    constructor(email, senha) {
        this.email = email;
        this.senha = senha;
    }

    // Função para lidar com mudanças no campo de email
    OnChangeEmail(ErroEmailRequerido, EmailEmailInvalido, RecuperarBotao, BotaoLogin) {
        // Atualiza o estado dos botões com base na validade do email
        this.ToggleButtonDisabled(RecuperarBotao, BotaoLogin);
        // Atualiza a visibilidade dos erros de email
        this.ToggleEmailErros(ErroEmailRequerido, EmailEmailInvalido);
    }

    // Função para lidar com mudanças no campo de email durante o cadastro
    OnChangeEmailCadastro(ErroEmailRequerido, EmailEmailInvalido, BotaoCadastro) {
        const email = this.email.value;
        // Exibe ou oculta o erro de email requerido baseado na presença do valor
        ErroEmailRequerido().style.display = email ? "none" : "block";
        // Exibe ou oculta o erro de email inválido baseado na validação do email
        EmailEmailInvalido().style.display = this.ValidarEmail(email) ? "none" : "block";
        // Atualiza o estado do botão de cadastro com base na validade do email
        this.ToggleBotaoCadastroDisabled(BotaoCadastro);
    }

    // Função para lidar com mudanças no campo de senha
    OnChangeSenha(RecuperarBotao, BotaoLogin, ErroRequerimentoSenha) {
        // Atualiza o estado dos botões com base na validade da senha e email
        this.ToggleButtonDisabled(RecuperarBotao, BotaoLogin);
        // Atualiza a visibilidade do erro de senha requerido
        this.ToggleSenhaErros(ErroRequerimentoSenha);
    }

    // Função para lidar com mudanças no campo de senha durante o cadastro
    OnChangeSenhaCadastro(ErroRequerimentoSenha, senhaMinLenghtError, BotaoCadastro, confirmarSenhaForm, ConfirmarSenhaNaoCorrespondeErro) {
        const senha = this.senha.value;
        // Exibe ou oculta o erro de senha requerido baseado na presença do valor
        ErroRequerimentoSenha().style.display = senha ? "none" : "block";
        // Exibe ou oculta o erro de senha com menos de 6 caracteres
        senhaMinLenghtError().style.display = senha.length >= 6 ? "none" : "block";
        // Valida se a senha confirmada corresponde à senha original
        this.ValidarSenhaNaoCorresponde(confirmarSenhaForm, ConfirmarSenhaNaoCorrespondeErro);
        // Atualiza o estado do botão de cadastro com base na validade da senha e email
        this.ToggleBotaoCadastroDisabled(BotaoCadastro);
    }

    // Função para lidar com mudanças no campo de confirmação de senha
    OnChangeConfirmarSenha(confirmarSenha, ConfirmarSenhaNaoCorrespondeErro, BotaoCadastro) {
        // Valida se a senha confirmada corresponde à senha original
        this.ValidarSenhaNaoCorresponde(confirmarSenha, ConfirmarSenhaNaoCorrespondeErro);
        // Atualiza o estado do botão de cadastro com base na validade da confirmação de senha
        this.ToggleBotaoCadastroDisabled(BotaoCadastro);
    }

    // Valida se a senha confirmada corresponde à senha original
    ValidarSenhaNaoCorresponde(confirmarSenhaForm, ConfirmarSenhaNaoCorrespondeErro) {
        const senha = this.senha.value;
        const confirmarSenha = confirmarSenhaForm().value;
        // Exibe ou oculta o erro se as senhas não corresponderem
        ConfirmarSenhaNaoCorrespondeErro().style.display = senha == confirmarSenha ? "none" : "block";
    }

    // Atualiza a visibilidade dos erros de email
    ToggleEmailErros(ErroEmailRequerido, EmailEmailInvalido) {
        const email = this.email.value;
        // Exibe ou oculta o erro de email requerido baseado na presença do valor
        ErroEmailRequerido().style.display = email ? "none" : "block";
        // Exibe ou oculta o erro de email inválido baseado na validação do email
        EmailEmailInvalido().style.display = this.ValidarEmail(email) ? "none" : "block";
    }

    // Atualiza a visibilidade dos erros de senha
    ToggleSenhaErros(ErroRequerimentoSenha) {
        const senha = this.senha.value;
        // Exibe ou oculta o erro de senha requerido baseado na presença do valor
        ErroRequerimentoSenha().style.display = senha ? "none" : "block";
    }

    // Ativa ou desativa o botão de recuperação e o botão de login
    ToggleButtonDisabled(RecuperarBotao, BotaoLogin) {
        const emailValid = this.EmailValido();
        // Ativa ou desativa o botão de recuperação baseado na validade do email
        RecuperarBotao().disabled = !emailValid;
        const senhaValid = this.SenhaValida();
        // Ativa ou desativa o botão de login baseado na validade do email e da senha
        BotaoLogin().disabled = !emailValid || !senhaValid;
    }

    // Ativa ou desativa o botão de cadastro baseado na validade do formulário
    ToggleBotaoCadastroDisabled(BotaoCadastro) {
        BotaoCadastro().disabled = !this.FormValido();
    }

    // Verifica se a senha tem um valor não vazio
    SenhaValida() {
        const senha = this.senha.value;
        // A senha é válida se não estiver vazia
        return !!senha;
    }

    // Verifica se o email é válido e não está vazio
    EmailValido() {
        const email = this.email.value;
        // O email é válido se não estiver vazio e a validação do email passar
        return !!email && this.ValidarEmail(email);
    }

    // Verifica se o formulário é válido
    FormValido() {
        const email = this.email.value;
        const senha = this.senha.value;
        // O formulário é válido se o email não estiver vazio, for válido, e a senha não estiver vazia e tiver pelo menos 6 caracteres
        return !!email && this.ValidarEmail(email) && !!senha && senha.length >= 6;
    }

    // Valida o formato do email usando expressão regular
    ValidarEmail(email) {
        // Verifica se o email tem o formato correto
        return /\S+@\S+\.\S+/.test(email);
    }
}
