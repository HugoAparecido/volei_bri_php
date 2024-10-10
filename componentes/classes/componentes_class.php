<?php
// Inclui a classe 'OutrasPosicoes' que contém métodos relacionados a jogadores
require_once "jogador_class.php";
require_once "time_class.php";

class Componentes
{
    // Método estático para gerar opções de jogadores para um formulário
    public static function InputJogadores()
    {
        // Obtém a lista de jogadores usando um método da classe 'OutrasPosicoes'
        $jogadores = Jogador::getJogadores();

        // Itera sobre cada jogador na lista
        foreach ($jogadores as $jogador) {
            // Cria um elemento <option> para cada jogador
            // O valor do option é o ID do jogador, e o texto exibido inclui o número da camisa e o nome do jogador
            echo "<option value='" . $jogador->GetID() . "'>" . $jogador->GetNumeroCamisa() . " : " . $jogador->GetNome() . "</option>";
        }
    }
    // Método estático para gerar opções de times para um formulário
    public static function InputTimes()
    {
        // Obtém a lista de times usando um método da classe 'OutrasPosicoes'
        $times = Time::getTimes();

        // Itera sobre cada time na lista
        foreach ($times as $time) {
            // Cria um elemento <option> para cada time
            // O valor do option é o ID do time, e o texto exibido inclui o número da camisa e o nome do time
            echo "<option value='" . $time->GetID() . "'>" . $time->GetNome() . "</option>";
        }
    }
    public function LocalInsercao($idJogador, $nomeJogador, $posicaoJogador, $numeroJogador)
    {
?>
        <!-- Bloco arrastável que representa o jogador -->
        <div class="itemArrastavel card m-5" draggable="true">
            <?php
            $this->HeaderInsercao($nomeJogador, $posicaoJogador, $numeroJogador);
            ?>

            <!-- Área de controle de atributos individuais do jogador -->
            <div class="insercao_individual m-lg-1">
                <?php
                $this->LocalDefesas($idJogador);
                if ($posicaoJogador != "Levantador") {
                    $this->LocalPasses($idJogador);
                }
                if ($posicaoJogador != "Líbero") {
                    $this->LocalSaques($idJogador);
                    $this->LocalAtaques($idJogador);
                    $this->LocalBloqueios($idJogador);
                }
                if ($posicaoJogador == "Levantador") {
                    $this->LocalLevantamentos($idJogador);
                }
                ?>
            </div>
        </div>
    <?php
    }
    // Método privado que gera um bloco HTML para exibição de informações e controles de atributos de um jogador específico
    private function HeaderInsercao($nomeJogador, $posicaoJogador, $numeroJogador)
    { ?>
        <!-- Cabeçalho do card com a posição, número e nome do jogador -->
        <div class="card-header">
            <h3>
                <?= $posicaoJogador . ' : ' . ($numeroJogador == 0 ? '' : $numeroJogador . " : ")  . $nomeJogador ?>
            </h3>
        </div>
    <?php
    }
    private function InputEstatistica($idJogador, $tipoID, $legenda)
    {
    ?>
        <div>
            <!-- Exibe a legenda fornecida como parâmetro -->
            <span><?= $legenda ?></span>

            <!-- Botão de aumentar: ao clicar, incrementa o valor do campo de input correspondente ao jogador e tipo de estatística -->
            <span id="<?= $idJogador ?>_aumentar_<?= $tipoID ?>" class="atributos_span"
                onclick="document.getElementById('<?= $idJogador ?>_<?= $tipoID ?>').value++">+</span>

            <!-- Campo de input do tipo "number", apenas para leitura, que armazena o valor da estatística do jogador -->
            <input type="number" value="0" readonly class="input_number" name="jogador_<?= $idJogador ?>[<?= $tipoID ?>]"
                id="<?= $idJogador ?>_<?= $tipoID ?>" />

            <!-- Botão de diminuir: ao clicar, decrementa o valor do campo de input, mas não permite que o valor fique abaixo de 0 -->
            <span id="<?= $idJogador ?>_diminuir_<?= $tipoID ?>" class="atributos_span"
                onclick="document.getElementById('<?= $idJogador ?>_<?= $tipoID ?>').value == 0 ? document.getElementById('<?= $idJogador ?>_<?= $tipoID ?>').value = 0 : document.getElementById('<?= $idJogador ?>_<?= $tipoID ?>').value--">-</span>
        </div>
    <?php
    }

