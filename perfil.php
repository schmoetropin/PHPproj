<?php
	require_once('includes/header.php');
	RedirecionarPagina::redirecionarComplementoEnderecoNaoExistente($_SERVER['REQUEST_URI']);
	$perfilPasta = 'includes/perfil/';
	require_once($perfilPasta.'perfilIndice.php');
	$UsNullObj = new Usuario();
	$topExb = new ExibirTopico();
	$posObj = new ExibirPost();
	$amigObj = new Amigos();
	$mesObj = new Mensagem();
	$modObj = new Moderador();?>
	<input type='hidden' id="paginaUsuarioId" value="<?php echo $paginaUsuario;?>">
	<div class="perfilColunaPrincipal">
		<div class="perfilCabecalho"><h3><div id="nomeUsuarioPagina" style='color: #fff;'></div></h3></div>
		<div class="informacaoUsuarioEsquerda">
			<div class="fotoPerfil">
				<div id="fotoUsuarioPagina"></div>
			</div>
			<div id='tipoUsuarioHiddenInput'></div>
			<div id='tipoUsuarioArea'></div>
			<ul>
				<?php require_once($perfilPasta.'perfilInformacaoUsuario.php')?>
			</ul>
		</div><?php
		require_once($perfilPasta.'perfilBarraPrincipal.php');?>
		<div class="conteudoPerfil">
	<!-----------------------------------
	--- SOBRE
	------------------------------------>	
			<div class="cSobre">
				<?php require_once($perfilPasta.'perfilSobreConteudo.php');?>
			</div>	
	<!-----------------------------------
	--- POSTS
	------------------------------------>	
			<div class="cPosts">
				<div style="margin: 20px;" class="divConteMarg">
				<?php echo $posObj->exibirPosts(NULL, NULL, $usObj->getId());?></div>
			</div>
	<!-----------------------------------
	--- TOPICOS
	------------------------------------>
			<div class="cTopicos">
				<div class="divConteMarg">
				<?php echo $topExb->exibirTodosTopicos(NULL, $usObj->getId());?></div>
			</div>
	<!-----------------------------------
	--- AMIGOS
	------------------------------------>
			<div class="cAmigos">
				<div style="margin-top: 20px; padding: 0 8px 0 8px;" class="divConteMarg">
					<div id="listaAmigos"></div>
				</div>
			</div>
	<!-----------------------------------
	--- MENSAGEM
	------------------------------------>
			<div class="cMensagens">
				<div style="margin-top: 20px; padding: 0 8px 0 8px;" class="divConteMarg"><?php
					if(isset($_SESSION['logUsuario'])){
						if(empty($_GET['us']) || ($_SESSION['logUsuario'] == $_GET['us'])){
							$mesObj->checarMensagensInbox($logU);
						}else{?>
							<div id="perfilMensagemArea"></div>
							<input type="hidden" id="logUsuario" value="<?php echo $_SESSION['logUsuario'];?>">
							<input type="hidden" id="usuario" value="<?php echo $_GET['us'];?>">
							<form id="mensagemForm" method="POST" onsubmit="return false">
								<input type="hidden" name="usuarioMensagem" id="usuarioMensagem" value="<?php echo $_GET['us'];?>">
								<textarea id="mensagemTextarea" name="mensagemTextarea" required></textarea>		
								<button class="btn btnAzul" id="botaoEnviarMensagem" name="botaoEnviarMensagem">enviar</button>
							</form><?php 
						}
					}else{?>
						<small style="margin: 0 0 0 7%;">*Voce nao esta logado, nao pode enviar mensagens</small><?php
					}?>
				</div>
			</div>
	<!-----------------------------------
	--- REQUERIMENTOS
	------------------------------------>
			<div class="cRequerimento">
				<div style="margin-top: 20px; padding: 0 8px 0 8px;" class="divConteMarg">
				<?php require_once($perfilPasta.'perfilRequerimentoConteudo.php');?>
				</div>
			</div>
			<div style="width: 100%; height: 80px;"></div>
		</div>
	</div>
	<div class="mensagemErroDiv" id="mensagemErroPerfilDiv">
		<div id="mensagemPerfilDiv" class="mensagemErro"></div>
		<button id="fecharPerfilMes" class="btn btnVermelho">ok</button>
	</div>
	<div class="fundoOpacoMensagemErro" id="fundoOpacoMensagemPerfilErro"></div><?php 
	include('includes/footer.php');
?>