<?php
	if(empty($checarIncludeRequire)){
		if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
			<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
			exit();
		}
	}
	require_once('../includesRequire.php');
	$mesObj = new Mensagem();
	$nomeU = new CriarNomeUnico();

	if(isset($_POST['usuarioMensagem']) && isset($_POST['mensagemTextarea'])){
		$logU = $nomeU->selecionarId($_SESSION['logUsuario'], 'usuario');
		$us = $nomeU->selecionarId($_POST['usuarioMensagem'], 'usuario');
		$mesObj->enviarMensagem($logU, $us, $_POST['mensagemTextarea']);
	}
 
	if(isset($_POST['logUsuario']) && isset($_POST['usuario'])){
		$logU = $nomeU->selecionarId($_POST['logUsuario'], 'usuario');
		$us = $nomeU->selecionarId($_POST['usuario'], 'usuario');
		$mesObj->exibirMensagens($logU, $us);
	}
?>

<style>
.mensagem {	
	width: 100%;
	margin: 18px 9px;
	box-sizing: border-box;
}

.mensagem .mensagemUsuario {
	font-weight: bold;
	color: #0D47A1;
	text-transform: capitalize;
}

.mensagem .mensagemConteudo {
	display: inline-block;
	border: 1px solid #0D47A1;
	border-radius: 6px;
	padding: 3px;
	margin: 2px;
	min-width: 15px;
	max-width: 95%;
}
</style>