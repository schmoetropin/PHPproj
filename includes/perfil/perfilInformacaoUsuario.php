<?php
    if(empty($checarIncludeRequire)){
        if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
            <h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
            exit();
        }
    }
    $tipo = $usObj->getNomeTipoUsuario();
    if($tipo != 'administrador'){?>
        <li>Email: 
            <div id="emailUsuarioPagina" style='display: inline;'><?php
                echo $usObj->getEmail();?>
            </div>
        </li>
        <li>Topicos: <?php echo $usObj->getNumeroTopicos();?></li>
        <li>Posts: <?php echo $usObj->getNumeroPosts();?></li>
        <li>Amigos: <?php echo $usObj->getNumeroAmigos();?></li>
        <li>Inscricoes: <?php echo $usObj->getNumeroInscricoes();?></li><?php 
    }else{
        if(isset($_SESSION['logUsuario'])){
            if(empty($_GET['us']) || $_SESSION['logUsuario'] == $_GET['us']){?>
                <li>Email: 
                    <div id="emailUsuarioPagina" style='display: inline;'><?php
                        echo $usObj->getEmail();?>
                    </div>
                </li>
                <li>Topicos: <?php echo $usObj->getNumeroTopicos();?></li>
                <li>Posts: <?php echo $usObj->getNumeroPosts();?></li>
                <li>Amigos: <?php echo $usObj->getNumeroAmigos();?></li>
                <li>Inscricoes: <?php echo $usObj->getNumeroInscricoes();?></li><?php 
            }
        }
    }
    if(isset($_SESSION['logUsuario'])){
        if(empty($_GET['us']) || ($_SESSION['logUsuario'] == $_GET['us'])){?>
            <li class="logoutPerfil"><button class="btn btnVermelho" id="botaoLogoutPerfil">Logout</button></li><?php 
        }
    }
?>