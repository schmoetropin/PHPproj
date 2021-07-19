<?php 
	if(empty($checarIncludeRequire)){
		if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
			<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
			exit();
		}
	}
	$nomeU = new criarNomeUnico();
	if(isset($_SESSION['logUsuario'])){
		$logU = $nomeU->selecionarId($_SESSION['logUsuario'], 'usuario');
		if(empty($_GET['us']) || ($_SESSION['logUsuario'] == $_GET['us'])){
			$usObj = new Usuario($logU);
			$nome = $usObj->getNome();
			$paginaUsuario = $_SESSION['logUsuario'];?>
			<div class='perfilIndice'>
				<a href='index.php'>Index</a> /
				<a href='perfil.php'><?php echo $nome;?></a>
			</div><?php
		}else{
			$get = $nomeU->selecionarId($_GET['us'], 'usuario');;
			$paginaUsuario = $_GET['us'];
			$checarUs = $usObj->checarUsuario($get);
			if($checarUs){
				$usObj = new Usuario($get);
				$nome = $usObj->getNome();
				$nU = $usObj->getNomeUnico();?>
				<div class='perfilIndice'>
					<a href='index.php'>Home</a> /
					<a href='perfil.php?us=<?php echo $nU;?>'><?php echo $nome;?></a>
				</div><?php
			}else{
				header('Location: index.php');
				exit();
			}
		}
	}else if(empty($_SESSION['logUsuario']) && isset($_GET['us'])){
		$get = $nomeU->selecionarId($_GET['us'], 'usuario');
		$paginaUsuario = $_GET['us'];
		$checarUs = $usObj->checarUsuario($get);
		if($checarUs){
			$usObj = new Usuario($get);
			$nome = $usObj->getNome();
			$nU = $usObj->getNomeUnico();?>
			<div class='perfilIndice'>
				<a href='index.php'>Home</a> /
				<a href='perfil.php?us=<?php echo $nU;?>'><?php echo $nome;?></a>
			</div><?php
		}else{
			header('Location: index.php');
			exit();
		}
	}else{
		header('Location: index.php');
		exit();
	}
?>