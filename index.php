<?php 
	require_once('includes/header.php');
	RedirecionarPagina::redirecionarComplementoEnderecoNaoExistente($_SERVER['REQUEST_URI']);
	$comObj = new ExibirComunidade();
	if(isset($_SESSION['logUsuario'])){
		// CAIXA CRIACAO COMUNIDADE
		require_once('includes/index/indexCriacaoComunidade.php');
	}?>
	<!-- TOP 4 TOPICOS MAIS POPULARES DO FORUM -->
	<small style="margin: 0 0 0 3%;">Topicos mais populares:</small>
	<div class="top4TopicosIndex"></div>
	<!-- COMUNIDADES -->
	<small style="margin: 0 0 0 3%;">Comunidades:</small>
	<div class="indexColunaPrincipal" id="indexColunaPrincipal"></div><?php 
	if(isset($_SESSION['logUsuario'])){
		//COMUNIDADE ADMINISTRADOR MODERADOR
		$nomeU = new CriarNomeUnico();
		$obj = new Usuario($nomeU->selecionarId($_SESSION['logUsuario'], 'usuario'));
		$tipo = $obj->getTipoUsuario();
		if($tipo > 1){?>
			<small style='margin: 0 0 0 3%;'>Comunidade Administrador e Moderadores</small>
			<div class='indexColunaPrincipal'><?php $comObj->exibirComunidades('sim');?></div><?php 
		}
	} 
	include('includes/footer.php');
?>