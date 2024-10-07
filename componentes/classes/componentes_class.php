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
    private function ComecoLocalInsercao($idJogador, $nomeJogador, $posicaoJogador, $numeroJogador)
    { ?>

        <div class="itemArrastavel card m-5" draggable="true">
            <div class="card-header">
                <h3><?= $posicaoJogador . ' : ' . ($numeroJogador == 0 ? '' : $numeroJogador . " : ")  . $nomeJogador ?></h3>
            </div>
            <div class="insercao_individual m-lg-1">
                <div class="defesa m-2">
                    <?php
                    $posicaoJogador = str_replace(' ', '_', $posicaoJogador);
                    ?>
                    <span><strong>Def: </strong></span>
                    <div>
                        <span id="<?= $idJogador ?>_aumentar_defesa_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_defesa_<?= $posicaoJogador ?>').value++">+</span>
                        <input type="number" value="0" readonly class="input_number" name="<?= $idJogador ?>_defesa_<?= $posicaoJogador ?>" id="<?= $idJogador ?>_defesa_<?= $posicaoJogador ?>" />
                        <span id="<?= $idJogador ?>_diminuir_defesa_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_defesa_<?= $posicaoJogador ?>').value == 0 ? document.getElementById('<?= $idJogador ?>_defesa_<?= $posicaoJogador ?>').value = 0 : document.getElementById('<?= $idJogador ?>_defesa_<?= $posicaoJogador ?>').value--">-</span>
                    </div>
                </div>
                <div class="defesa m-2">
                    <span><strong>Err_def: </strong></span>
                    <div>
                        <span id="<?= $idJogador ?>_aumentar_erro_defesa_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_erro_defesa_<?= $posicaoJogador ?>').value++">+</span>
                        <input type="number" value="0" readonly class="input_number" name="<?= $idJogador ?>_erro_defesa_<?= $posicaoJogador ?>" id="<?= $idJogador ?>_erro_defesa_<?= $posicaoJogador ?>" />
                        <span id="<?= $idJogador ?>_diminuir_erro_defesa_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_erro_defesa_<?= $posicaoJogador ?>').value == 0 ? document.getElementById('<?= $idJogador ?>_erro_defesa_<?= $posicaoJogador ?>').value = 0 : document.getElementById('<?= $idJogador ?>_erro_defesa_<?= $posicaoJogador ?>').value--">-</span>
                    </div>
                </div>
            <?php
        }
        public function LocalInsercaoLibero($idJogador, $nomeJogador, $posicaoJogador, $numeroJogador)
        {
            $this->ComecoLocalInsercao($idJogador, $nomeJogador, $posicaoJogador, $numeroJogador);
            ?><div class="passes">
                    <span><strong>Pas: </strong></span>
                    <div>
                        <span id="<?= $idJogador ?>_aumentar_passe_A_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_A_<?= $posicaoJogador ?>').value++">+A</span>
                        <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_passe_A_<?= $posicaoJogador ?>" id="<?= $idJogador ?>_passe_A_<?= $posicaoJogador ?>" />
                        <span id="<?= $idJogador ?>_diminuir_passe_A_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_A_<?= $posicaoJogador ?>').value == 0 ? document.getElementById('<?= $idJogador ?>_passe_A_<?= $posicaoJogador ?>').value = 0 : document.getElementById('<?= $idJogador ?>_passe_A_<?= $posicaoJogador ?>').value--">-A</span>
                    </div>
                    <div>
                        <span id="<?= $idJogador ?>_aumentar_passe_B_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_B_<?= $posicaoJogador ?>').value++">+B</span>
                        <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_passe_B_<?= $posicaoJogador ?>" id="<?= $idJogador ?>_passe_B_<?= $posicaoJogador ?>" />
                        <span id="<?= $idJogador ?>_diminuir_passe_B_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_B_<?= $posicaoJogador ?>').value == 0 ? document.getElementById('<?= $idJogador ?>_passe_B_<?= $posicaoJogador ?>').value = 0 : document.getElementById('<?= $idJogador ?>_passe_B_<?= $posicaoJogador ?>').value--">-B</span>
                    </div>
                    <div>
                        <span id="<?= $idJogador ?>_aumentar_passe_C_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_C_<?= $posicaoJogador ?>').value++">+C</span>
                        <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_passe_C_<?= $posicaoJogador ?>" id="<?= $idJogador ?>_passe_C_<?= $posicaoJogador ?>" />
                        <span id="<?= $idJogador ?>_diminuir_passe_C_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_C_<?= $posicaoJogador ?>').value == 0 ? document.getElementById('<?= $idJogador ?>_passe_C_<?= $posicaoJogador ?>').value = 0 : document.getElementById('<?= $idJogador ?>_passe_C_<?= $posicaoJogador ?>').value--">-C</span>
                    </div>
                    <div>
                        <span id="<?= $idJogador ?>_aumentar_passe_D_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_D_<?= $posicaoJogador ?>').value++">+D</span>
                        <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_passe_D_<?= $posicaoJogador ?>" id="<?= $idJogador ?>_passe_D_<?= $posicaoJogador ?>" />
                        <span id="<?= $idJogador ?>_diminuir_passe_D_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_D_<?= $posicaoJogador ?>').value == 0 ? document.getElementById('<?= $idJogador ?>_passe_D_<?= $posicaoJogador ?>').value = 0 : document.getElementById('<?= $idJogador ?>_passe_D_<?= $posicaoJogador ?>').value--">-D</span>
                    </div>
                </div>
            </div>
        </div>
    <?php
        }
        public function LocalInsercaoLevantador($idJogador, $nomeJogador, $posicaoJogador, $numeroJogador)
        {
            $this->ComecoLocalInsercao($idJogador, $nomeJogador, $posicaoJogador, $numeroJogador);
    ?>
        <div class="saques">
            <strong><span>Saq: </span></strong>
            <div>
                <span>Flu</span>
                <span id="<?= $idJogador ?>_aumentar_saque_flutuante_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_flutuante_<?= $posicaoJogador ?>').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_saque_flutuante_<?= $posicaoJogador ?>" id="<?= $idJogador ?>_saque_flutuante_<?= $posicaoJogador ?>" />
                <span id="<?= $idJogador ?>_diminuir_saque_flutuante_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_flutuante_<?= $posicaoJogador ?>').value == 0 ? document.getElementById('<?= $idJogador ?>_saque_flutuante_<?= $posicaoJogador ?>').value = 0 : document.getElementById('<?= $idJogador ?>_saque_flutuante_<?= $posicaoJogador ?>').value--">-</span>
            </div>
            <div>
                <span>ACE</span>
                <span id="<?= $idJogador ?>_aumentar_saque_ace_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_ace_<?= $posicaoJogador ?>').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_saque_ace_<?= $posicaoJogador ?>" id="<?= $idJogador ?>_saque_ace_<?= $posicaoJogador ?>" />
                <span id="<?= $idJogador ?>_diminuir_saque_ace_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_ace_<?= $posicaoJogador ?>').value == 0 ? document.getElementById('<?= $idJogador ?>_saque_ace_<?= $posicaoJogador ?>').value = 0 : document.getElementById('<?= $idJogador ?>_saque_ace_<?= $posicaoJogador ?>').value--">-</span>
            </div>
            <div>
                <span>Via</span>
                <span id="<?= $idJogador ?>_aumentar_saque_viagem_(" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_viagem_(').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_saque_viagem_(" id="<?= $idJogador ?>_saque_viagem_(" />
                <span id="<?= $idJogador ?>_diminuir_saque_viagem_(" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_viagem_(').value == 0 ? document.getElementById('<?= $idJogador ?>_saque_viagem_(').value = 0 : document.getElementById('<?= $idJogador ?>_saque_viagem_(').value--">-</span>
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
        <div class="ataques">
            <strong><span>Ataq: </span></strong>
            <div>
                <span>Dentro</span>
                <span id="<?= $idJogador ?>_aumentar_ataque_ace_<?= $posicaoJogador ?>rto" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_ataque_ace_<?= $posicaoJogador ?>rto').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_ataque_ace_<?= $posicaoJogador ?>rto" id="<?= $idJogador ?>_ataque_ace_<?= $posicaoJogador ?>rto" />
                <span id="<?= $idJogador ?>_diminuir_ataque_ace_<?= $posicaoJogador ?>rto" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_ataque_ace_<?= $posicaoJogador ?>rto').value == 0 ? document.getElementById('<?= $idJogador ?>_ataque_ace_<?= $posicaoJogador ?>rto').value = 0 : document.getElementById('<?= $idJogador ?>_ataque_ace_<?= $posicaoJogador ?>rto').value--">-</span>
            </div>
            <div>
                <span>Fora</span>
                <span id="<?= $idJogador ?>_aumentar_ataque_erro" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_ataque_erro').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_ataque_erro" id="<?= $idJogador ?>_ataque_erro" />
                <span id="<?= $idJogador ?>_diminuir_ataque_erro" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_ataque_erro').value == 0 ? document.getElementById('<?= $idJogador ?>_ataque_erro').value = 0 : document.getElementById('<?= $idJogador ?>_ataque_erro').value--">-</span>
            </div>
        </div>
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
        </div>
        </div>
    <?php
        }
        public function LocalInsercaoOutrasPosicoes($idJogador, $nomeJogador, $posicaoJogador, $numeroJogador)
        {
            $this->ComecoLocalInsercao($idJogador, $nomeJogador, $posicaoJogador, $numeroJogador);
    ?><div class="passes">
            <span><strong>Pas: </strong></span>
            <div>
                <span id="<?= $idJogador ?>_aumentar_passe_A_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_A_<?= $posicaoJogador ?>').value++">+A</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_passe_A_<?= $posicaoJogador ?>" id="<?= $idJogador ?>_passe_A_<?= $posicaoJogador ?>" />
                <span id="<?= $idJogador ?>_diminuir_passe_A_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_A_<?= $posicaoJogador ?>').value == 0 ? document.getElementById('<?= $idJogador ?>_passe_A_<?= $posicaoJogador ?>').value = 0 : document.getElementById('<?= $idJogador ?>_passe_A_<?= $posicaoJogador ?>').value--">-A</span>
            </div>
            <div>
                <span id="<?= $idJogador ?>_aumentar_passe_B_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_B_<?= $posicaoJogador ?>').value++">+B</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_passe_B_<?= $posicaoJogador ?>" id="<?= $idJogador ?>_passe_B_<?= $posicaoJogador ?>" />
                <span id="<?= $idJogador ?>_diminuir_passe_B_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_B_<?= $posicaoJogador ?>').value == 0 ? document.getElementById('<?= $idJogador ?>_passe_B_<?= $posicaoJogador ?>').value = 0 : document.getElementById('<?= $idJogador ?>_passe_B_<?= $posicaoJogador ?>').value--">-B</span>
            </div>
            <div>
                <span id="<?= $idJogador ?>_aumentar_passe_C_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_C_<?= $posicaoJogador ?>').value++">+C</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_passe_C_<?= $posicaoJogador ?>" id="<?= $idJogador ?>_passe_C_<?= $posicaoJogador ?>" />
                <span id="<?= $idJogador ?>_diminuir_passe_C_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_C_<?= $posicaoJogador ?>').value == 0 ? document.getElementById('<?= $idJogador ?>_passe_C_<?= $posicaoJogador ?>').value = 0 : document.getElementById('<?= $idJogador ?>_passe_C_<?= $posicaoJogador ?>').value--">-C</span>
            </div>
            <div>
                <span id="<?= $idJogador ?>_aumentar_passe_D_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_D_<?= $posicaoJogador ?>').value++">+D</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_passe_D_<?= $posicaoJogador ?>" id="<?= $idJogador ?>_passe_D_<?= $posicaoJogador ?>" />
                <span id="<?= $idJogador ?>_diminuir_passe_D_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_passe_D_<?= $posicaoJogador ?>').value == 0 ? document.getElementById('<?= $idJogador ?>_passe_D_<?= $posicaoJogador ?>').value = 0 : document.getElementById('<?= $idJogador ?>_passe_D_<?= $posicaoJogador ?>').value--">-D</span>
            </div>
        </div>
        <div class="saques">
            <strong><span>Saq: </span></strong>
            <div>
                <span>Flu</span>
                <span id="<?= $idJogador ?>_aumentar_saque_flutuante_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_flutuante_<?= $posicaoJogador ?>').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_saque_flutuante_<?= $posicaoJogador ?>" id="<?= $idJogador ?>_saque_flutuante_<?= $posicaoJogador ?>" />
                <span id="<?= $idJogador ?>_diminuir_saque_flutuante_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_flutuante_<?= $posicaoJogador ?>').value == 0 ? document.getElementById('<?= $idJogador ?>_saque_flutuante_<?= $posicaoJogador ?>').value = 0 : document.getElementById('<?= $idJogador ?>_saque_flutuante_<?= $posicaoJogador ?>').value--">-</span>
            </div>
            <div>
                <span>ACE</span>
                <span id="<?= $idJogador ?>_aumentar_saque_ace_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_ace_<?= $posicaoJogador ?>').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_saque_ace_<?= $posicaoJogador ?>" id="<?= $idJogador ?>_saque_ace_<?= $posicaoJogador ?>" />
                <span id="<?= $idJogador ?>_diminuir_saque_ace_<?= $posicaoJogador ?>" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_ace_<?= $posicaoJogador ?>').value == 0 ? document.getElementById('<?= $idJogador ?>_saque_ace_<?= $posicaoJogador ?>').value = 0 : document.getElementById('<?= $idJogador ?>_saque_ace_<?= $posicaoJogador ?>').value--">-</span>
            </div>
            <div>
                <span>Via</span>
                <span id="<?= $idJogador ?>_aumentar_saque_viagem_(" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_viagem_(').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_saque_viagem_(" id="<?= $idJogador ?>_saque_viagem_(" />
                <span id="<?= $idJogador ?>_diminuir_saque_viagem_(" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_saque_viagem_(').value == 0 ? document.getElementById('<?= $idJogador ?>_saque_viagem_(').value = 0 : document.getElementById('<?= $idJogador ?>_saque_viagem_(').value--">-</span>
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
        <div class="ataques">
            <strong><span>Ataq: </span></strong>
            <div>
                <span>Dentro</span>
                <span id="<?= $idJogador ?>_aumentar_ataque_ace_<?= $posicaoJogador ?>rto" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_ataque_ace_<?= $posicaoJogador ?>rto').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_ataque_ace_<?= $posicaoJogador ?>rto" id="<?= $idJogador ?>_ataque_ace_<?= $posicaoJogador ?>rto" />
                <span id="<?= $idJogador ?>_diminuir_ataque_ace_<?= $posicaoJogador ?>rto" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_ataque_ace_<?= $posicaoJogador ?>rto').value == 0 ? document.getElementById('<?= $idJogador ?>_ataque_ace_<?= $posicaoJogador ?>rto').value = 0 : document.getElementById('<?= $idJogador ?>_ataque_ace_<?= $posicaoJogador ?>rto').value--">-</span>
            </div>
            <div>
                <span>Fora</span>
                <span id="<?= $idJogador ?>_aumentar_ataque_erro" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_ataque_erro').value++">+</span>
                <input type="number" value="0" readonly class="input_number" min="0" name="<?= $idJogador ?>_ataque_erro" id="<?= $idJogador ?>_ataque_erro" />
                <span id="<?= $idJogador ?>_diminuir_ataque_erro" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_ataque_erro').value == 0 ? document.getElementById('<?= $idJogador ?>_ataque_erro').value = 0 : document.getElementById('<?= $idJogador ?>_ataque_erro').value--">-</span>
            </div>
        </div>
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
        </div>
        </div>
<?php
        }
    }
