<?php
// Inclui os arquivos das classes 'jogador_class.php' e 'time_class.php' para fornecer acesso aos métodos e dados dos jogadores e times
require_once "jogador_class.php";
require_once "time_class.php";
require_once "competicao_class.php";

class Componentes
{
    /**
     * Método estático para gerar opções de jogadores para um formulário de seleção
     */
    public static function InputJogadores()
    {
        // Obtém a lista de jogadores chamando o método getJogadores da classe Jogador
        $jogadores = Jogador::getJogadores();

        // Percorre cada jogador obtido na lista de jogadores
        foreach ($jogadores as $jogador) {
            // Cria um elemento <option> para cada jogador com o ID do jogador como valor e o texto exibido 
            // inclui o número da camisa e o nome do jogador
            echo "<option value='" . $jogador->GetID() . "'>" . $jogador->GetNumeroCamisa() . " : " . $jogador->GetNome() . "</option>";
        }
    }
    public static function InputCompeticoes($idTime)
    {
        $cmpeticoes = Competicao::GetCompeticoes("id_time_desafiante = $idTime OR id_time_desafiado = $idTime");
        foreach ($cmpeticoes as $competicao) {
            echo "<option value='" . $competicao->GetID() . "'>" . $competicao->GetNome() . "</option>";
        }
    }
    public static function PesquisaDinamica($idCampo, $idForm, $item) // Declaração de uma função estática que recebe três parâmetros: o ID do campo, o ID do formulário e o nome do item a ser pesquisado.
    {
?>
        <div class="container text-center"> <!-- Cria um container centralizado para a pesquisa -->
            <h1 class="mt-4 mb-4">Pesquisar <?= $item ?></h1> <!-- Exibe o título da pesquisa com o nome do item passado por parâmetro -->

            <form action="" method="post" class="mb-4" id="<?= $idForm ?>"> <!-- Formulário para a pesquisa, com método POST e ID dinâmico -->
                <div class="col-12">
                    <input type="text" name="<?= $idCampo ?>" id="<?= $idCampo ?>" class="form-control"
                        placeholder="Digite o nome" onkeyup="CarregarNomes(this.value)">
                    <!-- Campo de texto com ID e name dinâmicos. O evento 'onkeyup' chama a função 'CarregarNomes' com o valor digitado, permitindo uma pesquisa dinâmica -->
                    <span id="resultado_pesquisa"></span> <!-- Span para exibir o resultado da pesquisa -->
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success mt-3" id="btn">Pesquisar</button>
                    <!-- Botão de submissão do formulário -->
                </div>
            </form>

            <span id="listar_nomes"></span> <!-- Span adicional onde podem ser listados nomes pesquisados -->
        </div>
    <?php
    }

    /**
     * Método estático para gerar opções de times para um formulário de seleção
     */
    public static function InputTimes()
    {
        // Obtém a lista de times chamando o método getTimes da classe Time
        $times = Time::getTimes();

        // Percorre cada time obtido na lista de times
        foreach ($times as $time) {
            // Cria um elemento <option> para cada time com o ID do time como valor e o nome do time como texto exibido
            echo "<option value='" . $time->GetID() . "'>" . $time->GetNome() . "</option>";
        }
    }

    /**
     * Método para gerar uma área HTML de inserção de atributos individuais para um jogador específico
     * @param int $idJogador ID do jogador
     * @param string $nomeJogador Nome do jogador
     * @param string $posicaoJogador Posição do jogador
     * @param int $numeroJogador Número da camisa do jogador
     */
    public function LocalInsercao($idJogador, $nomeJogador, $posicaoJogador, $numeroJogador)
    {
    ?>
        <!-- Bloco arrastável que representa o jogador -->
        <div class="itemArrastavel card m-3" style="width: auto;" draggable="true">
            <?php
            // Exibe o cabeçalho com o nome, número e posição do jogador
            $this->HeaderInsercao($nomeJogador, $posicaoJogador, $numeroJogador);
            ?>

            <!-- Área de controle de atributos individuais do jogador -->
            <div class="insercao_individual m-lg-1">
                <input type="hidden" name="jogador_<?= $idJogador ?>[posicao]" value="<?= $posicaoJogador ?>">
                <?php
                // Exibe controles de defesa e, conforme a posição do jogador, outros atributos
                $this->LocalDefesas($idJogador);
                if ($posicaoJogador != "levantador") {
                    $this->LocalPasses($idJogador);
                }
                if ($posicaoJogador != "líbero") {
                    $this->LocalSaques($idJogador);
                    $this->LocalAtaques($idJogador);
                    $this->LocalBloqueios($idJogador);
                }
                if ($posicaoJogador == "levantador") {
                    $this->LocalLevantamentos($idJogador);
                }
                ?>
            </div>
        </div>
    <?php
    }

    /**
     * Método privado que gera o cabeçalho do card com a posição, número e nome do jogador
     * @param string $nomeJogador Nome do jogador
     * @param string $posicaoJogador Posição do jogador
     * @param int $numeroJogador Número do jogador
     */
    private function HeaderInsercao($nomeJogador, $posicaoJogador, $numeroJogador)
    { ?>
        <div class="card-header">
            <p style="font-weight: 700; font-size: 25px;">
                <?= $posicaoJogador . ' : ' . ($numeroJogador == 0 ? '' : $numeroJogador . " : ")  . $nomeJogador ?>
            </p>
        </div>
    <?php
    }

