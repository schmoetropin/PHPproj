<?php 
	if(empty($checarIncludeRequire)){
		if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
			<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
			exit();
		}
	}
	$redPag = new RedirecionarPagina();
	$redPag->checarTopAdmMod($_GET['t']);
	$redPag->redirecTopNExistente($_GET['t']);
	
	$topObj = new Topico($_GET['t']);
	$topTUC = new TopicoTipoUsuarioConteudo();
    $exbTop = new ExibirTopico();
	$comId = $topObj->getNaComunidade();
	$comObj = new Comunidade($comId);
	$comunidade = $comObj->getNomeUnico();
	$modObj = new Moderador();
	$posObj = new Post(NULL);
	$likObj = new Like();
	$ePObj = new ExibirPost();

	$insObj = new Inscrever();
	
	$comNome = $comObj->getNome();
	$comDesc = $comObj->getDescricao();
	$comFoto = $comObj->getFotoComunidade();
//	$sectionModerators = $comObj->getModerators();
	
	$topTitulo = $topObj->getTitulo();
	$topId = $topObj->getId();
	$topTipoArquivo = $topObj->getTipoArquivo();
	$topArquivo = $topObj->getArquivo();
?>
<div class="topicoIndice">
	<a href="index.php">Index</a> / 
	<a href="comunidade.php?c=<?php echo $comunidade;?>"><?php echo $comNome;?></a> / 
	<a href="topico.php?t=<?php echo $_GET['t'];?>"><?php echo $topTitulo;?></a> 
</div>