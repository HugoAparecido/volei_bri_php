import { Graficos } from './classes/graficos_class'
function GraficoPasse(dados) {
    Graficos.FazerGrafico(dados, ['Passe A', 'Passe B', 'Passe C', 'Passe D'], 'passe', [
        'rgb(0, 37, 228)',
        'rgb(2, 183, 86)',
        'rgb(230, 197, 1)',
        'rgb(242, 92, 5)',
    ], 'grafico_passe_local', 'grafico_passe')
}
GraficoPasse(passes)
function GraficoDefesa(dados) {
    Graficos.FazerGrafico(dados, ['Acerto', 'Erro'], 'Defesa', [
        'rgb(0, 37, 228)',
        'rgb(2, 183, 86)',
    ], 'grafico_defesa_local', 'grafico_defesa')
}
GraficoDefesa(defesas)