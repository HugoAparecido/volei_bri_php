<main>
    <div class="container">
        <div class="login-form">
            <h2>Login</h2>
            <div class="mb-3 container">
                <label class="form-label" for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="seu@email.com">
                <div class="error" id="email-required-error">Email é obrigatório</div>
                <div class="error" id="email-invalid-error">Email é inválido</div>
            </div>
            <div class="mb-3 container">
                <div><label class="form-label" for="password">Senha</label></div>
                <input class="form-control" type="password" name="password" id="password" placeholder="Senha">
                <div class="error" id="password-required-error">Senha é obrigatória</div>
            </div>
            <div>
                <button type="button" class="btn" id="recover-password-button" disabled="true" style="background-color: #FDDE5C;">Recuperar
                    senha</button>
            </div>
            <div>
                <button type="button" class=" btn" id="login-button" disabled="true" style="background-color: #FDDE5C; margin-top: 15px;">Entrar</button>
            </div>
        </div>
    </div>
</main>