    private function LocalDefesas($idJogador)
    {
    ?>
        <!-- Controle de "Defesa" -->
        <div class="defesa m-2">
            <span><strong>Def: </strong></span>
            <?php $this->InputEstatistica($idJogador, 'defesa', ''); ?>
        </div>

        <!-- Controle de "Erro de Defesa" -->
        <div class="defesa m-2">
            <span><strong>Err_def: </strong></span>
            <?php $this->InputEstatistica($idJogador, 'erro_defesa', ''); ?>
        </div>
    <?php
    }
    // Método público para exibir a interface de controle de atributos de passe para um jogador Líbero específico
    private function LocalPasses($idJogador)
    {
    ?>
        <!-- Div principal contendo os controles para os tipos de passe do jogador -->
        <div class="passes">
            <div><span><strong>Pas: </strong></span></div>

            <!-- Controle de atributo para o passe tipo A -->
            <?php $this->InputEstatistica($idJogador, 'passe_A', 'A'); ?>

            <!-- Controle de atributo para o passe tipo B -->
            <?php $this->InputEstatistica($idJogador, 'passe_B', 'B'); ?>

            <!-- Controle de atributo para o passe tipo C -->
            <?php $this->InputEstatistica($idJogador, 'passe_C', 'C'); ?>

            <!-- Controle de atributo para o passe tipo D -->
            <?php $this->InputEstatistica($idJogador, 'passe_D', 'D'); ?>
        </div>
    <?php
    }
    private function LocalSaques($idJogador)
    {
    ?>
        <div class="saques">
            <strong><span>Saq: </span></strong>
            <?php $this->InputEstatistica($idJogador, 'saque_flutuante', 'Flu'); ?>
            <?php $this->InputEstatistica($idJogador, 'saque_ace', 'ACE'); ?>
            <?php $this->InputEstatistica($idJogador, 'saque_viagem', 'Via'); ?>
            <?php $this->InputEstatistica($idJogador, 'saque_por_cima', 'Cima'); ?>
            <?php $this->InputEstatistica($idJogador, 'saque_fora', 'Fora'); ?>
        </div>
    <?php
    }
    private function LocalAtaques($idJogador)
    {
    ?>
        <div class="ataques">
            <strong><span>Ataq: </span></strong>
            <?php $this->InputEstatistica($idJogador, 'ataque_acerto', 'Dentro'); ?>
            <?php $this->InputEstatistica($idJogador, 'ataque_erro', 'Fora'); ?>
        </div>
    <?php
    }
    public function LocalBloqueios($idJogador)
    {
    ?>
        <div class="bloqueios">
            <strong><span>Bloq: </span></strong>
            <?php $this->InputEstatistica($idJogador, 'bloqueio_ponto_este', 'Convertido'); ?>
            <?php $this->InputEstatistica($idJogador, 'bloqueio_ponto_adversario', 'Errado'); ?>
        </div>
    <?php
    }
    private function LocalLevantamentos($idJogador)
    {
    ?>
        <div class="levantamentos">
            <strong><span>Levant: </span></strong>
            <?php $this->InputEstatistica($idJogador, 'levantamento_ponta', 'Ponta'); ?>
            <?php $this->InputEstatistica($idJogador, 'levantamento_pipe', 'Pipe'); ?>
            <?php $this->InputEstatistica($idJogador, 'levantamento_centro', 'Centro'); ?>
            <?php $this->InputEstatistica($idJogador, 'levantamento_oposto', 'Oposto'); ?>
            <?php $this->InputEstatistica($idJogador, 'levantamento_errou', 'Errou'); ?>
        </div>
<?php
    }
}
