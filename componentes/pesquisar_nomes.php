<?php
// Inclui o arquivo da classe Time
require_once './classes/time_class.php';

// Captura o valor do parâmetro 'nome' enviado via GET, aplicando um filtro padrão
$nome = filter_input(INPUT_GET, 'nome', FILTER_DEFAULT);

// Verifica se o parâmetro 'nome' não está vazio
if (!empty($nome)) {
    // Busca times no banco de dados usando uma consulta FULLTEXT no campo 'nome_time'
    // Ordena os resultados por 'data_hora_criacao' em ordem decrescente e limita a 10 resultados
    $times = Time::GetTimes(
        "MATCH(nome_time) AGAINST ('$nome' IN NATURAL LANGUAGE MODE)",
        'data_hora_criacao DESC',
        '10',
        'id_time, nome_time'
    );

    // Verifica se foram encontrados times
    if (count($times) > 0) {
        // Itera sobre os resultados e cria um array com as informações relevantes de cada time
        foreach ($times as $time) {
            $dados[] = [
                "id" => $time->GetID(), // ID do time
                "nome" => $time->GetNome() // Nome do time
            ];
        }

        // Cria a resposta com status de sucesso e os dados dos times encontrados
        $retorna = ['status' => true, 'dados' => $dados];
    } else {
        // Caso nenhum time seja encontrado, retorna uma mensagem de erro
        $retorna = ['status' => false, 'msg' => "Erro: Nenhum nome encontrado!"];
    }
} else {
    // Caso o parâmetro 'nome' esteja vazio, retorna uma mensagem de erro
    $retorna = ['status' => false, 'msg' => "Erro: Nenhum nome encontrado!"];
}

// Converte o array de resposta em formato JSON e o imprime
echo json_encode($retorna);