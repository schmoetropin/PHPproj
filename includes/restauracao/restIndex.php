<?php
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){
        echo '<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small>';
        exit();
    }
    $nu = new CriarNomeUnico();
    $usId = $nu->selecionarId($_SESSION['logUsuario'], 'usuario');
    $uOb = new Usuario($usId);
    $tipo = $uOb->getTipoUsuario();
    if($tipo == 4){ ?>
        <button class="btn btnVerde restauracaoBotao1">upload arquivos</button>
        <button class="btn btnVerde restauracaoVaziaBotao">resetar dados</button>
        <style>
            .restauracaoVaziaBotao,
            .restauracaoBotao1 {
                position: absolute;
                top: -60px;
                right: 12px;
                height: 3em;
                width: 9em;
                font-size: 16px;
            }

            .restauracaoVaziaBotao { top: -120px;}
        </style>
        <script src="includes/restauracao/restScript.js"></script><?php 
    }
?>