// Importa a classe 'Graficos' do arquivo de classe de gráficos
import { Graficos } from './classes/graficos_class'

// Função para gerar o gráfico de passes de um jogador ou grupo
function GraficoPasse(dados, idGrafico, localGrafico) {
    // Chama o método 'FazerGrafico' da classe 'Graficos' para criar um gráfico de passes
    // 'dados' contém os valores a serem exibidos, com rótulos de diferentes tipos de passe e cores específicas
    Graficos.FazerGrafico(dados, ['Passe A', 'Passe B', 'Passe C', 'Passe D'], 'passe', [
        'rgb(0, 37, 228)', // Cor para o Passe A
        'rgb(2, 183, 86)', // Cor para o Passe B
        'rgb(230, 197, 1)', // Cor para o Passe C
        'rgb(242, 92, 5)',  // Cor para o Passe D
    ], localGrafico, idGrafico);
}

// Combina dados de passes do líbero e outras posições em uma única lista 'resultadoPasses'
const resultadoPasses = passesLibero.map((num, index) => num + passesOutrasPosicoes[index]);

// Gera gráficos específicos de passes para o líbero, outras posições e o total combinado
GraficoPasse(passesLibero, 'grafico_passe_libero', 'grafico_passe_libero_local')
GraficoPasse(passesOutrasPosicoes, 'grafico_passe_outras_posicoes', 'grafico_passe_outras_local')
GraficoPasse(resultadoPasses, 'grafico_passe_total_posicoes', 'grafico_passe_total_local')

// Função para gerar o gráfico de defesas (acertos e erros)
function GraficoDefesa(dados) {
    // Chama o método 'FazerGrafico' para gerar um gráfico de defesas
    // 'dados' contém valores de acertos e erros, com rótulos e cores correspondentes
    Graficos.FazerGrafico(dados, ['Acerto', 'Erro'], 'Defesa', [
        'rgb(0, 37, 228)', // Cor para acertos
        'rgb(2, 183, 86)', // Cor para erros
    ], 'grafico_defesa_local', 'grafico_defesa');
}

// Gera o gráfico de defesas com os dados fornecidos em 'defesas'
GraficoDefesa(defesas)

// Função para gerar gráficos de diferentes tipos de saques
function GraficoTiposSaque(dados, idGrafico, localGrafico) {
    // Chama o método 'FazerGrafico' para criar um gráfico dos tipos de saque
    // 'dados' contém valores de saques, rótulos para cada tipo e cores específicas
    Graficos.FazerGrafico(dados, ['Ace', 'Por cima', 'Flutuante', 'Viagem'], 'sques', [
        'rgb(0, 37, 228)', // Cor para saques Ace
        'rgb(2, 183, 86)', // Cor para saques por cima
        'rgb(230, 197, 1)', // Cor para saques flutuante
        'rgb(242, 92, 5)',  // Cor para saques viagem
        'rgb(200, 08, 5)',  // Cor adicional para saques
    ], localGrafico, idGrafico);
}

// Função para gerar gráficos de acertos e erros de saque
function GraficoAcertoSaque(dados, idGrafico, localGrafico) {
    // Chama o método 'FazerGrafico' para criar um gráfico de acertos e erros de saque
    // 'dados' contém valores para saques dentro e fora, com rótulos e cores
    Graficos.FazerGrafico(dados, ['Dentro', 'Fora'], 'sques', [
        'rgb(0, 37, 228)', // Cor para saques dentro
        'rgb(2, 183, 86)'  // Cor para saques fora
    ], localGrafico, idGrafico);
}

// Gera gráfico de acertos e erros para saques das outras posições
GraficoAcertoSaque(
    [saquesOutrasPosicoes.slice(0, 4).reduce((acc, valorAtual) => acc + valorAtual, 0), saquesOutrasPosicoes[4]],
    'grafico_erros_saques_outras_posicoes',
    'grafico_erros_saques_outras_posicoes_local'
);

// Gera gráfico dos tipos de saque das outras posições
GraficoTiposSaque(
    saquesOutrasPosicoes.slice(0, 4),
    'grafico_tipos_saques_outras_posicoes',
    'grafico_tipos_saques_outras_posicoes_local'
);

// Gera gráfico de acertos e erros para saques do levantador
GraficoAcertoSaque(
    [saquesLevantador.slice(0, 4).reduce((acc, valorAtual) => acc + valorAtual, 0), saquesLevantador[4]],
    'grafico_erros_saques_levantadores',
    'grafico_erros_saques_levantadores_local'
);

// Gera gráfico dos tipos de saque do levantador
GraficoTiposSaque(
    saquesLevantador.slice(0, 4),
    'grafico_tipos_saques_levantadores',
    'grafico_tipos_saques_levantadores_local'
);
