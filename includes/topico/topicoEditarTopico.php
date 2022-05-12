<?php
	if(empty($checarIncludeRequire)){
		if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
			<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
			exit();
		}
	}
?>
<div class="fundoOpacoPadrao"></div>
<div class="editarTopico">
	<img src="assets/imagens/icones/close.png" id="fecharEditarTopico" class="botaoFecharPadrao">
	<img src="assets/imagens/icones/edit.png" id="editarTopicoLogo"><h4>Editar topico</h4>
	<div class="editarTopicoEncapForm">
		<form method="POST" id="editarTituloTopico" onsubmit="return false">
			<input type="hidden" id="topPagId" name="topPagId" value="<?php echo $_GET['t'];?>">
			<small>Titulo do topico precisa estar entre 4 e 90 caracteres</small>
			<input type="text" name="editarTitulo" id="editarTitulo" placeholder="Editar titulo" value="<?php echo $topTitulo;?>">
			<div class="contadorEditarTopicoTitulo"></div>
			<input type="submit" id="editarTituloTopicoBotao" class="btn btnVermelho btnEditarTopico" value="editar titulo">
		</form><hr class="barraDivEditTop">
		<form method="POST" id="editarMidiaTopico" enctype="multipart/form-data" onsubmit="return false">
			<input type="hidden" id="topPagId" name="topPagId" value="<?php echo $_GET['t'];?>">
			<small>Imagem/video</small><br>
			<div class="midiaOriginal">
				<small>Midia original</small>
				<div class="visualizacaoMidiaOrig"><?php
					echo $topTUC->tipoConteudo($topTipoArquivo, $topArquivo, 'edit', $topId, 'conteudo');?>
				</div>
			</div>
			<div class="midiaNova">
				<small>Midia nova</small>
				<div class='previsualizacaoMidia'></div>
			</div>
			<div id="adicionarMidia">
				<div id="tipRadio">
					<input type="radio" name="topArqRadio" id="topicoArquivoRadio" class="uploadArquivoForm" value="upload">Upload imagem/video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
				<div id="tipRadio">
					<input type="radio" name="topArqRadio" id="topicoArquivoRadio" class="linkImagemForm" value="linkImagem">Link imagem&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
				<div id="tipRadio">
					<input type="radio" name="topArqRadio" id="topicoArquivoRadio" class="linkVideoForm" value="linkVideo">Link youtube&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
				<div id="tipRadio">
					<input type="radio" name="topArqRadio" id="topicoArquivoRadio" class="semMidiaForm"  value="nenhum" required>Sem midia
				</div>
				<div id="tipRadio">
					<input type="radio" name="topArqRadio" id="topicoArquivoRadio" class="manterMidiaForm" checked="checked" value="manter" required>Manter midia<br>
				</div>
				<input type="hidden" id="tipoMidiaPrevisualizacao" value="nenhum">
				<input type="file" name="editarArquivo" id="topicoUpload" style="display: none;">
				<input type="text" name="topicoLink" id="topicoLink" placeholder="" style="display: none;"><br>
			</div>
			<input type="submit" id="editarMidiaTopicoBotao" class="btn btnVermelho btnEditarTopico" value="editar midia">
		</form><hr class="barraDivEditTop">
		<form method="POST" id="editarConteudoTopico" onsubmit="return false">
			<input type="hidden" id="topPagId" name="topPagId" value="<?php echo $_GET['t'];?>">
			<small>Conteudo do topico precisa ser maior que 2 caracteres</small>
			<textarea name="editarConteudo" id="editarConteudo" placeholder="Editar conteudo"></textarea>
			<div class="contadorEditarTopicoConteudo"></div>
			<input type="submit" id="editarConteudoTopicoBotao" class="btn btnVermelho btnEditarTopico" value="editar conteudo">
		</form>
	</div>
</div>
<div class="mensagemErroDiv" id="mensagemErroDivEditarTopico">
	<div id="editarTopicoMensagem" class="mensagemErro"></div>
	<button id="fecharEditarTopicoMes" class="btn btnVermelho">ok</button>
</div>
<div class="fundoOpacoMensagemErro" id="fundoOpacoMensagemErroEditarTopico"></div>