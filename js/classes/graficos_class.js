export class Graficos {
    static FazerGrafico(dados, legenda, nomeValores, cores, idLocalGrafico, idGrafico) {
        var sum = 0;
        for (var i = 0; i < dados.length; i++) {
            sum += dados[i];
        }
        //Criando o elemneto canva
        const canva = document.createElement('canvas');
        //Definindo o id do elemnto canva
        canva.id = `${idGrafico}`;
        //Pegando o local do gráfico
        let localGrafico = document.getElementById(`${idLocalGrafico}`);
        localGrafico.appendChild(canva);
        // pegando o id do gráfico
        const ctx = document.getElementById(`${idGrafico}`);
        if (sum != 0) {
            const data = {
                // escrita legenda
                labels: legenda,
                datasets: [
                    {
                        // nome dos valores
                        label: nomeValores,
                        // quantidade dos respectivos levanatmentos
                        data: dados,
                        backgroundColor: cores
                    }
                ]
            }
            // configurando o gráfico
            const config = {
                // tipo área polar
                type: 'pie',
                // os valores citados acima
                data: data,
                options: {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    const dataIndex = tooltipItem.dataIndex;
                                    const dataset = tooltipItem.chart.data.datasets[0];
                                    const currentValue = dataset.data[dataIndex];
                                    const total = dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((currentValue / total) * 100).toFixed(2);
                                    return currentValue + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }

            }
            // função de criação do gráfico (local, confuguração)
            new Chart(ctx, config);
        }
        // se não hover levantamento para apresentar, haverá uma mensagem no formato parágrafo
        else localGrafico.innerHTML += "<p>Não há dados disponíveis no momento</p>"
    }
    static FazerGraficoLinha(dados, labels, legenda, nomeValores, cores, idLocalGrafico, idGrafico) {
        var sum = 0;
        for (var i = 0; i < dados.length; i++) {
            sum += dados[i];
        }
        //Criando o elemneto canva
        const canva = document.createElement('canvas');
        //Definindo o id do elemnto canva
        canva.id = `${idGrafico}`;
        //Pegando o local do gráfico
        let localGrafico = document.getElementById(`${idLocalGrafico}`);
        localGrafico.appendChild(canva);
        // pegando o id do gráfico
        const ctx = document.getElementById(`${idGrafico}`);
        if (sum != 0) {
            const data = {
                labels: labels,
                datasets: [{
                    label: 'Acertos',
                    data: dados[0],
                    fill: false,
                    borderColor: cores[0],
                    tension: 0.1
                }, {
                    label: 'Erros',
                    data: dados[1],
                    fill: false,
                    borderColor: cores[1],
                    tension: 0.1
                }]
            };
            // configurando o gráfico
            const config = {
                // tipo área polar
                type: 'line',
                // os valores citados acima
                data: data
            }
            // função de criação do gráfico (local, confuguração)
            new Chart(ctx, config);
        }
    }
}