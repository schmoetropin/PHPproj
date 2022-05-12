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
<<<<<<< HEAD
	$topTUC = new TopicoTipoUsuarioConteudo();
    $exbTop = new ExibirTopico();
=======
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
	$comId = $topObj->getNaComunidade();
	$comObj = new Comunidade($comId);
	$comunidade = $comObj->getNomeUnico();
	$modObj = new Moderador();
	$posObj = new Post(NULL);
	$likObj = new Like();
<<<<<<< HEAD
	$ePObj = new ExibirPost();

	$insObj = new Inscrever();
=======
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
	
	$comNome = $comObj->getNome();
	$comDesc = $comObj->getDescricao();
	$comFoto = $comObj->getFotoComunidade();
//	$sectionModerators = $comObj->getModerators();
	
	$topTitulo = $topObj->getTitulo();
<<<<<<< HEAD
	$topId = $topObj->getId();
	$topTipoArquivo = $topObj->getTipoArquivo();
	$topArquivo = $topObj->getArquivo();
=======
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
?>
<div class="topicoIndice">
	<a href="index.php">Index</a> / 
	<a href="comunidade.php?c=<?php echo $comunidade;?>"><?php echo $comNome;?></a> / 
	<a href="topico.php?t=<?php echo $_GET['t'];?>"><?php echo $topTitulo;?></a> 
</div>