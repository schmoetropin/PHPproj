<?php
	if(empty($checarIncludeRequire)){
		if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
			<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
			exit();
		}
	}
?>
<div class="topicoBarraDireita">
	<div class="topicoComunidadeDetalhes">
		<a href="comunidade.php?c=<?php echo $comunidade;?>"><h3><?php echo $comNome;?></h3></a>
		<a href="comunidade.php?c=<?php echo $comunidade;?>">
		<div id="topicoComunidadeFoto">
			<img src="<?php echo $comFoto;?>">
		</div>
		</a>
		<p><?php echo $comDesc;?></p>
		<div id="inscreverComunidadeTopico"></div>
	</div>
	<div class="topicoComunidadeModeradores">
		<div class="cabecalho"><h3>Moderadores</h3></div>
		<?php echo $modObj->exibirModeradores(NULL, $_GET['t']);?>
	</div>
</div>