<?php
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
        <h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
        exit();
    }
    require_once('../includesRequire.php');
    $mFObj = new ModeradorForms();
    $modObj = new Moderador();
    $nomeU = new CriarNomeUnico();
    $uObj = new Usuario();

    // Formulario para convidar alguem para moderacao de comunidade
    if(isset($_POST['logUsuario']) && isset($_POST['usuario'])){
        $lUs = $nomeU->selecionarId($_POST['logUsuario'], 'usuario');
        $us = $nomeU->selecionarId($_POST['usuario'], 'usuario');
        $luT = $uObj->tipoUsuario($lUs);
        $uT = $uObj->tipoUsuario($us);
        $mFObj->requisicaoModerador($_POST['logUsuario'], $_POST['usuario']);
    }

    // Envia convite para moderacao de comunidade
    if(isset($_POST['moderador']) && isset($_POST['usuario']) && isset($_POST['comunidade'])){
        $mod = $nomeU->selecionarId($_POST['moderador'], 'usuario');
        $us = $nomeU->selecionarId($_POST['usuario'], 'usuario');
        $com = $nomeU->selecionarId($_POST['comunidade'], 'comunidade');
        if(!$modObj->checarModRequerimentos($us, $com)){
            $modObj->enviarModRequerimento($mod, $us, $com);
            echo "<small class='mensagemSucesso'>Requerimento enviado com sucesso.</small>"; 
        }else
            echo '*Outro moderador ja enviou um requerimento para o usuario.'; 
    }

    // Exibe todas as requisicoes de moderacao que foram enviadas
    if(isset($_POST['envMod'])){
        $envMod = $nomeU->selecionarId($_POST['envMod'], 'usuario');
        $modObj->exibirTodosModRequisicaoEnviada($envMod);
    }

    // Exibe todas as requisicoes de moderacao que foram enviadas para determinado usuario
    if(isset($_POST['mod']) && isset($_POST['reqUs'])){
        $mod = $nomeU->selecionarId($_POST['mod'], 'usuario');
        $reqUs = $nomeU->selecionarId($_POST['reqUs'], 'usuario');
        $modObj->exibirModRequisicaoEnviadaUsuario($mod, $reqUs);
    }

    if(isset($_POST['recMod']))
        $mFObj->exibirModRequisicaoRecebida($_POST['recMod']);

    // Aceita ou recusa de usuario a cargo de moderador
    if(isset($_POST['acetRec'])){
        $usuario = $nomeU->selecionarId($_POST['usuario'], 'usuario');
        $comunidade = $nomeU->selecionarId($_POST['comunidade'], 'comunidade');
        if($_POST['acetRec'] == 'aceitar'){
            $modObj->atualizarModUsuario($usuario, $comunidade);
            $modObj->excluirModReqUsuario($usuario, $comunidade);
        }
        if($_POST['acetRec'] == 'recusar')
            $modObj->excluirModReqUsuario($usuario, $comunidade);
    }

    // Exibe todas as comunidades de determinado moderador
    if(isset($_POST['comunMod'])){
        $comunMod = $nomeU->selecionarId($_POST['comunMod'], 'usuario');
        $mFObj->exibirComunidadesModerador($comunMod);
    }

    // Moderador renuncia o cargo de determinada comunidade
    if(isset($_POST['comunModeradorId']))
        echo $modObj->renunciarCargModerador($_POST['comunModeradorId']);
    
    // Cancela requerimento enviado para moderador de detarminado usuario        
    if(isset($_POST['cancelarReqMod']))
        $modObj->cancelarReqMod($_POST['cancelarReqMod']);
?>