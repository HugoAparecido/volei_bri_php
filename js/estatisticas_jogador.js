// Importa a classe 'Graficos' do arquivo de classe de gráficos
import { Graficos } from './classes/graficos_class';

const errosAcertosCor = ['rgb(2, 183, 86)', 'rgba(255, 99, 132)'];
const coresTipos = [
    'rgb(0, 37, 228)',
    'rgb(2, 183, 86)',
    'rgb(230, 197, 1)',
    'rgb(242, 92, 5)'
];
var dadosConstrucao = [];
if (typeof posicoes !== 'undefined') {
    console.log(posicoes)
    dadosConstrucao.push([
        posicoes[0].defesas,                               // Dados de defesas (acertos e erros)
        ['Acerto', 'Erro'],                    // Etiquetas para defesa
        'Defesa',                              // Tipo do gráfico
        errosAcertosCor,
        'grafico_defesa_local',
        'grafico_defesa'
    ])
    posicoes.forEach((posicao) => {
        console.log(posicao);
        posicao.posicao = posicao.posicao.replace(" ", "_");
        posicao.posicao = posicao.posicao.replace("ã", "a");
        posicao.posicao = posicao.posicao.replace("í", "i");
        dadosConstrucao.push([
            posicao.passes,                        // Dados de passes do líbero
            ['Passe A', 'Passe B', 'Passe C', 'Passe D'], // Etiquetas dos tipos de passes
            'passe',                              // Tipo do gráfico
            coresTipos,
            'grafico_passe_' + posicao.posicao + '_local',         // ID do local do gráfico
            'grafico_passe_' + posicao.posicao
        ])
        dadosConstrucao.push([
            posicao.ataques,
            ['Acerto', 'Erro'],
            'Ataque',
            errosAcertosCor,
            'grafico_ataque_' + posicao.posicao + '_local',
            'grafico_ataque_' + posicao.posicao
        ])
        dadosConstrucao.push([
            [posicao.saques.slice(0, 4).reduce((acc, valorAtual) => acc + valorAtual, 0), posicao.saques[4]], // Soma dos saques dentro e fora
            ['Dentro', 'Fora'],                    // Etiquetas para saques dentro e fora
            'saques',
            errosAcertosCor,
            'grafico_erros_saques_' + posicao.posicao + '_local',
            'grafico_erros_saques_' + posicao.posicao
        ])
        dadosConstrucao.push([
            posicao.saques.slice(0, 4),
            ['Ace', 'Viagem', 'Flutuante', 'Por cima'],
            'saques',
            coresTipos,
            'grafico_tipos_saques_' + posicao.posicao + '_local',
            'grafico_tipos_saques_' + posicao.posicao
        ])
        dadosConstrucao.push([
            posicao.bloqueios,
            ['Acerto', 'Erro'],
            'Bloqueios',
            errosAcertosCor,
            'grafico_bloqueio_' + posicao.posicao + '_local',
            'grafico_bloqueio_' + posicao.posicao])

    })
}

if (typeof levantador !== 'undefined') {
    dadosConstrucao.push([
        levantador.ataques,
        ['Acerto', 'Erro'],
        'Ataque',
        errosAcertosCor,
        'grafico_ataque_levantador_local',
        'grafico_ataque_levantador'
    ])
    dadosConstrucao.push([
        levantador.defesas,                    // Dados de defesas (acertos e erros)
        ['Acerto', 'Erro'],                    // Etiquetas para defesa
        'Defesa',                              // Tipo do gráfico
        errosAcertosCor,
        'grafico_defesa_local',
        'grafico_defesa'
    ])
    dadosConstrucao.push([
        [levantador.saques.slice(0, 4).reduce((acc, valorAtual) => acc + valorAtual, 0), levantador.saques[4]], // Soma dos saques dentro e fora
        ['Dentro', 'Fora'],                    // Etiquetas para saques dentro e fora
        'saques',
        errosAcertosCor,
        'grafico_erros_saques_levantador_local',
        'grafico_erros_saques_levantador'
    ])
    dadosConstrucao.push([
        levantador.saques.slice(0, 4),
        ['Ace', 'Viagem', 'Flutuante', 'Por cima'],
        'saques',
        coresTipos,
        'grafico_tipos_saques_levantadores_local',
        'grafico_tipos_saques_levantadores'
    ])
    dadosConstrucao.push([
        levantador.bloqueios,
        ['Acerto', 'Erro'],
        'Bloqueios',
        errosAcertosCor,
        'grafico_bloqueio_levantador_local',
        'grafico_bloqueio_levantador'])
    dadosConstrucao.push(
        // Dados para gráfico de levantamentos (acertos e erros) do levantador
        [
            [levantador.levantamentos.slice(0, 4).reduce((acc, valorAtual) => acc + valorAtual, 0), levantador.levantamentos[4]],
            ['Acertou', 'Errou'],
            'saques',
            errosAcertosCor,
            'grafico_erros_levantamento_local',
            'grafico_erros_levantamento'
        ]
    )
    dadosConstrucao.push(
        // Dados para tipos de levantamentos do levantador
        [
            levantador.levantamentos.slice(0, 4),
            ['Centro', 'Oposto', 'Pipe', 'Ponta'],
            'saques',
            coresTipos,
            'grafico_tipos_levantamento_local',
            'grafico_tipos_levantamento'
        ],)
}
if (typeof libero !== 'undefined') {
    dadosConstrucao.push(
        [
            libero.defesas,         // Dados de defesas (acertos e erros)
            ['Acerto', 'Erro'],     // Etiquetas para defesa
            'Defesa',               // Tipo do gráfico
            errosAcertosCor,
            'grafico_defesa_local',
            'grafico_defesa'
        ],
    )
    dadosConstrucao.push([
        libero.passes,                        // Dados de passes do líbero
        ['Passe A', 'Passe B', 'Passe C', 'Passe D'], // Etiquetas dos tipos de passes
        'passe',                              // Tipo do gráfico
        coresTipos,
        'grafico_passe_libero_local',         // ID do local do gráfico
        'grafico_passe_libero'
    ])
}
console.log(dadosConstrucao);
// Para cada conjunto de dados em 'dadosConstrucao', chama a função de construção do gráfico
dadosConstrucao.forEach(
    function (dados) {
        Graficos.FazerGrafico(dados[0], dados[1], dados[2], dados[3], dados[4], dados[5]); // Chama a função para criar o gráfico
    }
);