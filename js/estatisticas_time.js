// Importa a classe 'Graficos' do arquivo de classe de gráficos
import { Graficos } from './classes/graficos_class'

// Calcula o total de passes combinando os passes do líbero e os passes de outras posições
const totalPasses = passesLibero.map((num, index) => num + passesOutrasPosicoes[index]);

// Calcula o total de saques combinando os saques do levantador e os saques de outras posições
const totalSaques = saquesLevantador.map((num, index) => num + saquesOutrasPosicoes[index]);

const ataquesTotal = ataquesLevantador.map((num, index) => num + ataquesOutrasPosicoes[index]);
const bloqueiosTotal = bloqueiosLevantador.map((num, index) => num + bloqueiosOutrasPosicoes[index]);

const errosAcertosCor = ['rgb(2, 183, 86)', 'rgba(255, 99, 132)'];
const coresTipos = [
    'rgb(0, 37, 228)',
    'rgb(2, 183, 86)',
    'rgb(230, 197, 1)',
    'rgb(242, 92, 5)'
];

// Configuração dos dados para construção de diferentes tipos de gráficos
const dadosConstrucao = [
    // Dados para gráfico de passes do líbero
    [
        passesLibero,                        // Dados de passes do líbero
        ['Passe A', 'Passe B', 'Passe C', 'Passe D'], // Etiquetas dos tipos de passes
        'passe',                              // Tipo do gráfico
        coresTipos,
        'grafico_passe_libero_local',         // ID do local do gráfico
        'grafico_passe_libero'                // Nome do gráfico
    ],
    // Dados para gráfico de passes de outras posições
    [
        passesOutrasPosicoes,                 // Dados de passes de outras posições
        ['Passe A', 'Passe B', 'Passe C', 'Passe D'],
        'passe',
        coresTipos,
        'grafico_passe_outras_local',
        'grafico_passe_outras_posicoes'
    ],
    // Dados para gráfico total de passes (líbero e outras posições)
    [
        totalPasses,
        ['Passe A', 'Passe B', 'Passe C', 'Passe D'],
        'passe',
        coresTipos,
        'grafico_passe_total_local',
        'grafico_passe_total_posicoes'
    ],
    // Dados para gráfico de defesas
    [
        defesas,                               // Dados de defesas (acertos e erros)
        ['Acerto', 'Erro'],                    // Etiquetas para defesa
        'Defesa',                              // Tipo do gráfico
        errosAcertosCor,
        'grafico_defesa_local',
        'grafico_defesa'
    ],
    // Dados para gráfico de saques (dentro e fora) de outras posições
    [
        [saquesOutrasPosicoes.slice(0, 4).reduce((acc, valorAtual) => acc + valorAtual, 0), saquesOutrasPosicoes[4]], // Soma dos saques dentro e fora
        ['Dentro', 'Fora'],                    // Etiquetas para saques dentro e fora
        'saques',
        errosAcertosCor,
        'grafico_erros_saques_outras_posicoes_local',
        'grafico_erros_saques_outras_posicoes'
    ],
    // Dados para gráfico de saques (dentro e fora) do levantador
    [
        [saquesLevantador.slice(0, 4).reduce((acc, valorAtual) => acc + valorAtual, 0), saquesLevantador[4]],
        ['Dentro', 'Fora'],
        'saques',
        errosAcertosCor,
        'grafico_erros_saques_levantadores_local',
        'grafico_erros_saques_levantadores'
    ],
    // Dados para tipos de saques de outras posições
    [
        saquesOutrasPosicoes.slice(0, 4),      // Dados para tipos de saques específicos
        ['Ace', 'Viagem', 'Flutuante', 'Por cima'], // Etiquetas dos tipos de saques
        'saques',
        coresTipos,
        'grafico_tipos_saques_outras_posicoes_local',
        'grafico_tipos_saques_outras_posicoes'
    ],
    // Dados para tipos de saques do levantador
    [
        saquesLevantador.slice(0, 4),
        ['Ace', 'Viagem', 'Flutuante', 'Por cima'],
        'saques',
        coresTipos,
        'grafico_tipos_saques_levantadores_local',
        'grafico_tipos_saques_levantadores'
    ],
    // Dados para gráfico total de saques (dentro e fora)
    [
        [totalSaques.slice(0, 4).reduce((acc, valorAtual) => acc + valorAtual, 0), totalSaques[4]],
        ['Dentro', 'Fora'],
        'saques',
        errosAcertosCor,
        'grafico_erros_saques_total_local',
        'grafico_erros_saques_total'
    ],
    // Dados para tipos de saques totais
    [
        totalSaques.slice(0, 4),
        ['Ace', 'Viagem', 'Flutuante', 'Por cima'],
        'saques',
        coresTipos,
        'grafico_tipos_saques_total_local',
        'grafico_tipos_saques_total'
    ],
    [
        ataquesLevantador,
        ['Acerto', 'Erro'],
        'Ataque',
        errosAcertosCor,
        'grafico_ataque_levantador_local',
        'grafico_ataque_levantador'
    ],
    [
        ataquesOutrasPosicoes,
        ['Acerto', 'Erro'],
        'Ataque',
        errosAcertosCor,
        'grafico_ataque_outras_posicoes_local',
        'grafico_ataque_outras_posicoes'
    ],
    [
        ataquesTotal,
        ['Acerto', 'Erro'],
        'Ataque',
        errosAcertosCor,
        'grafico_ataque_total_local',
        'grafico_ataque_total'
    ],
    [
        bloqueiosLevantador,
        ['Acerto', 'Erro'],
        'Bloqueios',
        errosAcertosCor,
        'grafico_bloqueio_levantador_local',
        'grafico_bloqueio_levantador'
    ],
    [
        bloqueiosOutrasPosicoes,
        ['Acerto', 'Erro'],
        'Bloqueios',
        errosAcertosCor,
        'grafico_bloqueio_outras_posicoes_local',
        'grafico_bloqueio_outras_posicoes'
    ],
    [
        bloqueiosTotal,
        ['Acerto', 'Erro'],
        'Bloqueios',
        errosAcertosCor,
        'grafico_bloqueio_total_local',
        'grafico_bloqueio_total'
    ],
    // Dados para tipos de levantamentos do levantador
    [
        levantamentos.slice(0, 4),
        ['Centro', 'Oposto', 'Pipe', 'Ponta'],
        'saques',
        coresTipos,
        'grafico_tipos_levantamento_local',
        'grafico_tipos_levantamento'
    ],
    // Dados para gráfico de levantamentos (acertos e erros) do levantador
    [
        [levantamentos.slice(0, 4).reduce((acc, valorAtual) => acc + valorAtual, 0), levantamentos[4]],
        ['Acertou', 'Errou'],
        'saques',
        errosAcertosCor,
        'grafico_erros_levantamento_local',
        'grafico_erros_levantamento'
    ]
];

