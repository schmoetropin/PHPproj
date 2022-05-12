<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
	require_once('../includesRequire.php');
	$posObj = new Post();
	$ePObj = new ExibirPost();
	$nomeU = new CriarNomeUnico();

    if(isset($_POST['area'])){
        if($_POST['area'] == 'posts'){ // exibe posts e comentarios
            $ePObj->exibirPosts($_POST['topico']);
        }
	}
	
	//exibe post comentarios
	if(isset($_POST['postComentario'])){
		$ePObj->exibirPosts($_POST['topico'], $_POST['postComentario']);
	}

    // postar no topico
	if(isset($_SESSION['logUsuario']) && isset($_POST['nomeTopico']) && isset($_POST['postConteudo'])){
		$us = $nomeU->selecionarId($_SESSION['logUsuario'], 'usuario');
		$nom = $_POST['nomeTopico'];
		$con = $_POST['postConteudo'];
		if($posObj->postarEmTopico($us, $nom, NULL, $con))
			echo "<small class='mensagemSucesso'>Post efetuado com sucesso!</small>";
	}
	
	// comentar post
	if(isset($_SESSION['logUsuario']) && isset($_POST['noTopico']) && isset($_POST['noPost']) && isset($_POST['postConteudo'])){
		$us = $nomeU->selecionarId($_SESSION['logUsuario'], 'usuario');
		$top = $_POST['noTopico'];
		$pos = $_POST['noPost'];
		$con = $_POST['postConteudo'];
		if($posObj->postarEmTopico($us, $top, $pos, $con))
			echo "<small class='mensagemSucesso'>Comentario efetuado com sucesso!</small>";
	}

	// editar post
	if(isset($_POST['editarPostTextarea'])){
		$pOb = new Post($_POST['editPostId']);
<<<<<<< HEAD
		if($pOb->setConteudo($_POST['editarPostTextarea']))
			echo "<small class='mensagemSucesso'>Comentario editado com sucesso!</small>";
=======
		$pOb->setConteudo($_POST['editarPostTextarea']);
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
	}

	// deletar post
	if(isset($_POST['delPostInput'])){
		$inp = $_POST['delPostInput'];
		$val = $_POST['delPostValor'];
		$post = $_POST['delPostId'];
		if($inp == $val)
			$posObj->deletarPost($post);
	}
?>