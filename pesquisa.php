<?php 
    include('includes/header.php');
    $red = new RedirecionarPagina();
    $red::redirecionarPesquisa($_GET['resultado']);
    $resultado = strip_tags($_GET['resultado']);
    if(isset($_GET['c'])){
        $resultadoC = strip_tags($_GET['c']);
        require_once('includes/comunidade/comunidadeTopo.php'); ?>
        <br><br><br><small style="margin: 0 0 0 5%;">Resultados para a pesquisa "<?php echo $resultado;?>":</small>
        <div class="topicosPesquisa" style="margin: 40px 0 0 5%; width: 85%;"></div>
        <input type="hidden" id="comunidade" value="<?php echo $resultadoC;?>">
        <input type="hidden" id="pesquisaTop" value="<?php echo $resultado;?>"><?php
    }else{ 
        RedirecionarPagina::redirecionarComplementoEnderecoNaoExistente($_SERVER['REQUEST_URI']);?>
        <small style="margin: 0 0 0 5%;">Resultados para a pesquisa "<?php echo $resultado;?>":</small>
        <div class="indexColunaPrincipal"></div>
        <input type="hidden" id="pesquisaCom" value="<?php echo $resultado;?>"><?php 
    } 
    include('includes/footer.php');
?>