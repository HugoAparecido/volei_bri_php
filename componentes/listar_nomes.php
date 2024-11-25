<?php
// Inclui o arquivo da classe Time.
require_once './classes/time_class.php';

// Pega o parâmetro 'nome' enviado pelo GET.
$nome = filter_input(INPUT_GET, 'nome', FILTER_DEFAULT);

// Verifica se o nome não está vazio.
if (!empty($nome)) {
    // Busca times que correspondem ao nome fornecido, limitando a 10 resultados.
    $times = Time::GetTimes(
        "MATCH(nome_time) AGAINST ('$nome' IN NATURAL LANGUAGE MODE)",
        'data_hora_criacao DESC',
        '10',
        'id_time, nome_time'
    );

    // Se encontrar times, prepara os dados para resposta.
    if (count($times) > 0) {
        foreach ($times as $time) {
            $dados[] = [
                "id" => $time->GetID(),    // ID do time.
                "nome" => $time->GetNome() // Nome do time.
            ];
        }
        $retorna = ['status' => true, 'dados' => $dados];
    } else {
        // Se não encontrar, retorna mensagem de erro.
        $retorna = ['status' => false, 'msg' => "Erro: Nenhum nome encontrado!"];
    }
} else {
    // Se o nome não foi enviado, retorna mensagem de erro.
    $retorna = ['status' => false, 'msg' => "Erro: Nenhum nome encontrado!"];
}

// Retorna os dados em formato JSON.
echo json_encode($retorna);