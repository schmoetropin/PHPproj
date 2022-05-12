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
<<<<<<< HEAD
        <p id="descricaoComunidadeP"><?php
            echo $descricao;?>
        </p><?php
        if(isset($_SESSION['logUsuario'])){ ?>
            <div id="areaInscricao" class="areaInscricao"><?php
                $insObj->exibirBotaoInscricao($_GET['c'], NULL);?>
            </div>
=======
        <p id="descricaoComunidadeP"></p><?php
        if(isset($_SESSION['logUsuario'])){ ?>
            <div id="areaInscricao" class="areaInscricao"></div>
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
            <button id="botaoCriarTopicoDe" class="btn btnVermelho botaoCriarTopico">Criar Topico</button><?php
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
<<<<<<< HEAD
        <div class="cabecalho"><h3>Moderadores</h3></div><?php 
        echo $modObj->exibirModeradores($comId, NULL);?>
=======
        <div class="cabecalho"><h3>Moderadores</h3></div>
        <?php echo $modObj->exibirModeradores($comId, NULL);?>
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
    </div>
</div>