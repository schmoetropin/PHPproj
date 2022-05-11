<?php
	if(empty($checarIncludeRequire)){
		if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
			<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
			exit();
		}
	}
	require_once('includesRequire.php');
	if(isset($_SESSION['logUsuario'])){
		$nomeUn = new CriarNomeUnico();
		$logU = $nomeUn->selecionarId($_SESSION['logUsuario'], 'usuario');
		$usObj = new Usuario($logU);
	}else
		$usObj = new Usuario();?>
	<!DOCTYPE html>
	<html><?php 
		require_once('header/headerHead.php');?>	
		<body>
			<header id="barraTopo">
	<!-- LOGO -->
				<a href="index.php"><img src="assets/imagens/icones/logo.png" id="logo"></a>
	<!-- BARRA DE PESQUISA -->
				<div id="barraPesquisaTopo">
					<img src="assets/imagens/icones/x-mark.png" id="limparBarraPesquisa">
					<form method="GET" action="pesquisa.php"><?php
						if(isset($_GET['c'])){ ?>
							<input type="hidden" name="c" value="<?php echo $_GET['c'];?>">
							<input type="text" placeholder="Pesquisar topico..." id="barraDePerquisa" name="resultado" required><?php 
						}else{ ?>
							<input type="text" placeholder="Pesquisar comunidade..." id="barraDePerquisa" name="resultado" required><?php 
						}?>
						<button type="submit"><img src="assets/imagens/icones/search.png"></button>
					</form>
				</div>
	<!-- BOTAO ESCONDER BARRA -->
				<form method="POST" id="esconderBarraTopo" onsubmit="return false">
					<input type="hidden" name="exibirEsconderBarraTopo" value="esconder">
					<button id="botaoEsconderBarraTopo" class="btnInvisivel"><img src="assets/imagens/icones/arrowup.png" id="imgEsconderBarraTopo"></button>		
					</form>			
	<!-- ICONES HOME, LOGIN, PERFIL, REGISTRO E LOGOUT -->
				<!-- ICONES ALTA RESOLUCAO -->
				<ul id="altaResolucaoUlBarraTopo">
					<li><a href="index.php"><img src="assets/imagens/icones/home.png"></a></li><?php		
					if(isset($_SESSION['logUsuario'])){?>
						<li><a href="perfil.php"><img src="assets/imagens/icones/user.png"></a></li>
						<li><button class="btnInvisivel botaoLogout"><img src="assets/imagens/icones/logout.png" id="botaoLogout"></button></li><?php 	
					}else if(empty($_SESSION['logUsuario'])){?>
						<li><button id="botaoLogin" class="btnInvisivel botaoLogin"><img src="assets/imagens/icones/login.png"></button></li>
						<li><button id="botaoRegistro" class="btn btnVermelho botaoRegistro">registrar</button></li><?php 
					}?>
				</ul>
				<button class="btnInvisivel" id="botaoMenuUlBarraTopo"><img src="assets/imagens/icones/activity-feed-32.png"></button>
				<!-- ICONES BAIXA RESOLUCAO -->
				<ul id="baixaResolucaoUlBarraTopo">
					<img src="assets/imagens/icones/close.png" id="fecharCaixaBaixRes" class="botaoFecharPadrao">
					<li><a href="index.php"><img src="assets/imagens/icones/home.png"> Index</a></li><?php	
					if(isset($_SESSION['logUsuario'])){?>
						<li><a href="perfil.php"><img src="assets/imagens/icones/user.png"> Perfil</a></li>
						<li><button class="btnInvisivel botaoLogout"><img src="assets/imagens/icones/logout.png" id="botaoLogout"> Logout</button></li>
						</ul>
						<div id='logoutS'></div><?php 
					}else if(empty($_SESSION['logUsuario'])){?>
						<li><button id="botaoLogin" class="btnInvisivel botaoLogin"><img src="assets/imagens/icones/login.png"> Login</button></li>
						<li><button id="botaoRegistro" class="btn btnVermelho botaoRegistro">registrar</button></li>
						</ul><?php 
					}?>
				<!-- FORMULARIO REGISTRO E LOGIN --><?php 
				require_once('header/headerRegistroLogin.php');?>
			</header>
			<div class="siteTopoInferirorLimite">
				<div class="barraAtrazHeadHidden">
					<!-- BOTAO EXIBIR BARRA -->
					<form method="POST" id="exibirBarraTopo" onsubmit="return false">
						<input type="hidden" name="exibirEsconderBarraTopo" value="exibir">
						<button id="botaoExibirBarraTopo" class="btnInvisivel"><img src="assets/imagens/icones/arrowdown.png" id="imagemExibirBarraTopo"></button>
					</form><?php
					if(isset($_SESSION['logUsuario'])){?>
						<!-- BOTAO PERFIL -->
						<a href="perfil.php" class="linkPerfilEscondido"><img src="assets/imagens/icones/user.png"></a><?php 
					}?>
				</div>
