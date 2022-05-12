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
<<<<<<< HEAD
            <div id="reqModRecebidaArea"><?php
                $mFObj->exibirModRequisicaoRecebida($_SESSION['logUsuario']);?>
            </div>
            <div id="reqModEnviadaArea"><?php
                $modObj->exibirTodosModRequisicaoEnviada($logU);?>
            </div>
            <div id="checarReqAmRecEnv"><?php
                $amigObj->checarRequerimentosDeAmizadeRecebido($_SESSION['logUsuario']);
                $amigObj->checarTodosRequerimentosDeAmizadeEnviado($_SESSION['logUsuario']);?>
            </div><?php				
        }else{
            $checUs = $UsNullObj->tipoUsuario($logU);?>
            <input type="hidden" id="logUsuario" value="<?php echo $_SESSION['logUsuario'];?>" />
            <input type="hidden" id="paginaUsuario" value="<?php echo $_GET['us'];?>" /><?php
            if($checUs > 1){?>
                <div id="modRequerimentoFormArea"><?php
                    $mFObj->requisicaoModerador($_SESSION['logUsuario'], $_GET['us']);?>
                </div>
                <div id="reqModUsuarioEnviadaArea"><?php
                    $modObj->exibirModRequisicaoEnviadaUsuario($logU, $get);?>
                </div><?php
            }?>
            <small style="margin: 0 0 0 12%;">Pedidos de amizade:</small><br><br>
            <div id="requerimentoAmigoAbaArea"><?php
                if($_SESSION['logUsuario']){ 
                    if($logU != $get){
                        $checar = $amigObj->checarListaDeAmigos($logU, $get);
                        if($checar)
                            $amigObj->removerAmigoForm($_GET['us']);    
                        else{
                            $checar = $amigObj->checarRequisicaoAmizade($logU, $get);
                            if($checar > 0)
                                $amigObj->exibirRequizicaoAmizadeEnviadoUsuario($get);
                            else
                                $amigObj->formularioRequerimentoAmizade($_SESSION['logUsuario'], $_GET['us']);
                        }
                    }
                }?>
            </div><?php
        }
    }else{?>
=======
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
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
        <small style="margin: 0 0 0 7%;">*Voce nao esta logado</small><?php
    }
?>