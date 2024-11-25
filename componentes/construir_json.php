<?php

// Inclui os arquivos de proteção de sessão e classes necessárias
include('../componentes/protect.php');
include('../componentes/classes/time_class.php');
include('../componentes/classes/libero_class.php');
include('../componentes/classes/levantador_class.php');
include('../componentes/classes/outras_posicoes_class.php');
include('../componentes/classes/componentes_class.php');
include('../componentes/classes/instituicao_class.php');

$times = Time::GetTimes();
$arrayTimes = ['times' => ['M' => [], 'F' => [], 'MIS' => []]];
$arrayJogadores = ['jogadores' => [
    'M' => ['libero' => [], 'levantador' => [], 'ponta1' => [], 'ponta2' => [], 'oposto' => [], 'central' => [], 'naodefinida' => []],
    'F' => ['libero' => [], 'levantador' => [], 'ponta1' => [], 'ponta2' => [], 'oposto' => [], 'central' => [], 'naodefinida' => []]
]];
$outrasPosicoes = OutrasPosicoes::JuntarTabelas('jogador', 'id_jogador', 'id_jogador');
$levantadores = Levantador::JuntarTabelas('jogador', 'id_jogador', 'id_jogador');
$liberos = Libero::JuntarTabelas('jogador', 'id_jogador', 'id_jogador');
$arrayCompeticoes = [];
$competicoes = Competicao::GetCompeticoes();
foreach ($times as $index => $time) {
    if ($time->GetSexo() === 'm')
        array_push($arrayTimes['times']['M'], [
            'id' => $time->GetID(),
            'nome' => $time->GetNome(),
            'criacao' => $time->GetData()
        ]);
    elseif ($time->GetSexo() === 'f')
        array_push($arrayTimes['times']['F'], [
            'id' => $time->GetID(),
            'nome' => $time->GetNome(),
            'criacao' => $time->GetData()
        ]);
    else
        array_push($arrayTimes['times']['MIS'], [
            'id' => $time->GetID(),
            'nome' => $time->GetNome(),
            'criacao' => $time->GetData()
        ]);
}
foreach ($liberos as $index => $libero) {
    if ($libero->GetSexo() === 'm')
        array_push($arrayJogadores['jogadores']['M']['libero'], [
            'id' => $libero->GetID(),
            'nome' => $libero->GetNome(),
            'numero' => $libero->GetNumeroCamisa()
        ]);
    else
        array_push($arrayJogadores['jogadores']['F']['libero'], [
            'id' => $libero->GetID(),
            'nome' => $libero->GetNome(),
            'numero' => $libero->GetNumeroCamisa()
        ]);
}
foreach ($levantadores as $index => $levantador) {
    if ($levantador->GetSexo() === 'm')
        array_push($arrayJogadores['jogadores']['M']['levantador'], [
            'id' => $levantador->GetID(),
            'nome' => $levantador->GetNome(),
            'numero' => $levantador->GetNumeroCamisa()
        ]);
    else
        array_push($arrayJogadores['jogadores']['F']['libero'], [
            'id' => $libero->GetID(),
            'nome' => $libero->GetNome(),
            'numero' => $libero->GetNumeroCamisa()
        ]);
}
foreach ($outrasPosicoes as $index => $posicao) {
    switch ($posicao->GetPosicao()) {
        case 'ponta 1':
            array_push($arrayJogadores['jogadores'][($posicao->GetSexo() == 'm' ? 'M' : 'F')]['ponta1'], [
                'id' => $posicao->GetID(),
                'nome' => $posicao->GetNome(),
                'numero' => $posicao->GetNumeroCamisa()
            ]);
            break;
        case 'ponta 2':
            array_push($arrayJogadores['jogadores'][($posicao->GetSexo() == 'm' ? 'M' : 'F')]['ponta2'], [
                'id' => $posicao->GetID(),
                'nome' => $posicao->GetNome(),
                'numero' => $posicao->GetNumeroCamisa()
            ]);
            break;
        case 'central':
            array_push($arrayJogadores['jogadores'][($posicao->GetSexo() == 'm' ? 'M' : 'F')]['central'], [
                'id' => $posicao->GetID(),
                'nome' => $posicao->GetNome(),
                'numero' => $posicao->GetNumeroCamisa()
            ]);
            break;
        case 'oposto':
            array_push($arrayJogadores['jogadores'][($posicao->GetSexo() == 'm' ? 'M' : 'F')]['oposto'], [
                'id' => $posicao->GetID(),
                'nome' => $posicao->GetNome(),
                'numero' => $posicao->GetNumeroCamisa()
            ]);
            break;
        case 'não definida':
            array_push($arrayJogadores['jogadores'][($posicao->GetSexo() == 'm' ? 'M' : 'F')]['naodefinida'], [
                'id' => $posicao->GetID(),
                'nome' => $posicao->GetNome(),
                'numero' => $posicao->GetNumeroCamisa()
            ]);
            break;
    }
}
foreach ($competicoes as $index => $competicao) {
    array_push($arrayCompeticoes, ['id' => $competicao->GetID(), 'desafiante' => $competicao->GetDesafiante(), 'nome' => $competicao->GetNome(), 'desafiado' => $competicao->GetDesafiado(), 'criacao' => $competicao->GetData()]);
}
$arrayJSON = $arrayTimes + $arrayJogadores + $competicoes;
$arrayJSON = json_encode($arrayJSON);
// Define os cabeçalhos para o download do arquivo 
header('Content-Type: application/json');
header('Content-Disposition: attachment; filename="dados.json"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . strlen($arrayJSON)); // Envia o conteúdo JSON para o download
echo $arrayJSON;