// Para cada conjunto de dados em 'dadosConstrucao', chama a função de construção do gráfico
dadosConstrucao.forEach(
    function (dados) {
        Graficos.FazerGrafico(dados[0], dados[1], dados[2], dados[3], dados[4], dados[5]); // Chama a função para criar o gráfico
    }
);
var errosCompeticao = [[defesasCompeticoes, 'relacao_defesas_competicoes_local'], [bloqueiosCompeticoes, 'relacao_bloqueios_competicoes_local'], [ataquesCompeticoes, 'relacao_ataques_competicoes_local'], [levantamentosCompeticoes, 'relacao_levantamentos_competicoes_local'], [saquesCompeticoes, 'relacao_saques_competicoes_local']]
errosCompeticao.forEach(movimento => {
    Graficos.FazerGraficoLinha(movimento[0], competicoes, ['acerto', 'erro'], errosAcertosCor, movimento[1], movimento[1].replace('_local', ''));
})
var tiposCompeticao = [[saquesTiposCompeticoes, 'relacao_saques_tipos_competicoes_local', ['saque ace', 'saque viagem', 'saque flutuante', 'saque por cima', 'erros']], [levantamentosTiposCompeticoes, 'relacao_levantamentos_tipos_competicoes_local', ['para pipe', 'para oposto', 'para ponta', 'para central', 'erros']]]
tiposCompeticao.forEach(movimento => {
    Graficos.FazerGraficoLinha(movimento[0], competicoes, movimento[2], ['rgb(0, 37, 228)',
        'rgb(2, 183, 86)',
        'rgb(230, 197, 1)',
        'rgb(242, 92, 5)', 'rgba(255, 99, 132)'], movimento[1], movimento[1].replace('_local', ''));
})