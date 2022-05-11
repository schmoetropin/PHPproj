<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
	require_once('../includesRequire.php');
	$insObj = new Inscrever();
	$nomeU = new CriarNomeUnico();
	
	if(isset($_POST['increverDesiscrever'])){
		$ins = $_POST['increverDesiscrever'];
		$us = $nomeU->selecionarId($_POST['logUsuario'], 'usuario');
		$com = $nomeU->selecionarId($_POST['comunidade'], 'comunidade');
		if($ins == 'inscrever')
			$insObj->inscreverUs($us, $com);
		else if($ins == 'desiscrever')
			$insObj->desiscrever($us, $com);
	}		
		
	if(isset($_POST['comunidade']))
		$insObj->exibirBotaoInscricao($_POST['comunidade'], NULL);
	else if(isset($_POST['topico']))
		$insObj->exibirBotaoInscricao(NULL, $_POST['topico']);
?>
