<?php
	require_once('includes/header.php');
	RedirecionarPagina::redirecionarComplementoEnderecoNaoExistente($_SERVER['REQUEST_URI']);
	$topicoPasta = 'includes/topico/';
	// TOPO E INDICE TOPICO
	require_once($topicoPasta.'topicoTopo.php');?>
	<div class="paginaTopico">
	<!-- TOPICO PRINCIPAL -->
<<<<<<< HEAD
		<div class="paginaTopicoPrincipal"><?php
			echo $exbTop->exibirPaginaTopico($_GET['t']);?>
		</div><?php 
=======
		<div class="paginaTopicoPrincipal"></div><?php 
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
		if(isset($_SESSION['logUsuario'])){?>
	<!-- FORMULARIO POST -->	
			<form id="postForm" method="POST" onsubmit="return false">
				<small>Post deve conter pelo menos 2 caracteres</small>
				<textarea name="postConteudo" id="postConteudo" placeholder="Poste um comentario aqui..." required></textarea>
				<input type="hidden" name="nomeTopico" id="nomeTopico" value="<?php echo $_GET['t']?>">
				<input type="submit" name="postarComentario" id="postarComentario" class="btn btnVerde" value="Post">
			</form>
			<div class="contadorConteudoPost" style="margin-left: 40%;"></div><?php 
		}?>
		<input type="hidden" id="noTopico" value="<?php echo $_GET['t'];?>">
	<!-- POSTS -->
<<<<<<< HEAD
		<div class="postArea"><?php
			$ePObj->exibirPosts($_GET['t']);?>
		</div>
=======
		<div class="postArea"></div>
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
	</div>
	<div class="mensagemErroDiv" id="mensagemErroPostDiv">
		<div id="mensagemPostDiv" class="mensagemErro"></div>
		<button id="fecharPostMes" class="btn btnVermelho">ok</button>
	</div>
	<div class="fundoOpacoMensagemErro" id="fundoOpacoMensagemPost"></div><?php
	// TOPICO BARRA DIREITA
	require_once($topicoPasta.'topicoBarraDireita.php');
	if(isset($_SESSION['logUsuario'])){
		$nomeU = new CriarNomeUnico();
		$lu = $nomeU->selecionarId($_SESSION['logUsuario'], 'usuario');
		$criadoPor = $topObj->getCriadoPor();
		$naComunidade = $topObj->getNaComunidade();
		$uObj = new Usuario($lu);
		$checU = $uObj->getTipoUsuario();
		if($modObj->checarModerador($lu, $naComunidade) || $lu == $criadoPor || $checU == 3){ 
			// EDITAR TOPICO
			require_once($topicoPasta.'topicoEditarTopico.php');
		}
	}?>
	<input type="hidden" id="topicoPaginaId" value="<?php echo $_GET['t'];?>" /><?php 
	include('includes/footer.php');
?>