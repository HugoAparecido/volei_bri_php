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
        <div class="itemArrastavel" draggable="true">
            <h3><?= $posicaoJogador . ' : ' . ($numeroJogador == 0 ? '' : $numeroJogador . " : ")  . $nomeJogador ?></h3>
            <div class="insercao_individual">
                <div class="defesa">
                    <span><strong>Def: </strong></span>
                    <div>
                        <span id="<?= $idJogador ?>_aumentar_defesa" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_defesa').value++">+</span>
                        <input type="number" value="0" readonly class="input_number" name="<?= $idJogador ?>_defesa" id="<?= $idJogador ?>_defesa" />
                        <span id="<?= $idJogador ?>_diminuir_defesa" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_defesa').value == 0 ? document.getElementById('<?= $idJogador ?>_defesa').value = 0 : document.getElementById('<?= $idJogador ?>_defesa').value--">-</span>
                    </div>
                </div>
                <div class="defesa">
                    <span><strong>Err_def: </strong></span>
                    <div>
                        <span id="<?= $idJogador ?>_aumentar_erro_defesa" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_erro_defesa').value++">+</span>
                        <input type="number" value="0" readonly class="input_number" name="<?= $idJogador ?>_erro_defesa" id="<?= $idJogador ?>_erro_defesa" />
                        <span id="<?= $idJogador ?>_diminuir_erro_defesa" class="atributos_span" onclick="document.getElementById('<?= $idJogador ?>_erro_defesa').value == 0 ? document.getElementById('<?= $idJogador ?>_erro_defesa').value = 0 : document.getElementById('<?= $idJogador ?>_erro_defesa').value--">-</span>
                    </div>
                </div>
            <?php
        }
        public function LocalInsercaoLibero($idJogador, $nomeJogador, $posicaoJogador, $numeroJogador)
        {
            $this->ComecoLocalInsercao($idJogador, $nomeJogador, $posicaoJogador, $numeroJogador);
            ?>
            </div>
        </div>
    <?php
        }
        public function LocalInsercaoLevantador($idJogador, $nomeJogador, $posicaoJogador, $numeroJogador)
        {
            $this->ComecoLocalInsercao($idJogador, $nomeJogador, $posicaoJogador, $numeroJogador);
    ?>
        </div>
        </div>
    <?php
        }
        public function LocalInsercaoOutrasPosicoes($idJogador, $nomeJogador, $posicaoJogador, $numeroJogador)
        {
            $this->ComecoLocalInsercao($idJogador, $nomeJogador, $posicaoJogador, $numeroJogador);
    ?>
        </div>
        </div>
<?php
        }
    }
