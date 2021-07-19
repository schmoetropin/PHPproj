<?php
    if(empty($checarIncludeRequire)){
        if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
            <h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
            exit();
        }
    }
    require_once('../includesRequire.php');
    $pesObj = new Pesquisar();
    $nomeU = new CriarNomeUnico();

    if(isset($_POST['pesquisaTop'])){
        $comunidade = $nomeU->selecionarId($_POST['comunidade'], 'comunidade');
        echo $pesObj->exibirResultadoTopicos($_POST['pesquisaTop'], $comunidade);
    }
    
    if(isset($_POST['pesquisaCom']))
        echo $pesObj->exibirResultadoComunidades($_POST['pesquisaCom']);
?>