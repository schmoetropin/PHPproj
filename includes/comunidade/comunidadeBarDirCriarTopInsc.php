<?php
if(empty($checarIncludeRequire)){
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
}
if(isset($_SESSION['logUsuario'])){ ?>
    <div id="areaInscricao" class="areaInscricao"><?php
        $insObj->exibirBotaoInscricao($comId, NULL);?>
    </div>
    <button id="botaoCriarTopicoSm" class="btn btnVermelho botaoCriarTopico">Criar Topico</button><?php
    $uObj = new Usuario($logU);
    $checUs = $uObj->getTipoUsuario();
    if($modObj->checarModerador($logU, $comId) || $checUs == 3){?>
        <button class="btn btnLaranja trocarDescricaoComunidade" id="trocarDescricaoComunidade">trocar descricao</button><?php 
    }
} 
if(isset($_SESSION['logUsuario'])){?>
    <input type="hidden" id="logUsuario" value="<?php echo $_SESSION['logUsuario'];?>"><?php 
}else{?>
    <input type="hidden" id="logUsuario" value="nenhum"><?php 
}?>
<div id="criarTopicoMensagem"></div>