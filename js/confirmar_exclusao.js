function confirmarExclusão(link, mensagem) {
    const resposta = confirm(mensagem);
    if (resposta) {
        window.location.href = link;
    }
}