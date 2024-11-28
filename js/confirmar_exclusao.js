function confirmarExclusão(link) {
    const resposta = confirm("Você tem certeza que deseja deletar?");
    if (resposta) {
        window.location.href = link;
    }
}