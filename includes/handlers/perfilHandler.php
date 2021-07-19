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
		if($_FILES['trocarFotoPerfil']['size'] > 0)
			$usObj->setFotoPerfil($_FILES['trocarFotoPerfil']);
	}
	
	// troca o nome do usuario
	if(isset($_POST['trocarNome']))
		$usObj->setNome($_POST['trocarNome']);
	
	// troca o email do usuario
	if(isset($_POST['trocarEmail']) && isset($_POST['trocarEmail2']))
		$usObj->setEmail($_POST['trocarEmail'], $_POST['trocarEmail2']);
	
	// troca a senha do usuario
	if(isset($_POST['trocarSenha']) && isset($_POST['trocarSenha2']))
		$usObj->setSenha($_POST['trocarSenha'], $_POST['trocarSenha2']);
	
	// troca a descricao do usuario
	if(isset($_POST['trocarDescricao']))
		$usObj->setDescricaoPerfil($_POST['trocarDescricao']);
	

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
