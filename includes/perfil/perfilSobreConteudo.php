<?php
if(empty($checarIncludeRequire)){
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
}?>
<div style="margin-top: 20px; padding: 0 8px 0 8px;" class="divConteMarg"><?php
	if(isset($_SESSION['logUsuario'])){
		if(empty($_GET['us']) || ($_SESSION['logUsuario'] == $_GET['us'])){?>
			<!-- LOGGED NA PROPRIA PAGINA -->
			Descricao:
<<<<<<< HEAD
			<div class="exibirUsuarioDescricao"><?php
				$usObj->getDescricaoPerfil();?>
			</div>
=======
			<div class="exibirUsuarioDescricao"></div>
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			Inscricoes: 
			<div class="usuarioInscricoes">
				<?php echo $usObj->exibirComunidadesInscritas($logU);?>
			</div>
			<button id="botaoEditarPerfilCaixa" class="btn btnAzul">editar perfil</button>
			<div class='editarPerfilCaixa'>
				<div class="tFotoPerfil">
					<p>Tocar foto:</p>
					<form method="POST" id="trocarFotoPerfilForm" enctype="multipart/form-data" onsubmit="return false">				
						<input type="file" id="trocarFotoPerfil" name="trocarFotoPerfil" required>
						<input type="submit" id="trocarFotoPerfilBotao" class="btn btnAzul" name="trocarFotoPerfilBotao" value="trocar foto">
					</form>
				</div>
				<div class="tNome">
					<p>Trocar nome:</p>
					<form method="POST" id="trocarNomeForm" onsubmit="return false">
						<input type="text" id="trocarNome" name="trocarNome" placeholder="Nome" required>
						<input type="submit" id="trocarNomeBotao" class="btn btnAzul" value="trocar nome">
					</form>
				</div>
				<div class="tEmail">
					<p>Trocar email:</p>
					<form method="POST" id="trocarEmailForm" onsubmit="return false">
						<input type="email" id="trocarEmail" name="trocarEmail" placeholder="Email" required>
						<input type="email" id="trocarEmail2" name="trocarEmail2" placeholder="Confirmar Email" required>
						<input type="submit" id="trocarEmailBotao" class="btn btnAzul" value="trocar Email">
					</form>
				</div>
				<div class="tSenha">
					<p>Trocar senha:</p>
					<form method="POST" id="trocarSenhaForm" onsubmit="return false">
						<input type="password" id="trocarSenha" name="trocarSenha" placeholder="Senha" required>
						<input type="password" id="trocarSenha2" name="trocarSenha2" placeholder="Confirmar senha" required>
						<input type="submit" id="trocarSenhaBotao" class="btn btnAzul" value="trocar senha">
					</form>
				</div>
				<div class="tDescricao">
					<p>Descricao:</p>
					<form method="POST" id="trocarDescricaoForm" onsubmit="return false">
						<textarea id="trocarDescricao" name="trocarDescricao" rows="10"></textarea><br>
						<input type="submit" id="trocarDescricaoBotao" class="btn btnAzul" value="postar descricao">
					</form>
				</div>
			</div><?php	
		}else{?>
			<!-- LOGGED NA PAGINA DE OUTRO USUARIO -->
			Descricao:
			<div class="exibirUsuarioDescricao"></div>
			Inscricoes: 
			<div class="usuarioInscricoes">
				<?php echo $usObj->exibirComunidadesInscritas($get);?>
			</div><?php
			$usLogObj = new Usuario($nomeU->selecionarId($_SESSION['logUsuario'], 'usuario'));
			$tipoU = $usLogObj->getTipoUsuario();
			if($tipoU == 3){ ?>
				<button id="botaoEditarPerfilCaixa" class="btn btnAzul">editar perfil</button>
				<div class='editarPerfilCaixa'>
					<div class="tFotoPerfil">
						<p>Trocar foto:</p>
						<form method="POST" id="trocarFotoPerfilForm" enctype="multipart/form-data" onsubmit="return false">				
							<input type="file" id="trocarFotoPerfil" name="trocarFotoPerfil" required>
							<input type="submit" id="trocarFotoPerfilBotao" class="btn btnAzul" name="trocarFotoPerfilBotao" value="trocar foto">
						</form>
					</div>
					<div class="tNome">
						<p>Trocar nome:</p>
						<form method="POST" id="trocarNomeForm" onsubmit="return false">
							<input type="text" id="trocarNome" name="trocarNome" placeholder="Nome" required>
							<input type="submit" id="trocarNomeBotao" class="btn btnAzul" value="trocar nome">
						</form>
					</div>
					<div class="tDescricao">
						<p>Descricao:</p>
						<form method="POST" id="trocarDescricaoForm" onsubmit="return false">
							<textarea id="trocarDescricao" name="trocarDescricao" rows="10"></textarea><br>
							<input type="submit" id="trocarDescricaoBotao" class="btn btnAzul" value="postar descricao">
						</form>
					</div>
				</div>
	<?php	}
		}
	}else{?>
		<!-- LOGGED OFF -->
		Descricao:
		<div class="exibirUsuarioDescricao"></div>
		Inscricoes: 
		<div class="usuarioInscricoes">
			<?php echo $usObj->exibirComunidadesInscritas($get);?>
		</div><?php 
	}?>
</div>