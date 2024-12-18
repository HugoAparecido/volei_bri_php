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
    static FazerGraficoLinha(dados, labels, nomeValores, cores, idLocalGrafico, idGrafico) {
        var sum = 0;
        for (var i = 0; i < dados.length; i++) {
            sum += dados[i];
        }
        console.log(idLocalGrafico)
        //Criando o elemneto canva
        const canva = document.createElement('canvas');
        //Definindo o id do elemnto canva
        canva.id = `${idGrafico}`;
        //Pegando o local do gráfico
        let localGrafico = document.getElementById(`${idLocalGrafico}`);
        localGrafico.appendChild(canva);
        // pegando o id do gráfico
        const ctx = document.getElementById(`${idGrafico}`);
        console.log(dados)
        if (sum != 0) {
            var dataset = [];
            dados.forEach((element, indice) => {
                console.log(element)
                dataset.push({
                    label: nomeValores[indice],
                    data: element,
                    fill: false,
                    borderColor: cores[indice],
                    tension: 0.1
                })
            });
            const data = {
                labels: labels,
                datasets: dataset
            };
            // configurando o gráfico
            const config = {
                // tipo área polar
                type: 'line',
                // os valores citados acima
                data: data,
                options: { responsive: true }
            }
            // função de criação do gráfico (local, confuguração)
            new Chart(ctx, config);
        }
    }
}