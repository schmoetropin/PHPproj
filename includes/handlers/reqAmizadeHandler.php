<?php
    if(empty($checarIncludeRequire)){
        if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
            <h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
            exit();
        }
    }
    require_once('../includesRequire.php');
    $amigObj = new Amigos();
    $nomeUn = new CriarNomeUnico();
    
    // exibe lista de amigos
    if(isset($_POST['amigos'])){
        $amigos = $nomeUn->selecionarId($_POST['amigos'], 'usuario');
        $amigObj->exibirAmigos($amigos);
    }

    // exibe todos requerimentos de amizade eviados e recebidos
	if(isset($_POST['checReq'])){
		$amigObj->checarRequerimentosDeAmizadeRecebido($_POST['checReq']);
		$amigObj->checarTodosRequerimentosDeAmizadeEnviado($_POST['checReq']);
	}
    
    // exibe mensagem se usuario logado ja enviou pedido de amizade para determinado usuario
	if(isset($_POST['rLogUsuario']) && isset($_POST['rUsuario'])){
        $logU = $nomeUn->selecionarId($_POST['rLogUsuario'], 'usuario');
        $us = $nomeUn->selecionarId($_POST['rUsuario'], 'usuario');
		$amigObj->requisicaoDeAmizade($logU, $us);
		$amigObj->exibirRequizicaoAmizadeEnviadoUsuario($us);
	}
	
	// aceita ou ignora amizade
	if(isset($_POST['logUsuario']) && isset($_POST['usuario']) && isset($_POST['opicao'])){
        $logU = $nomeUn->selecionarId($_POST['logUsuario'], 'usuario');
        $us = $nomeUn->selecionarId($_POST['usuario'], 'usuario');
		if($_POST['opicao'] == 'aceitarR')
			$amigObj->aceitarRequisicao($logU, $us);
		if($_POST['opicao'] == 'ignorarR')
            $amigObj->ignorarRequisicao($logU, $us);
    }
	
	// remove amigo
	if(isset($_POST['paginaUsuario'])){
        $logU = $nomeUn->selecionarId($_SESSION['logUsuario'], 'usuario');
        $pagU = $nomeUn->selecionarId($_POST['paginaUsuario'], 'usuario');
        $amigObj->removerAmigo($logU, $pagU);
    }

    // cancela pedido de amizade
    if(isset($_POST['cancelarReqAmizade']))
        $amigObj->cancelarReqAmizade($_POST['cancelarReqAmizade']);

    // exibe formulario pedido amizade, remover amigo e mensagem se ja enviou pedido de amizade
    if(isset($_POST['logUsuario']) && isset($_POST['pagUsuario'])){
        $logU = $nomeUn->selecionarId($_POST['logUsuario'], 'usuario');
        $pagU = $nomeUn->selecionarId($_POST['pagUsuario'], 'usuario');
        if($_POST['logUsuario'] != $_POST['pagUsuario'] && $_POST['pagUsuario'] != 'nenhum'){
            $checar = $amigObj->checarListaDeAmigos($logU, $pagU);
            if($checar)
                $amigObj->removerAmigoForm($_POST['pagUsuario']);    
            else{
                $checar = $amigObj->checarRequisicaoAmizade($logU, $pagU);
                if($checar > 0)
                    $amigObj->exibirRequizicaoAmizadeEnviadoUsuario($pagU);
                else
                    $amigObj->formularioRequerimentoAmizade($_POST['logUsuario'], $_POST['pagUsuario']);
            }
        }
    }
?>