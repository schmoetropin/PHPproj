<?php 
    if(empty($checarIncludeRequire)){
        if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
            <h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
            exit();
        }
    }
    $jsPasta = 'assets/js/';?>
    <script src='<?php echo $jsPasta;?>barraTopoScript.js'></script>
    <script src='<?php echo $jsPasta;?>comunidadeScript.js'></script>
    <script src='<?php echo $jsPasta;?>indexScript.js'></script>
    <script src='<?php echo $jsPasta;?>jQuery.js'></script>
    <script src='<?php echo $jsPasta;?>perfilAmigoScript.js'></script>
    <script src='<?php echo $jsPasta;?>perfilCabecalhoScript.js'></script>
    <script src='<?php echo $jsPasta;?>perfilScript.js'></script>
    <script src='<?php echo $jsPasta;?>perfilMensagensScript.js'></script>
    <script src='<?php echo $jsPasta;?>perfilModeradorScript.js'></script>
    <script src='<?php echo $jsPasta;?>midiaCriacaoEdicaoTopicoScript.js'></script>
    <script src='<?php echo $jsPasta;?>regLogScript.js'></script>
    <script src='<?php echo $jsPasta;?>script.js'></script>
    <script src='<?php echo $jsPasta;?>topicoScript.js'></script><?php
    if(isset($_SESSION['exibirEsconderBarraTopo'])){
        $barra = $_SESSION['exibirEsconderBarraTopo'];
        if($barra == 'exibir'){?>
            <script src='<?php echo $jsPasta;?>exibirBarraTopoScript.js'></script><?php
        }else if($barra == 'esconder'){?>
            <script src='<?php echo $jsPasta;?>esconderBarraTopoScript.js'></script><?php
        }
    }
?>