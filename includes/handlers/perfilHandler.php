<?php
	if(empty($checarIncludeRequire)){
		if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
			<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
			exit();
		}
	}
	require_once('../includesRequire.php');
	$nomeUn = new CriarNomeUnico();

	if(isset($_SESSION['logUsuario'])){
		$logU = $nomeUn->selecionarId($_SESSION['logUsuario'], 'usuario');
		$usObj = new Usuario($logU);
	}
	else
		$usObj = new Usuario();
	
	// troca a foto de perfil
	if(isset($_FILES['trocarFotoPerfil'])){
		if($_FILES['trocarFotoPerfil']['size'] > 0){
			if($usObj->setFotoPerfil($_FILES['trocarFotoPerfil']))
				echo 'Foto de perfil trocada.<br />';
		}
	}
	
	// troca o nome do usuario
	if(isset($_POST['trocarNome'])){
		if($usObj->setNome($_POST['trocarNome']))
			echo "<small class='mensagemSucesso'>Nome trocado!</small>";
	}

	// troca o email do usuario
	if(isset($_POST['trocarEmail']) && isset($_POST['trocarEmail2'])){
		if($usObj->setEmail($_POST['trocarEmail'], $_POST['trocarEmail2']))
			echo "<small class='mensagemSucesso'>Email trocado!</small>";
	}
	
	// troca a senha do usuario
	if(isset($_POST['trocarSenha']) && isset($_POST['trocarSenha2'])){
		if($usObj->setSenha($_POST['trocarSenha'], $_POST['trocarSenha2']))
			echo "<small class='mensagemSucesso'>Senha trocada!</small>";
	}
	
	// troca a descricao do usuario
	if(isset($_POST['trocarDescricao'])){
		if($usObj->setDescricaoPerfil($_POST['trocarDescricao']))
			echo "<small class='mensagemSucesso'>Descricao trocada!</small>";
	}
	

	if(isset($_POST['nome'])){
		$logU = $nomeUn->selecionarId($_POST['nome'], 'usuario');
		$obj = new Usuario($logU);
		echo $obj->getNome();
	}

	if(isset($_POST['foto'])){
		$logU = $nomeUn->selecionarId($_POST['foto'], 'usuario');
		$obj = new Usuario($logU);
		$foto = $obj->getFotoDePerfil();
		echo "<img src='$foto'>";
	}

	if(isset($_POST['email'])){
		$logU = $nomeUn->selecionarId($_POST['email'], 'usuario');
		$obj = new Usuario($logU);
		echo $obj->getEmail();
	}

	if(isset($_POST['descricao'])){
		$logU = $nomeUn->selecionarId($_POST['descricao'], 'usuario');
		$obj = new Usuario($logU);
		echo $obj->getDescricaoPerfil();
	}

	if(isset($_POST['tipoUsuarioIH'])){
		$logU = $nomeUn->selecionarId($_POST['tipoUsuarioIH'], 'usuario');
		$obj = new Usuario($logU);
		$tipo = $obj->getNomeTipoUsuario();
		echo "<input type='hidden' id='tipoUsuarioH' value='$tipo'>";
	}

	if(isset($_POST['tipoUs']))
		echo $usObj->exibirTipoUsuarioPerfil($_POST['tipoUs']);

?>
