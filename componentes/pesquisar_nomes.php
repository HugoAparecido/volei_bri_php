<?php
require_once './classes/time_class.php';
$nome = filter_input(INPUT_GET, 'nome', FILTER_DEFAULT);
if (!empty($nome)) {
    $times = Time::GetTimes("MATCH(nome_time) AGAINST ('$nome' IN NATURAL LANGUAGE MODE)", 'data_hora_criacao DESC', '10', 'id_time, nome_time');
    if (count($times) > 0) {
        foreach ($times as $time) {
            $dados[] = [
                "id" => $time->GetID(),
                "nome" => $time->GetNome()
            ];
        }
        $retorna = ['status' => true, 'dados' => $dados];
    } else {
        $retorna = ['status' => false, 'msg' => "Erro: Nenhum nome encontrado!"];
    }
} else {
    $retorna = ['status' => false, 'msg' => "Erro: Nenhum nome encontrado!"];
}
echo json_encode($retorna);
