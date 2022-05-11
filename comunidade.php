<?php
	require_once('includes/header.php');
	RedirecionarPagina::redirecionarComplementoEnderecoNaoExistente($_SERVER['REQUEST_URI']);
	$comunPasta = 'includes/comunidade/';
	// TOPO E INDICE COMUNIDADE
	require_once($comunPasta.'comunidadeTopo.php');?>
	<div class="comunidadeColunaPrincipal">
		<small style="margin: 0 0 0 3%;">Topicos mais populares:</small>
		<div class="top4Topicos"><?php
			$exbTop4->exibirto4Topicos($comId);
		?></div>
		<small style="left: 3%; position: absolute;">Topicos:</small>
		<div class="areaTopicos"><?php
			$exbTop->exibirTodosTopicos($comId);
		?></div><?php 
		// BARRA DIREITA COMUNIDADE
		require_once($comunPasta.'comunidadeBarraDireita.php');?>
	</div><?php
	if(isset($_SESSION['logUsuario'])){
		// CRIACAO TOPICO
		require_once($comunPasta.'comunidadeCriacaoTopico.php');
		$uObj = new Usuario($logU);
		$checUs = $uObj->getTipoUsuario();
		if($modObj->checarModerador($logU, $comId) || $checUs == 3){
			$nome = $comObj->getNome();
			$arquivo = $comObj->getFotoComunidade();
			$dercricao = $comObj->getDescricao();
			// EDITAR COMUNIDADE
			require_once($comunPasta.'comunidadeEditarComunidade.php');
		}
	} 
	include('includes/footer.php');
?>