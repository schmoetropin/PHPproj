<?php
if(empty($checarIncludeRequire)){
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
}?>
<div class="areaCriacaoComunidade">
	<button id="botaoCriarComunidade" class="btn btnVermelho">Criar Comunidade</button>
	<div class="fundoOpacoPadrao"></div>
	<div id="caixaCriarCominidade">
		<div id="imagemLateralCriarComunidade">
			<img src="assets/imagens/imagemFundo/imagemLado_2.jpg">
		</div>
		<img src="assets/imagens/icones/section-512.png" class="comunidadeIconeTopo">
		<h3>Criar Comunidade</h3>
		<img src="assets/imagens/icones/close.png" id="fecharCaixaCriarCominidade"  class="botaoFecharPadrao">
		<form method="POST" id="criarComunidadeForm" enctype="multipart/form-data" onsubmit="return false">
			<small style="margin-left: -13%;">Imagem da comunidade:</small><br>
			<div class="previsualisacaoImgCom">
				<img id="pevImagCom" src="">
			</div>
			<input type="file" name="fotoComunidade" id="fotoCriacaoComunidade" required><br>
			<small>Nome da comunidade minimo 3 caracteres e maximo 25</small>
			<input type="text" name="nomeComunidade" id="nomeComunidade" placeholder="Nome da comunidade" required><br><br>
			<div class="contadorNomeComunidade"></div><br>
			<small>Descricao da comunidade minimo 3 caracteres e maximo 150</small>
			<textarea name="descricaoComunidade" id="descricaoComunidade" rows="8" cols="58" placeholder="Descricao da comunidade"></textarea><br>
			<div class="contadorDescricaoComunidade"></div>
			<div id="mensagemComunidade"></div>
			<input type="submit" name="inputCriarComunidade" id="inputCriarComunidade" class="btn btnAzul" value="Criar"><br>
		</form>
	</div>
</div>