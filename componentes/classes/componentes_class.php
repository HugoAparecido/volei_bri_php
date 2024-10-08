<?php
// Inclui a classe 'OutrasPosicoes' que contém métodos relacionados a jogadores
require_once "jogador_class.php";

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
    private function LocalDefesas($idJogador)
    {
    ?>
        <!-- Controle de "Defesa" -->
        <div class="defesa m-2">
            <span><strong>Def: </strong></span>
            <div>
                <!-- Botão para aumentar o valor de "Defesa" -->
                <span id="<?= $idJogador ?>_aumentar_defesa" class="atributos_span"
                    onclick="document.getElementById('<?= $idJogador ?>_defesa').value++">+</span>

                <!-- Campo numérico para exibir o valor atual de "Defesa" -->
                <input type="number" value="0" readonly class="input_number" name="jogador_<?= $idJogador ?>[defesa]"
                    id="<?= $idJogador ?>_defesa" />

                <!-- Botão para diminuir o valor de "Defesa" -->
                <span id="<?= $idJogador ?>_diminuir_defesa" class="atributos_span"
                    onclick="document.getElementById('<?= $idJogador ?>_defesa').value == 0 ? document.getElementById('<?= $idJogador ?>_defesa').value = 0 : document.getElementById('<?= $idJogador ?>_defesa').value--">-</span>
            </div>
        </div>

        <!-- Controle de "Erro de Defesa" -->
        <div class="defesa m-2">
            <span><strong>Err_def: </strong></span>
            <div>
                <!-- Botão para aumentar o valor de "Erro de Defesa" -->
                <span id="<?= $idJogador ?>_aumentar_erro_defesa" class="atributos_span"
                    onclick="document.getElementById('<?= $idJogador ?>_erro_defesa').value++">+</span>

                <!-- Campo numérico para exibir o valor atual de "Erro de Defesa" -->
                <input type="number" value="0" readonly class="input_number" name="jogador_<?= $idJogador ?>[erro_defesa]"
                    id="<?= $idJogador ?>_erro_defesa" />

                <!-- Botão para diminuir o valor de "Erro de Defesa" -->
                <span id="<?= $idJogador ?>_diminuir_erro_defesa" class="atributos_span"
                    onclick="document.getElementById('<?= $idJogador ?>_erro_defesa').value == 0 ? document.getElementById('<?= $idJogador ?>_erro_defesa').value = 0 : document.getElementById('<?= $idJogador ?>_erro_defesa').value--">-</span>
            </div>
        </div>
    <?php
    }
    // Método público para exibir a interface de controle de atributos de passe para um jogador Líbero específico
    private function LocalPasses($idJogador)
    {
    ?>
        <!-- Div principal contendo os controles para os tipos de passe do jogador -->
        <div class="passes">
            <span><strong>Pas: </strong></span>

            <!-- Controle de atributo para o passe tipo A -->
            <div>
                <!-- Botão para aumentar o valor do passe A -->
                <span id="<?= $idJogador ?>_aumentar_passe_A" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_A').value++">+A</span>

                <!-- Campo numérico exibindo o valor atual do passe A -->
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_passe_A" id="<?= $idJogador ?>_passe_A" />

                <!-- Botão para diminuir o valor do passe A -->
                <span id="<?= $idJogador ?>_diminuir_passe_A" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_A').value == 0 ? document.getElementById('<?= $idJogador ?>_passe_A').value = 0 : document.getElementById('<?= $idJogador ?>_passe_A').value--">-A</span>
            </div>

            <!-- Controle de atributo para o passe tipo B -->
            <div>
                <span id="<?= $idJogador ?>_aumentar_passe_B" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_B').value++">+B</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_passe_B" id="<?= $idJogador ?>_passe_B" />
                <span id="<?= $idJogador ?>_diminuir_passe_B" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_B').value == 0 ? document.getElementById('<?= $idJogador ?>_passe_B').value = 0 : document.getElementById('<?= $idJogador ?>_passe_B').value--">-B</span>
            </div>

            <!-- Controle de atributo para o passe tipo C -->
            <div>
                <span id="<?= $idJogador ?>_aumentar_passe_C" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_C').value++">+C</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_passe_C" id="<?= $idJogador ?>_passe_C" />
                <span id="<?= $idJogador ?>_diminuir_passe_C" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_C').value == 0 ? document.getElementById('<?= $idJogador ?>_passe_C').value = 0 : document.getElementById('<?= $idJogador ?>_passe_C').value--">-C</span>
            </div>

            <!-- Controle de atributo para o passe tipo D -->
            <div>
                <span id="<?= $idJogador ?>_aumentar_passe_D" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_D').value++">+D</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_passe_D" id="<?= $idJogador ?>_passe_D" />
                <span id="<?= $idJogador ?>_diminuir_passe_D" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_D').value == 0 ? document.getElementById('<?= $idJogador ?>_passe_D').value = 0 : document.getElementById('<?= $idJogador ?>_passe_D').value--">-D</span>
            </div>
        </div>
    <?php
    }
    private function LocalSaques($idJogador)
    {
    ?>
        <div class="saques">
            <strong><span>Saq: </span></strong>
            <div>
                <span>Flu</span>
                <span id="<?= $idJogador ?>_aumentar_saque_flutuante" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_flutuante').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_saque_flutuante" id="<?= $idJogador ?>_saque_flutuante" />
                <span id="<?= $idJogador ?>_diminuir_saque_flutuante" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_flutuante').value == 0 ? document.getElementById('<?= $idJogador ?>_saque_flutuante').value = 0 : document.getElementById('<?= $idJogador ?>_saque_flutuante').value--">-</span>
            </div>
            <div>
                <span>ACE</span>
                <span id="<?= $idJogador ?>_aumentar_saque_ace" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_ace').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_saque_ace" id="<?= $idJogador ?>_saque_ace" />
                <span id="<?= $idJogador ?>_diminuir_saque_ace" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_ace').value == 0 ? document.getElementById('<?= $idJogador ?>_saque_ace').value = 0 : document.getElementById('<?= $idJogador ?>_saque_ace').value--">-</span>
            </div>
            <div>
                <span>Via</span>
                <span id="<?= $idJogador ?>_aumentar_saque_viagem" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_viagem').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_saque_viagem" id="<?= $idJogador ?>_saque_viagem" />
                <span id="<?= $idJogador ?>_diminuir_saque_viagem" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_viagem').value == 0 ? document.getElementById('<?= $idJogador ?>_saque_viagem').value = 0 : document.getElementById('<?= $idJogador ?>_saque_viagem').value--">-</span>
            </div>
            <div>
                <span>Cima</span>
                <span id="<?= $idJogador ?>_aumentar_saque_por_cima" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_por_cima').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_saque_por_cima" id="<?= $idJogador ?>_saque_por_cima" />
                <span id="<?= $idJogador ?>_diminuir_saque_por_cima" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_por_cima').value == 0 ? document.getElementById('<?= $idJogador ?>_saque_por_cima').value = 0 : document.getElementById('<?= $idJogador ?>_saque_por_cima').value--">-</span>
            </div>
            <div>
                <span>Fora</span>
                <span id="<?= $idJogador ?>_aumentar_saque_fora" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_fora').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_saque_fora" id="<?= $idJogador ?>_saque_fora" />
                <span id="<?= $idJogador ?>_diminuir_saque_fora" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_fora').value == 0 ? document.getElementById('<?= $idJogador ?>_saque_fora').value = 0 : document.getElementById('<?= $idJogador ?>_saque_fora').value--">-</span>
            </div>
        </div>
    <?php
    }
    private function LocalAtaques($idJogador)
    {
    ?>
        <div class="ataques">
            <strong><span>Ataq: </span></strong>
            <div>
                <span>Dentro</span>
                <span id="<?= $idJogador ?>_aumentar_ataque_acerto" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_ataque_acerto').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_ataque_acerto" id="<?= $idJogador ?>_ataque_acerto" />
                <span id="<?= $idJogador ?>_diminuir_ataque_acerto" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_ataque_acerto').value == 0 ? document.getElementById('<?= $idJogador ?>_ataque_acerto').value = 0 : document.getElementById('<?= $idJogador ?>_ataque_acerto').value--">-</span>
            </div>
            <div>
                <span>Fora</span>
                <span id="<?= $idJogador ?>_aumentar_ataque_erro" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_ataque_erro').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_ataque_erro" id="<?= $idJogador ?>_ataque_erro" />
                <span id="<?= $idJogador ?>_diminuir_ataque_erro" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_ataque_erro').value == 0 ? document.getElementById('<?= $idJogador ?>_ataque_erro').value = 0 : document.getElementById('<?= $idJogador ?>_ataque_erro').value--">-</span>
            </div>
        </div>
    <?php
    }
    public function LocalBloqueios($idJogador)
    {
    ?>
        <div class="bloqueios">
            <strong><span>Bloq: </span></strong>
            <div>
                <span>Convertido</span>
                <span id="<?= $idJogador ?>_aumentar_bloqueio_ponto_este" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_bloqueio_ponto_este').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_bloqueio_ponto_este" id="<?= $idJogador ?>_bloqueio_ponto_este" />
                <span id="<?= $idJogador ?>_diminuir_bloqueio_ponto_este" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_bloqueio_ponto_este').value == 0 ? document.getElementById('<?= $idJogador ?>_bloqueio_ponto_este').value = 0 : document.getElementById('<?= $idJogador ?>_bloqueio_ponto_este').value--">-</span>
            </div>
            <div>
                <span>Errado</span>
                <span id="<?= $idJogador ?>_aumentar_bloqueio_ponto_adversario" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_bloqueio_ponto_adversario').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_bloqueio_ponto_adversario" id="<?= $idJogador ?>_bloqueio_ponto_adversario" />
                <span id="<?= $idJogador ?>_diminuir_bloqueio_ponto_adversario" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_bloqueio_ponto_adversario').value == 0 ? document.getElementById('<?= $idJogador ?>_bloqueio_ponto_adversario').value = 0 : document.getElementById('<?= $idJogador ?>_bloqueio_ponto_adversario').value--">-</span>
            </div>
        </div>
    <?php
    }
    private function LocalLevantamentos($idJogador)
    {
    ?><div class="levantamentos">
            <strong><span>Levant: </span></strong>
            <div>
                <span>Ponta</span>
                <span id="<?= $idJogador ?>_aumentar_levantamento_ponta" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_levantamento_ponta').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_levantamento_ponta" id="<?= $idJogador ?>_levantamento_ponta" />
                <span id="<?= $idJogador ?>_diminuir_levantamento_ponta" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_levantamento_ponta').value == 0 ? document.getElementById('<?= $idJogador ?>_levantamento_ponta').value = 0 : document.getElementById('<?= $idJogador ?>_levantamento_ponta').value--">-</span>
            </div>
            <div>
                <span>Pipe</span>
                <span id="<?= $idJogador ?>_aumentar_levantamento_pipe" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_levantamento_pipe').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_levantamento_pipe" id="<?= $idJogador ?>_levantamento_pipe" />
                <span id="<?= $idJogador ?>_diminuir_levantamento_pipe" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_levantamento_pipe').value == 0 ? document.getElementById('<?= $idJogador ?>_levantamento_pipe').value = 0 : document.getElementById('<?= $idJogador ?>_levantamento_pipe').value--">-</span>
            </div>
            <div>
                <span>Centro</span>
                <span id="<?= $idJogador ?>_aumentar_levantamento_centro" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_levantamento_centro').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_levantamento_centro" id="<?= $idJogador ?>_levantamento_centro" />
                <span id="<?= $idJogador ?>_diminuir_levantamento_centro" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_levantamento_centro').value == 0 ? document.getElementById('<?= $idJogador ?>_levantamento_centro').value = 0 : document.getElementById('<?= $idJogador ?>_levantamento_centro').value--">-</span>
            </div>
            <div>
                <span>Oposto</span>
                <span id="<?= $idJogador ?>_aumentar_levantamento_oposto" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_levantamento_oposto').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_levantamento_oposto" id="<?= $idJogador ?>_levantamento_oposto" />
                <span id="<?= $idJogador ?>_diminuir_levantamento_oposto" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_levantamento_oposto').value == 0 ? document.getElementById('<?= $idJogador ?>_levantamento_oposto').value = 0 : document.getElementById('<?= $idJogador ?>_levantamento_oposto').value--">-</span>
            </div>
            <div>
                <span>Errou</span>
                <span id="<?= $idJogador ?>_aumentar_levantamento_errou" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_levantamento_errou').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_levantamento_errou" id="<?= $idJogador ?>_levantamento_errou" />
                <span id="<?= $idJogador ?>_diminuir_levantamento_errou" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_levantamento_errou').value == 0 ? document.getElementById('<?= $idJogador ?>_levantamento_errou').value = 0 : document.getElementById('<?= $idJogador ?>_levantamento_errou').value--">-</span>
            </div>
        </div>
<?php
    }
}
