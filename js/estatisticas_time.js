// Importa a classe 'Graficos' do arquivo de classe de gráficos
import { Graficos } from './classes/graficos_class'

// Calcula o total de passes combinando os passes do líbero e os passes de outras posições
const totalPasses = passesLibero.map((num, index) => num + passesOutrasPosicoes[index]);

// Calcula o total de saques combinando os saques do levantador e os saques de outras posições
const totalSaques = saquesLevantador.map((num, index) => num + saquesOutrasPosicoes[index]);

const ataquesTotal = ataquesLevantador.map((num, index) => num + ataquesOutrasPosicoes[index]);

// Configuração dos dados para construção de diferentes tipos de gráficos
const dadosConstrução = [
    // Dados para gráfico de passes do líbero
    [
        passesLibero,                        // Dados de passes do líbero
        ['Passe A', 'Passe B', 'Passe C', 'Passe D'], // Etiquetas dos tipos de passes
        'passe',                              // Tipo do gráfico
        [
            'rgb(0, 37, 228)',  // Cor para o Passe A
            'rgb(2, 183, 86)',  // Cor para o Passe B
            'rgb(230, 197, 1)', // Cor para o Passe C
            'rgb(242, 92, 5)'   // Cor para o Passe D
        ],
        'grafico_passe_libero_local',         // ID do local do gráfico
        'grafico_passe_libero'                // Nome do gráfico
    ],
    // Dados para gráfico de passes de outras posições
    [
        passesOutrasPosicoes,                 // Dados de passes de outras posições
        ['Passe A', 'Passe B', 'Passe C', 'Passe D'],
        'passe',
        [
            'rgb(0, 37, 228)',
            'rgb(2, 183, 86)',
            'rgb(230, 197, 1)',
            'rgb(242, 92, 5)'
        ],
        'grafico_passe_outras_local',
        'grafico_passe_outras_posicoes'
    ],
    // Dados para gráfico total de passes (líbero e outras posições)
    [
        totalPasses,
        ['Passe A', 'Passe B', 'Passe C', 'Passe D'],
        'passe',
        [
            'rgb(0, 37, 228)',
            'rgb(2, 183, 86)',
            'rgb(230, 197, 1)',
            'rgb(242, 92, 5)'
        ],
        'grafico_passe_total_local',
        'grafico_passe_total_posicoes'
    ],
    // Dados para gráfico de defesas
    [
        defesas,                               // Dados de defesas (acertos e erros)
        ['Acerto', 'Erro'],                    // Etiquetas para defesa
        'Defesa',                              // Tipo do gráfico
        [
            'rgb(0, 37, 228)',                 // Cor para acertos
            'rgb(2, 183, 86)'                  // Cor para erros
        ],
        'grafico_defesa_local',
        'grafico_defesa'
    ],
    // Dados para gráfico de saques (dentro e fora) de outras posições
    [
        [saquesOutrasPosicoes.slice(0, 4).reduce((acc, valorAtual) => acc + valorAtual, 0), saquesOutrasPosicoes[4]], // Soma dos saques dentro e fora
        ['Dentro', 'Fora'],                    // Etiquetas para saques dentro e fora
        'saques',
        [
            'rgb(0, 37, 228)',                 // Cor para saques dentro
            'rgb(2, 183, 86)'                  // Cor para saques fora
        ],
        'grafico_erros_saques_outras_posicoes_local',
        'grafico_erros_saques_outras_posicoes'
    ],
    // Dados para gráfico de saques (dentro e fora) do levantador
    [
        [saquesLevantador.slice(0, 4).reduce((acc, valorAtual) => acc + valorAtual, 0), saquesLevantador[4]],
        ['Dentro', 'Fora'],
        'saques',
        [
            'rgb(0, 37, 228)',
            'rgb(2, 183, 86)'
        ],
        'grafico_erros_saques_levantadores_local',
        'grafico_erros_saques_levantadores'
    ],
    // Dados para tipos de saques de outras posições
    [
        saquesOutrasPosicoes.slice(0, 4),      // Dados para tipos de saques específicos
        ['Ace', 'Por cima', 'Flutuante', 'Viagem'], // Etiquetas dos tipos de saques
        'saques',
        [
            'rgb(0, 37, 228)',                 // Cor para saques Ace
            'rgb(2, 183, 86)',                 // Cor para saques por cima
            'rgb(230, 197, 1)',                // Cor para saques flutuante
            'rgb(242, 92, 5)'                  // Cor para saques viagem
        ],
        'grafico_tipos_saques_outras_posicoes_local',
        'grafico_tipos_saques_outras_posicoes'
    ],
    // Dados para tipos de saques do levantador
    [
        saquesLevantador.slice(0, 4),
        ['Ace', 'Por cima', 'Flutuante', 'Viagem'],
        'saques',
        [
            'rgb(0, 37, 228)',
            'rgb(2, 183, 86)',
            'rgb(230, 197, 1)',
            'rgb(242, 92, 5)'
        ],
        'grafico_tipos_saques_levantadores_local',
        'grafico_tipos_saques_levantadores'
    ],
    // Dados para gráfico total de saques (dentro e fora)
    [
        [totalSaques.slice(0, 4).reduce((acc, valorAtual) => acc + valorAtual, 0), totalSaques[4]],
        ['Dentro', 'Fora'],
        'saques',
        [
            'rgb(0, 37, 228)',
            'rgb(2, 183, 86)'
        ],
        'grafico_erros_saques_total_local',
        'grafico_erros_saques_total'
    ],
    // Dados para tipos de saques totais
    [
        totalSaques.slice(0, 4),
        ['Ace', 'Por cima', 'Flutuante', 'Viagem'],
        'saques',
        [
            'rgb(0, 37, 228)',
            'rgb(2, 183, 86)',
            'rgb(230, 197, 1)',
            'rgb(242, 92, 5)'
        ],
        'grafico_tipos_saques_total_local',
        'grafico_tipos_saques_total'
    ],
    [
        ataquesLevantador,
        ['Acerto', 'Erro'],
        'Ataque',
        [
            'rgb(0, 37, 228)',
            'rgb(2, 183, 86)'
        ],
        'grafico_ataque_levantador_local',
        'grafico_ataque_levantador'
    ],
    [
        ataquesOutrasPosicoes,
        ['Acerto', 'Erro'],
        'Ataque',
        [
            'rgb(0, 37, 228)',
            'rgb(2, 183, 86)'
        ],
        'grafico_ataque_outras_posicoes_local',
        'grafico_ataque_outras_posicoes'
    ],
    [
        ataquesTotal,
        ['Acerto', 'Erro'],
        'Ataque',
        [
            'rgb(0, 37, 228)',
            'rgb(2, 183, 86)'
        ],
        'grafico_ataque_total_local',
        'grafico_ataque_total'
    ]
];

// Para cada conjunto de dados em 'dadosConstrução', chama a função de construção do gráfico
dadosConstrução.forEach(
    function (dados) {
        Graficos.FazerGrafico(dados[0], dados[1], dados[2], dados[3], dados[4], dados[5]); // Chama a função para criar o gráfico
    }
);
