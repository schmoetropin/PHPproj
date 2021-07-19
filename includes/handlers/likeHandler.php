<?php
	if(empty($checarIncludeRequire)){
		if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
			<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
			exit();
		}
	}
	require_once('../includesRequire.php');
	$comObj = new Comunidade();
	$topObj = new Topico();
	$posObj = new Post();
	$likObj = new Like();
	$nomeUn = new CriarNomeUnico();
	
	if(isset($_POST['postLike']))
		$likObj->likeForm(NULL, $_POST['postLike']);
		
	if(isset($_POST['topicoLike']))
		$likObj->likeForm($_POST['topicoLike'], NULL);

	if(isset($_POST['areaTipo']) && isset($_POST['opcaoLikeUnlike'])){
		$tip = $_POST['areaTipo'];
		$opc = $_POST['opcaoLikeUnlike'];
		$us = $nomeUn->selecionarId($_SESSION['logUsuario'], 'usuario');
		$likA = $_POST['likeAreaId'];
		if(isset($_POST['likeId']))
			$likId = $_POST['likeId'];
		if($tip == 'Topico' && $opc == 'like')
			$likObj->likeAlgumaCoisa($us, NULL, $likA, NULL);
		else if($tip == 'Topico' && $opc == 'unlike')
			$likObj->unlikeAlgumaCoisa($likId, $us, NULL, $likA, NULL);
		else if($tip == 'Post' && $opc == 'like')
			$likObj->likeAlgumaCoisa($us, NULL, NULL, $likA);
		else if($tip == 'Post' && $opc == 'unlike')
			$likObj->unlikeAlgumaCoisa($likId, $us, NULL, NULL, $likA);
	}
	
?>
