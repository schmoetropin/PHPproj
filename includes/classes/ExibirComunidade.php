<?php
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
    class ExibirComunidade extends Conexao {
        public function exibirComunidades($admMod = NULL){
            if(isset($admMod))
                $query = $this->con()->prepare('SELECT * FROM comunidade WHERE id=-50');
            else
                $query = $this->con()->prepare('SELECT * FROM comunidade WHERE id<>-50 ORDER BY dataUltimoTopico DESC');
            $query->execute();
            $i = 0;$j = [];
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $j[$i] = [
                    'id'=> $row['id'],
                    'nome'=> $row['nome'],
                    'descricao'=> $row['descricao'],
                    'criadoPor'=> $row['criadoPor'],
                    'dataCriacao'=> $row['dataCriacao'],
                    'numeroPosts'=> $row['numeroPosts'],
                    'numeroTopicos'=> $row['numeroTopicos'],
                    'numeroInscritos'=> $row['numeroInscritos'],
                    'fotoComunidade'=> $row['fotoComunidade'],
                    'nomeUnico'=> $row['nomeUnico'],
                    'link'=> 'comunidade.php?c='.$row['nomeUnico']];
                $i++;
            }
            if(isset($admMod))
                return $this->printComunidade($j, $admMod);
            else
                return $this->printComunidade($j);
        }

        public function printComunidade($row = [], $admMod = NULL){
            for($i = 0; $i < count($row); $i++){
                $id = $row[$i]['id'];
                $nome = $row[$i]['nome'];
                $descricao = $row[$i]['descricao'];
                $criadoPor = $row[$i]['criadoPor'];
                $dataCriacao = $row[$i]['dataCriacao'];
                $numeroPosts = $row[$i]['numeroPosts'];
                $numeroTopicos = $row[$i]['numeroTopicos'];
                $numeroInscritos = $row[$i]['numeroInscritos'];
                $fotoComunidade = $row[$i]['fotoComunidade'];
                $nomeU = $row[$i]['nomeUnico'];
                $link = $row[$i]['link'];
                if(strlen($descricao)> 120){
                    $descricao = substr($descricao, 0, 117);
                    $descricao = $descricao.'...';
                }?>
                <a href="<?php echo $link;?>">
                    <div class='bordaComunidade'>
                        <div class='fotoComunidade'>
                            <img src="<?php echo $fotoComunidade;?>">
                        </div>
                        <div class='conteudoComunidade'>
                            <h3><?php echo $nome;?></h3>
                            <p><?php echo $descricao;?></p>
                        </div>
                        <div class='statusComunidade'>
                        <p>Topicos: <?php echo $numeroTopicos;?></p>
                        <p>Posts: <?php echo $numeroPosts;?></p>
                        <p>Inscritos: <?php echo $numeroInscritos;?></p>
                        </div>
                    </div>
                </a><?php
                if(isset($_SESSION['logUsuario']) && empty($admMod))
                    $this->exibirDeletarCoimunidadeForm($nomeU, $_SESSION['logUsuario'], $nome);
            }
        }

        private function exibirDeletarCoimunidadeForm($nomeU, $log, $nome){
            $nU = new CriarNomeUnico();
            $uOb = new Usuario($nU->selecionarId($log, 'usuario'));
            $checU = $uOb->getTipoUsuario();
            if($checU == 3){
                $uId = uniqid();?>
                <input type='hidden' class='comunidadeId' value="<?php echo $nomeU;?>">
                <button id='botaoExcluirComunidade<?php echo $nomeU;?>' class='btn btnVermelho botaoExcluirComunidade'><span style='color: #fff;'>excluir comunidade</span></button>
                <div class='fundoOpacoPadrao'></div>
                <div id='messConfirmDelComunidade<?php echo $nomeU;?>' class='messConfirmDelComunidade'>
                    <img src='assets/imagens/icones/close.png' id="fecharMessConfirmDelComunidade<?php echo $nomeU;?>" class='fecharMessConfirmDelComunidade botaoFecharPadrao'>
                    <small>Valor: <?php echo $uId;?><br> Tem certeza que desaja excluir a comunidade <?php echo '"'.strtoupper($nome);?>"<br>
                    Se sim digite 'sim, deletar a comunidade <?php echo $nome;?>' em letra maiuscula e o valor gerado acima no campo abaixo:<br>
                    Ex.: se a comunidade se chamar Rosa e o valor gerado acima for 1A2b3c4D voce devera digitar:<br>
                    'SIM, DELETAR A COMUNIDADE ROSA 1A2b3c4D'</small><br>
                    <form id='excluirComunidade<?php echo $nomeU;?>' method='POST' onsubmit='return false'>
                        <input type='text' name='confirmacaoDeletarComunidade' placeholder='Digitar confirmacao aqui' required><br>
                        <input type='hidden' name='comunidade' value="<?php echo $nomeU;?>">
                        <input type='hidden' name='valorAleatorio' value="<?php echo $uId;?>">
                        <input type='submit' id='botaoConfirmacaoDeleterComunidade<?php echo $nomeU;?>' class='btn btnAzul' value='confirmar'>
                    </form>
                </div><?php
            }
        }
    };
?>