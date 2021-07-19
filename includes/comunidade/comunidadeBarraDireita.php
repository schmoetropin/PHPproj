<?php
if(empty($checarIncludeRequire)){
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
}?>
<div class="comunidadeBarraDireita">
    <!-- DESCRICAO COMUNIDADE -->
    <div class="descricaoComunidade" id="comunidadeCriarTopInscrev">
        <div class="cabecalho"><h3>Sobre Comunidade</h3></div>
        <p id="descricaoComunidadeP"></p>
        <div id="areaInscricao" class="areaInscricao"></div>
        <input type="submit" id="botaoCriarTopico" class="btn btnVermelho botaoCriarTopico" value="Criar Topico"><?php
        if(isset($_SESSION['logUsuario'])){
            $uObj = new Usuario($logU);
            $checUs = $uObj->getTipoUsuario();
            if($modObj->checarModerador($logU, $comId) || $checUs == 3){?>
                <button class="btn btnLaranja trocarDescricaoComunidade" id="trocarDescricaoComunidade">trocar descricao</button><?php 
            }?>
            <input type="hidden" id="logUsuario" value="<?php echo $_SESSION['logUsuario'];?>"><?php
        }else{?>
            <input type="hidden" id="logUsuario" value="nenhum"><?php 
        }?>
    </div>
    <!-- STATUS COMUNIDADE -->
    <div class="comunidadeStatus">
        <div class="cabecalho"><h3>Comunidade Info</h3></div>
        <p>Topicos: <?php echo $numeroTopicos;?></p>
        <p>Posts: <?php echo $numeroPosts;?></p>
        <p>Criado : <?php echo $data;?></p>
    </div>
    <div class="comunidadeModeradores">
        <div class="cabecalho"><h3>Moderadores</h3></div>
        <?php echo $modObj->exibirModeradores($comId, NULL);?>
    </div>
</div>