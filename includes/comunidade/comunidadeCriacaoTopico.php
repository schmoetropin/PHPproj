<?php
if(empty($checarIncludeRequire)){
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
}?>
<div class="fundoOpacoPadrao"></div>
<div id="criarTopicoCaixa">
	<img src="assets/imagens/imagemFundo/imagemLado_3.jpeg" class="LadoTopicoImagem">
	<img src="assets/imagens/icones/topic-512.png" class="topicoIconeTopo">
	<h2>novo topico</h2>
	<img src="assets/imagens/icones/close.png" id="fecharCriarTopicoCaixa" class="botaoFecharPadrao">
	<form id="postarTopicoForm" method="POST" enctype="multipart/form-data" onsubmit="return false">
		<small style="margin-left: 3%;">Titulo do topico precisa estar entre 4 e 90 caracteres</small><br>
		<input type="text" name="tituloTopico" id="tituloTopico" placeholder="Titulo do topico" required><br>
		<div class="contadorTituloTopico"></div><br>
		<small style="margin-left: 3%;">Conteudo do topico precisa ser maior que 2 caracteres</small><br>
		<textarea name="conteudoTopico" id="conteudoTopico" placeholder="Conteudo do topico" rows="6" required></textarea>
		<div class="contadorConteudoTopico"></div>
		<div id="adicionarMidia">
			<div id="tipRadio">
				<input type="radio" name="topicoArquivoRadio" id="topicoArquivoRadio" class="uploadArquivoForm" value="upload">Upload imagem/video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<div id="tipRadio">
				<input type="radio" name="topicoArquivoRadio" id="topicoArquivoRadio" class="linkImagemForm" value="linkImagem">Link imagem&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<div id="tipRadio">
				<input type="radio" name="topicoArquivoRadio" id="topicoArquivoRadio" class="linkVideoForm" value="linkVideo">Link youtube&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<div id="tipRadio">
				<input type="radio" name="topicoArquivoRadio" id="topicoArquivoRadio" class="semMidiaForm" checked="checked" value="nenhum" required>Sem midia<br>
			</div>
			<input type="hidden" id="tipoMidiaPrevisualizacao" value="nenhum">
			<input type="file" name="topicoUpload" id="topicoUpload" style="display: none;">
			<input type="text" name="topicoLink" id="topicoLink" placeholder="" style="display: none;"><br>
		</div>
		<small style="margin-left: 3%;">Pre-visualisacao midia:</small>
		<div id="detalhesUpload">
			<div id="uploadProgressoTexto">20%: 200 bytes de 1000</div>
			<div id="barraUpload">
				<div id="uploadBarraDeProgresso"></div>
			</div>
		</div>
		<div class='previsualizacaoMidia'></div>
		<input type="hidden" name="topicoComunidade" value="<?php echo $_GET['c'];?>">
		<input type="submit" class="btn btnAzul" name="postarTopico" id="postarTopico" value="Criar Topico">
	</form>
</div>
<div class="mensagemErroDiv" id="mensagemErroDivCriarTopico">
	<div id="mensagemPostarTopicoDiv" class="mensagemErro"></div>
	<button id="fecharCriarTopMes" class="btn btnVermelho">ok</button>
</div>
<div class="fundoOpacoMensagemErro" id="fundoOpacoMensagemErroCriarTopico"></div>