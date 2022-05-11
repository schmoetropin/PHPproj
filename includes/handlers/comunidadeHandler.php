<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
	require_once('../includesRequire.php');
	$comObj = new Comunidade();
	$exbCom = new ExibirComunidade();
	$criCom = new CriarComunidade();
	$exbTop = new ExibirTop4Topicos();
	$nomeUn = new CriarNomeUnico(); 
	
	// exibe todas comunidades
	if(isset($_POST['comunidades'])){
		$exbCom->exibirComunidades();
	}

	//exibe top4 topicos de todas as comunidades
	if(isset($_POST['top4TopicoIndex']))
		$exbTop->exibirto4Topicos();
	
	// criar nova comunidade	
	if(isset($_SESSION['logUsuario']) && isset($_POST['nomeComunidade']) && isset($_POST['descricaoComunidade']) && isset($_FILES['fotoComunidade'])){
		$us = $nomeUn->selecionarId($_SESSION['logUsuario'], 'usuario');
		$nom = $_POST['nomeComunidade'];
		$des = $_POST['descricaoComunidade'];
		$fot = $_FILES['fotoComunidade'];
		$criCom->criarCominidade($us, $nom, $des, $fot);
	}

	// exibe foto comunidade
	if(isset($_POST['exibirFoto'])){
		$comId = $nomeUn->selecionarId($_POST['comunidade'], 'comunidade');
		$comObj = new Comunidade($comId);
		echo $comObj->getFotoComunidade();
	}

	// exibe nome comunidade
	if(isset($_POST['exibirNome'])){
		$comId = $nomeUn->selecionarId($_POST['comunidade'], 'comunidade');
		$comObj = new Comunidade($comId);
		echo $comObj->getNome();
	}

	// exibe descricao comunidade
	if(isset($_POST['exibirDescricao'])){
		$comId = $nomeUn->selecionarId($_POST['comunidade'], 'comunidade');
		$comObj = new Comunidade($comId);
		echo $comObj->getDescricao();
	}

	// edita nome comunidade
	if(isset($_POST['inputEditarNome'])){
		$nom = $_POST['inputEditarNome'];
		$comId = $nomeUn->selecionarId($_POST['comunidade'], 'comunidade');
		$comObj = new Comunidade($comId);
		if($comObj->getNome() != $nom)
			$comObj->setNome($_POST['inputEditarNome']);
		else
			echo "Nenhuma mudanca foi feita \n";
	}

	// edita foto comunidade
	if(isset($_FILES['arquivoEditarFoto'])){
		$comId = $nomeUn->selecionarId($_POST['comunidade'], 'comunidade');
		$comObj = new Comunidade($comId);
		$comObj->setFotoComunidade($_FILES['arquivoEditarFoto']);
	}

	// edita descricao comunidade
	if(isset($_POST['txtaEditarDescricao'])){
		$des = $_POST['txtaEditarDescricao'];
		$comId = $nomeUn->selecionarId($_POST['comunidade'], 'comunidade');
		$comObj = new Comunidade($comId);
		if($comObj->getDescricao() != $des)
			$comObj->setDescricao($des);
		else
			echo "Nenhuma mudanca foi feita \n";
	}

	// deleta comunidade
	if(isset($_POST['confirmacaoDeletarComunidade'])){
		$input = $_POST['confirmacaoDeletarComunidade'];
		$comunidade = $nomeUn->selecionarId($_POST['comunidade'], 'comunidade');
		$val = $_POST['valorAleatorio'];
		$comObj = new Comunidade($comunidade);
		$nome = strtoupper($comObj->getNome());
		$texto = "SIM, DELETAR A COMUNIDADE $nome $val";
		if($input == $texto)
			$comObj->excluirComunidade($comunidade);
		else
			echo $texto;
	}
?>
