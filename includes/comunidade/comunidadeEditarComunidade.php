<?php
if(empty($checarIncludeRequire)){
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
}?>
<div class="fundoOpacoPadrao"></div>
<div id="editarComunidadeCaixa">
	<img src="assets/imagens/icones/edit.png" id="editarIcone">
	<h4>Moderador Editar Comunidade</h4>
	<img src="assets/imagens/icones/close.png" id="fecharEditarComunidadeCaixa" class="botaoFecharPadrao">
	<div id="editarFotoCaixa">
		<form method="POST" id="trocarFotoComForm" enctype="multipart/form-data" onsubmit="return false">
			<input type="hidden" id="comunidade" name="comunidade" value="<?php echo $_GET['c']?>">
			<div class="fotoRec">
				<small>Foto recente:</small>
<<<<<<< HEAD
				<div class="editFotoComunRecente">
					<img src="<?php echo $fotoComunidade;?>" alt="imagemEditComun" />
				</div>
=======
				<div class="editFotoComunRecente"></div>
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			</div>
			<div class="fotoNov">
				<small>Foto nova:</small>
				<div class="editFotoComunNova"><img src="" id="editFotoComunNovaPrev"></div>
			</div>
			<input type="file" name="arquivoEditarFoto" id="arquivoEditarFoto" required><br>
			<input type="submit" id="trocarFotoComunidadeBotao" value="trocar foto" class="btn btnAzul">
		</form>
	</div>
	<div id="editarNomeCaixa">
		<form method="POST" id="trocarNomeComForm" onsubmit="return false">
			<input type="hidden" id="comunidade" name="comunidade" value="<?php echo $_GET['c']?>">
			<small>Nome da comunidade minimo 3 caracteres e maximo 25</small><br>
			<input type="text" name="inputEditarNome" id="inputEditarNome" value="<?php echo $nome;?>" required><br>
			<div class="editNomeComunidadeContador" style="margin-left: 40%;"></div>
			<input type="submit" id="trocarNomeComunidadeBotao" value="trocar nome" class="btn btnAzul">
		</form>
	</div>
	<div id="editarDescricaoCaixa">
		<form method="POST" id="trocarDescricaoComForm" onsubmit="return false">
			<input type="hidden" id="comunidade" name="comunidade" value="<?php echo $_GET['c']?>">
			<small>Descricao da comunidade minimo 3 caracteres e maximo 150</small><br>
			<textarea name="txtaEditarDescricao" id="txtaEditarDescricao" required><?php
				echo $descricao;?>
			</textarea><br>
			<div class="editDescricaoComunidadeContador" style="margin-left: 40%;"></div>
			<input type="submit" id="trocarDescricaoComunidadeBotao" value="trocar descricao" class="btn btnAzul">
		</form>
	</div>
</div>
<div class="mensagemErroDiv" id="mensagemErroEditarComunidadeDiv">
	<div id="mensagemEditarComunidadeDiv" class="mensagemErro"></div>
	<button id="fecharEditarComunidadeMes" class="btn btnVermelho">ok</button>
</div>
<div class="fundoOpacoMensagemErro" id="fundoOpacoMensagemEditarComunidadeErro"></div>