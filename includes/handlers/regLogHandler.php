<?php
	if(empty($checarIncludeRequire)){
		if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
			<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
			exit();
		}
	}
	require_once('../includesRequire.php');
	$regObj = new Registro();

	if(isset($_POST['logEmail']) && isset($_POST['logSenha']))
		$regObj->login($_POST['logEmail'], $_POST['logSenha']);

	if(isset($_POST['regNome']) 
	&& isset($_POST['regEmail']) 
	&& isset($_POST['regEmail2']) 
	&& isset($_POST['regSenha']) 
	&& isset($_POST['regSenha2']))
		$regObj->registrar(
			$_POST['regNome'], 
			$_POST['regEmail'], 
			$_POST['regEmail2'], 
			$_POST['regSenha'], 
			$_POST['regSenha2']);

	if(isset($_POST['deslogarConta']))
		$regObj->logout();
			
	if(isset($_POST['exibirEsconderBarraTopo'])){
		if($_POST['exibirEsconderBarraTopo'] == 'exibir')
			$_SESSION['exibirEsconderBarraTopo'] = 'exibir';
	
		if($_POST['exibirEsconderBarraTopo'] == 'esconder')
			$_SESSION['exibirEsconderBarraTopo'] = 'esconder';
	}
?>
