<?php
    if(empty($checarIncludeRequire)){
        if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
            <h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
            exit();
        }
    }
    if(isset($_SESSION['logUsuario'])){
        if(empty($_GET['us']) || ($_SESSION['logUsuario'] == $_GET['us'])){?>
            <input type="hidden" id="logUsuario" value="<?php echo $_SESSION['logUsuario'];?>">
            <input type="hidden" id="paginaUsuario" value="nenhum">
            <div id="reqModRecebidaArea"></div>
            <div id="reqModEnviadaArea"></div>
            <div id="checarReqAmRecEnv"></div><?php				
        }else{
            $checUs = $UsNullObj->tipoUsuario($logU);?>
            <input type="hidden" id="logUsuario" value="<?php echo $_SESSION['logUsuario'];?>">
            <input type="hidden" id="paginaUsuario" value="<?php echo $_GET['us'];?>"><?php
            if($checUs > 1){?>
                <div id="modRequerimentoFormArea"></div>
                <div id="reqModUsuarioEnviadaArea"></div><?php
            }?>
            <small style="margin: 0 0 0 12%;">Pedidos de amizade:</small><br><br>
            <div id="requerimentoAmigoAbaArea"></div><?php
        }
    }else if(empty($_SESSION['logUsuario']) && isset($_GET['us'])){?>
        <small style="margin: 0 0 0 7%;">*Voce nao esta logado</small><?php
    }
?>