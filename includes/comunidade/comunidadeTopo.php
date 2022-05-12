<?php 
if(empty($checarIncludeRequire)){
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
}
$redPag = new RedirecionarPagina();
$nomU = new CriarNomeUnico();
$comId = $nomU->selecionarId($_GET['c'], 'comunidade');
$redPag->checarComAdmMod($comId);
$redPag->redirecComNExistente($comId);

$comObj = new Comunidade($comId);
$topObj = new Topico();
$modObj = new Moderador();
<<<<<<< HEAD
$exbTop = new ExibirTopico();
$exbTop4 = new ExibirTop4Topicos();

$insObj = new Inscrever();
=======
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36

if(isset($_SESSION['logUsuario']))
	$logU = $nomU->selecionarId($_SESSION['logUsuario'], 'usuario');

$nome = $comObj->getNome();
<<<<<<< HEAD
$fotoComunidade = $comObj->getFotoComunidade();
=======
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
$descricao = $comObj->getDescricao();
$data = $comObj->getDataCriacao();
$numeroTopicos = $comObj->getNumeroTopicos();
$numeroPosts = $comObj->getNumeroPosts();
$id = $comObj->getId();
$nomeU = $comObj->getNomeUnico();
$num = rand(1, 6);?>
<div class="comunidadeTopo">
	<input type="hidden" id="comunidade" value="<?php echo $_GET['c']?>">
	<img src="assets/imagens/imagemFundo/imagemFundo_<?php echo $num;?>.jpg" class="imagemFundo">
	<div class="inscreverCriarTopicoResBaixa">
		<?php require_once('comunidadeBarDirCriarTopInsc.php');?>
	</div>
<<<<<<< HEAD
	<div class="imagemComunidade" id="imagemComunidade">
		<img src="<?php echo $fotoComunidade;?>" alt="fotoComunidade" />
	</div><?php
=======
	<div class="imagemComunidade" id="imagemComunidade"></div><?php
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
	if(isset($_SESSION['logUsuario']) && empty($_GET['resultado'])){
		$uObj = new Usuario($logU);
		$checUs = $uObj->getTipoUsuario();
		if($modObj->checarModerador($logU, $comId) || $checUs == 3){?>
			<button class="btn btnLaranja" id="trocarFotoComunidade">trocar foto</button><?php 
		}
	}?>
<<<<<<< HEAD
	<h2 id="nomeComunidade"><?php
		echo $nome;?></h2><?php
=======
	<h2 id="nomeComunidade"></h2><?php
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
	if(isset($_SESSION['logUsuario']) && empty($_GET['resultado'])){
		$uObj = new Usuario($logU);
		$checUs = $uObj->getTipoUsuario();
		if($modObj->checarModerador($logU, $comId) || $checUs == 3){?>
			<button class="btn btnLaranja" id="trocarNomeComunidade">trocar nome</button><?php 
		}
	}?>
</div>
<div class="comunidadeIndice">
	<a href="index.php">Index</a> /
	<a href="comunidade.php?c=<?php echo $nomeU;?>"><?php echo $nome;?></a>
</div>