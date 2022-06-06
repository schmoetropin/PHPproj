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
	$modObj = new Moderador();
	$mFObj = new ModeradorForms();?>
	<input type='hidden' id="paginaUsuarioId" value="<?php echo $paginaUsuario;?>">
	<div class="perfilColunaPrincipal">
		<div class="perfilCabecalho">
			<h3>
				<div id="nomeUsuarioPagina" style='color: #fff;'><?php
					echo $nome;?>
				</div>
			</h3>
		</div>
		<div class="informacaoUsuarioEsquerda">
			<div class="fotoPerfil">
				<div id="fotoUsuarioPagina">
					<img src="<?php echo $fotoUs;?>" alt="fotoDePerfil" />
				</div>
			</div>
			<div id='tipoUsuarioHiddenInput'>
				<input type='hidden' id='tipoUsuarioH' value="<?php echo $tipoUsuario;?>" />
			</div>
			<div id='tipoUsuarioArea'><?php
				echo $usObj->exibirTipoUsuarioPerfil($paginaUsuario, $tipoUsuario);?>
			</div>
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
					<div id="listaAmigos"><?php
						if(isset($_SESSION['logUsuario'])){
							if(empty($_GET['us']) || $_SESSION['logUsuario'] == $_GET['us'])
								$amigObj->exibirAmigos($logU);
							else
								$amigObj->exibirAmigos($get);
						}else
							$amigObj->exibirAmigos($get);?>
					</div>
				</div>
			</div>
	<!-----------------------------------
	--- MENSAGEM
	------------------------------------><?php
			if(isset($_SESSION['logUsuario'])){
				if(empty($_GET['us']) || ($_SESSION['logUsuario'] == $_GET['us'])){ ?>
					<div class="cMensagens">
						<div style="margin-top: 20px; padding: 0 8px 0 8px;" class="divConteMarg"><?php
							$mesObj->checarTodasConversas($_SESSION['logUsuario']) ?>
						</div>
					</div><?php
				}else{ ?>
					<div class="cMensagens">
						<div style="margin-top: 20px; padding: 0 8px 0 8px;" class="divConteMarg">
							<a href="chat.php?u=<?php echo $_GET['us'];?>" class="btn btnAzul abrirChatBotao">
								abrir chat
							</a>
						</div>
					</div><?php
				}
			}else{ ?>
				<div class="cMensagens">
					<div style="margin-top: 20px; padding: 0 8px 0 8px;" class="divConteMarg">
						<small style="margin: 0 0 0 7%;">*Voce nao esta logado, nao pode enviar mensagens</small>
					</div>
				</div><?php
			} ?>
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