    /**
     * Método privado que gera um controle de input para atributos de estatísticas de um jogador
     * @param int $idJogador ID do jogador
     * @param string $tipoID Tipo de estatística
     * @param string $legenda Legenda exibida no controle
     */
    private function InputEstatistica($idJogador, $tipoID, $legenda)
    {
    ?>
        <div>
            <!-- Exibe a legenda fornecida como parâmetro -->
            <span><?= $legenda ?></span>

            <!-- Botão de aumentar o valor da estatística -->
            <span id="<?= $idJogador ?>_aumentar_<?= $tipoID ?>" class="atributos_span"
                onclick="document.getElementById('<?= $idJogador ?>_<?= $tipoID ?>').value++">+</span>

            <!-- Campo de input de número que armazena o valor da estatística -->
            <input type="number" value="0" readonly class="input_number" name="jogador_<?= $idJogador ?>[<?= $tipoID ?>]"
                id="<?= $idJogador ?>_<?= $tipoID ?>" />

            <!-- Botão de diminuir o valor da estatística -->
            <span id="<?= $idJogador ?>_diminuir_<?= $tipoID ?>" class="atributos_span"
                onclick="document.getElementById('<?= $idJogador ?>_<?= $tipoID ?>').value == 0 ? document.getElementById('<?= $idJogador ?>_<?= $tipoID ?>').value = 0 : document.getElementById('<?= $idJogador ?>_<?= $tipoID ?>').value--">-</span>
        </div>
    <?php
    }

    /**
     * Método privado para gerar controle de defesa para um jogador
     * @param int $idJogador ID do jogador
     */
    private function LocalDefesas($idJogador)
    {
    ?>
        <div class="defesa">
            <span><strong>Def: </strong></span>
            <?php $this->InputEstatistica($idJogador, 'defesa_jogador', ''); ?>
        </div>
        <div class="defesa">
            <span><strong>Err_def: </strong></span>
            <?php $this->InputEstatistica($idJogador, 'erro_defesa', ''); ?>
        </div>
    <?php
    }

    /**
     * Método privado para exibir os controles de atributos de passes para um jogador
     */
    private function LocalPasses($idJogador)
    {
    ?>
        <div class="passes">
            <div><span><strong>Pas: </strong></span></div>
            <div>
                <?php $this->InputEstatistica($idJogador, 'passe_a', 'A'); ?>
                <?php $this->InputEstatistica($idJogador, 'passe_b', 'B'); ?>
                <?php $this->InputEstatistica($idJogador, 'passe_c', 'C'); ?>
                <?php $this->InputEstatistica($idJogador, 'passe_d', 'D'); ?>
            </div>
        </div>
    <?php
    }

    /**
     * Método privado para exibir controles de atributos de saques para um jogador
     */
    private function LocalSaques($idJogador)
    {
    ?>
        <div class="saques">
            <div><strong><span>Saq: </span></strong></div>
            <div>
                <?php $this->InputEstatistica($idJogador, 'saque_flutuante', 'Flu'); ?>
                <?php $this->InputEstatistica($idJogador, 'saque_ace', 'ACE'); ?>
                <?php $this->InputEstatistica($idJogador, 'saque_viagem', 'Via'); ?>
                <?php $this->InputEstatistica($idJogador, 'saque_cima', 'Cima'); ?>
                <?php $this->InputEstatistica($idJogador, 'saque_fora', 'Fora'); ?>
            </div>
        </div>
    <?php
    }

    /**
     * Método privado para exibir controles de atributos de ataques para um jogador
     */
    private function LocalAtaques($idJogador)
    {
    ?>
        <div class="ataques">
            <div><strong><span>Ataq: </span></strong></div>
            <div>
                <?php $this->InputEstatistica($idJogador, 'ataque_dentro', 'Dentro'); ?>
                <?php $this->InputEstatistica($idJogador, 'ataque_fora', 'Fora'); ?>
            </div>
        </div>
    <?php
    }

    /**
     * Método privado para exibir controles de bloqueios para um jogador
     */
    private function LocalBloqueios($idJogador)
    {
    ?>
        <div class="bloqueios">
            <div><strong><span>Bloq: </span></strong></div>
            <div>
                <?php $this->InputEstatistica($idJogador, 'bloqueio_convertido', 'Convertido'); ?>
                <?php $this->InputEstatistica($idJogador, 'bloqueio_errado', 'Errado'); ?>
            </div>
        </div>
    <?php
    }

    /**
     * Método privado para exibir controles de atributos de levantamentos para um jogador
     */
    private function LocalLevantamentos($idJogador)
    {
    ?>
        <div class="levantamentos">
            <div><strong><span>Levant: </span></strong></div>
            <div>
                <?php $this->InputEstatistica($idJogador, 'levantamento_para_ponta', 'Ponta'); ?>
                <?php $this->InputEstatistica($idJogador, 'levantamento_para_pipe', 'Pipe'); ?>
                <?php $this->InputEstatistica($idJogador, 'levantamento_para_centro', 'Centro'); ?>
                <?php $this->InputEstatistica($idJogador, 'levantamento_para_oposto', 'Oposto'); ?>
                <?php $this->InputEstatistica($idJogador, 'errou_levantamento', 'Errou'); ?>
            </div>
        </div>
<?php
    }
}
?>