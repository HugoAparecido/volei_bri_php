// Importa a classe 'Graficos' do arquivo de classe de gráficos
import { Graficos } from './classes/graficos_class';

var dadosConstrucao = [];
if (typeof outras !== 'undefined') {
    dadosConstrucao.push([
        outras.passes,                        // Dados de passes do líbero
        ['Passe A', 'Passe B', 'Passe C', 'Passe D'], // Etiquetas dos tipos de passes
        'passe',                              // Tipo do gráfico
        [
            'rgb(0, 37, 228)',  // Cor para o Passe A
            'rgb(2, 183, 86)',  // Cor para o Passe B
            'rgb(230, 197, 1)', // Cor para o Passe C
            'rgb(242, 92, 5)'   // Cor para o Passe D
        ],
        'grafico_passe_outras_local',         // ID do local do gráfico
        'grafico_passe_outras'
    ])
    dadosConstrucao.push([
        outras.ataques,
        ['Acerto', 'Erro'],
        'Ataque',
        [
            'rgb(0, 37, 228)',
            'rgb(2, 183, 86)'
        ],
        'grafico_ataque_outras_local',
        'grafico_ataque_outras'
    ])
    dadosConstrucao.push([
        outras.defesas,                               // Dados de defesas (acertos e erros)
        ['Acerto', 'Erro'],                    // Etiquetas para defesa
        'Defesa',                              // Tipo do gráfico
        [
            'rgb(0, 37, 228)',                 // Cor para acertos
            'rgb(2, 183, 86)'                  // Cor para erros
        ],
        'grafico_defesa_local',
        'grafico_defesa'
    ])
    dadosConstrucao.push([
        [outras.saques.slice(0, 4).reduce((acc, valorAtual) => acc + valorAtual, 0), outras.saques[4]], // Soma dos saques dentro e fora
        ['Dentro', 'Fora'],                    // Etiquetas para saques dentro e fora
        'saques',
        [
            'rgb(0, 37, 228)',                 // Cor para saques dentro
            'rgb(2, 183, 86)'                  // Cor para saques fora
        ],
        'grafico_erros_saques_outras_local',
        'grafico_erros_saques_outras'
    ])
    dadosConstrucao.push([
        outras.saques.slice(0, 4),
        ['Ace', 'Viagem', 'Flutuante', 'Por cima'],
        'saques',
        [
            'rgb(0, 37, 228)',
            'rgb(2, 183, 86)',
            'rgb(230, 197, 1)',
            'rgb(242, 92, 5)'
        ],
        'grafico_tipos_saques_outras_local',
        'grafico_tipos_saques_outras'
    ])
    dadosConstrucao.push([
        outras.bloqueios,
        ['Acerto', 'Erro'],
        'Bloqueios',
        [
            'rgb(0, 37, 228)',
            'rgb(2, 183, 86)'
        ],
        'grafico_bloqueio_outras_local',
        'grafico_bloqueio_outras'])
}

if (typeof levantador !== 'undefined') {
    dadosConstrucao.push([
        levantador.ataques,
        ['Acerto', 'Erro'],
        'Ataque',
        [
            'rgb(0, 37, 228)',
            'rgb(2, 183, 86)'
        ],
        'grafico_ataque_levantador_local',
        'grafico_ataque_levantador'
    ])
    dadosConstrucao.push([
        levantador.defesas,                    // Dados de defesas (acertos e erros)
        ['Acerto', 'Erro'],                    // Etiquetas para defesa
        'Defesa',                              // Tipo do gráfico
        [
            'rgb(0, 37, 228)',                 // Cor para acertos
            'rgb(2, 183, 86)'                  // Cor para erros
        ],
        'grafico_defesa_local',
        'grafico_defesa'
    ])
    dadosConstrucao.push([
        [levantador.saques.slice(0, 4).reduce((acc, valorAtual) => acc + valorAtual, 0), levantador.saques[4]], // Soma dos saques dentro e fora
        ['Dentro', 'Fora'],                    // Etiquetas para saques dentro e fora
        'saques',
        [
            'rgb(0, 37, 228)',                 // Cor para saques dentro
            'rgb(2, 183, 86)'                  // Cor para saques fora
        ],
        'grafico_erros_saques_levantador_local',
        'grafico_erros_saques_levantador'
    ])
    dadosConstrucao.push([
        levantador.saques.slice(0, 4),
        ['Ace', 'Viagem', 'Flutuante', 'Por cima'],
        'saques',
        [
            'rgb(0, 37, 228)',
            'rgb(2, 183, 86)',
            'rgb(230, 197, 1)',
            'rgb(242, 92, 5)'
        ],
        'grafico_tipos_saques_levantadores_local',
        'grafico_tipos_saques_levantadores'
    ])
    dadosConstrucao.push([
        levantador.bloqueios,
        ['Acerto', 'Erro'],
        'Bloqueios',
        [
            'rgb(0, 37, 228)',
            'rgb(2, 183, 86)'
        ],
        'grafico_bloqueio_levantador_local',
        'grafico_bloqueio_levantador'])
    dadosConstrucao.push(
        // Dados para gráfico de levantamentos (acertos e erros) do levantador
        [
            [levantador.levantamentos.slice(0, 4).reduce((acc, valorAtual) => acc + valorAtual, 0), levantador.levantamentos[4]],
            ['Acertou', 'Errou'],
            'saques',
            [
                'rgb(0, 37, 228)',
                'rgb(2, 183, 86)'
            ],
            'grafico_erros_levantamento_local',
            'grafico_erros_levantamento'
        ]
    )
}
if (typeof libero !== 'undefined') {
    dadosConstrucao.push(
        [
            libero.defesas,         // Dados de defesas (acertos e erros)
            ['Acerto', 'Erro'],     // Etiquetas para defesa
            'Defesa',               // Tipo do gráfico
            [
                'rgb(0, 37, 228)',  // Cor para acertos
                'rgb(2, 183, 86)'   // Cor para erros
            ],
            'grafico_defesa_local',
            'grafico_defesa'
        ],
    )
    dadosConstrucao.push([
        libero.passes,                        // Dados de passes do líbero
        ['Passe A', 'Passe B', 'Passe C', 'Passe D'], // Etiquetas dos tipos de passes
        'passe',                              // Tipo do gráfico
        [
            'rgb(0, 37, 228)',  // Cor para o Passe A
            'rgb(2, 183, 86)',  // Cor para o Passe B
            'rgb(230, 197, 1)', // Cor para o Passe C
            'rgb(242, 92, 5)'   // Cor para o Passe D
        ],
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