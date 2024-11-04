async function CarregarNomes(valor) {
    if (valor.length >= 3) {
        const dados = await fetch('../componentes/pesquisar_nomes.php?nome=' + valor);
        const resposta = await dados.json();
        console.log(resposta);
        var resultado = "<ul class='list-group position-fixed'>";
        if (resposta['status']) {
            for (i = 0; i < resposta['dados'].length; i++) {
                resultado += "<li class='list-group-item list-group-item-action' onclick='ListarNome(" + JSON.stringify(resposta['dados'][i].nome) + ")'>" + resposta['dados'][i].nome + "</li>";
            }
        } else {
            resultado = "<li class='list-group-item disabled'>" + resposta['msg'] + "</li>";
        }
        resultado += "</ul>";
        document.getElementById("resultado_pesquisa").innerHTML = resultado;
    }
}
const fechar = document.getElementById('produto');
document.addEventListener('click', function (event) {
    const validar_clique = fechar.contains(event.target);
    if (!validar_clique) {
        document.getElementById('resultado_pesquisa').innerHTML = '';
    }
})
async function ListarNome(nome) {
    console.log(nome);
    document.getElementById("produto").value = nome;
    const dados = await fetch('../componentes/listar_nomes.php?nome=' + nome);
    const resposta = await dados.json();
    var nomeEscolhido = '';
    if (resposta['status']) {
        for (i = 0; i < resposta['dados'].length; i++) {
            nomeEscolhido += "<a href='./estatisticas.php?id_time=" + resposta['dados'][i]['id'] + "'>" + resposta['dados'][i]['nome'] + "</a><br><br>";
        }
    } else {
        nomeEscolhido += "<div class='alert alert-danger' role='alert'>" + resposta['msg'] + "</div>";
    }
    document.getElementById('listar_nomes').innerHTML = nomeEscolhido;
}
const PesqNomeForm = document.getElementById('pesq-produto-form');
PesqNomeForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const nome = document.getElementById("produto").value
    ListarNome(nome);
})