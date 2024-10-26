import { Graficos } from './classes/graficos_class'
function GraficoPasse(dados, idGrafico, localGrafico) {
    Graficos.FazerGrafico(dados, ['Passe A', 'Passe B', 'Passe C', 'Passe D'], 'passe', [
        'rgb(0, 37, 228)',
        'rgb(2, 183, 86)',
        'rgb(230, 197, 1)',
        'rgb(242, 92, 5)',
    ], localGrafico, idGrafico);
}
// const resultadoPasses = passesLibero.map((num, index) => num + passesOutrasPosicoes[index]);
// GraficoPasse(passesLibero, 'grafico_passe_libero', 'grafico_passe_libero_local')
// GraficoPasse(passesOutrasPosicoes, 'grafico_passe_outras_posicoes', 'grafico_passe_outras_local')
// GraficoPasse(resultadoPasses, 'grafico_passe_total_posicoes', 'grafico_passe_total_local')
function GraficoDefesa(dados) {
    Graficos.FazerGrafico(dados, ['Acerto', 'Erro'], 'Defesa', [
        'rgb(0, 37, 228)',
        'rgb(2, 183, 86)',
    ], 'grafico_defesa_local', 'grafico_defesa')
}
GraficoDefesa(defesas)

function GraficoTiposSaque(dados, idGrafico, localGrafico) {
    Graficos.FazerGrafico(dados, ['Ace', 'Por cima', 'Flutuante', 'Viagem'], 'sques', [
        'rgb(0, 37, 228)',
        'rgb(2, 183, 86)',
        'rgb(230, 197, 1)',
        'rgb(242, 92, 5)',
        'rgb(200, 08, 5)',
    ], localGrafico, idGrafico);
}

function GraficoAcertoSaque(dados, idGrafico, localGrafico) {
    Graficos.FazerGrafico(dados, ['Dentro', 'Fora'], 'sques', [
        'rgb(0, 37, 228)',
        'rgb(2, 183, 86)'
    ], localGrafico, idGrafico);
}
// GraficoAcertoSaque([saquesOutrasPosicoes.slice(0, 4).reduce((acc, valorAtual) => acc + valorAtual, 0), saquesOutrasPosicoes[4]], 'grafico_erros_saques_outras_posicoes', 'grafico_erros_saques_outras_posicoes_local')
// GraficoTiposSaque(saquesOutrasPosicoes.slice(0, 4), 'grafico_tipos_saques_outras_posicoes', 'grafico_tipos_saques_outras_posicoes_local')
// GraficoAcertoSaque([saquesLevantador.slice(0, 4).reduce((acc, valorAtual) => acc + valorAtual, 0), saquesLevantador[4]], 'grafico_erros_saques_outras_posicoes', 'grafico_erros_saques_outras_posicoes_local')
// GraficoTiposSaque(saquesLevantador.slice(0, 4), 'grafico_tipos_saques_outras_posicoes', 'grafico_tipos_saques_outras_posicoes_local')