<?php 
	require_once('includes/header.php');
    if(empty($_SESSION['logUsuario'])){
        header('Location: index.php');
        exit();
    }
    if(isset($_GET['l'])){
        if($_GET['l'] != $_SESSION['logUsuario'] || $_GET['u'] == $_GET['l']){
            header('Location: index.php');
            exit();
        }
    }
    $redP = new RedirecionarPagina();
    $nomeU = new criarNomeUnico();
    $usId = $nomeU->selecionarId($_GET['u'], 'usuario');
    $redP->redirecUsNExistente($usId);
    $usObj = new Usuario($usId);

    $nome = $usObj->getNome();
    $foto = $usObj->getFotoDePerfil();?>
        <div class="chatArea">
            <div>
                <input type="hidden" id="logUsChat" value="<?php echo $_SESSION['logUsuario'];?>"/>
                <input type="hidden" id="getUChat" value="<?php echo $_GET['u'];?>"/>
            </div>
            <div class="usuarioChat"><?php
            if(isset($_GET['l'])){ ?>
                <a class="voltarPerfil" href="perfil.php"> <?php
            }else{ ?>
                <a class="voltarPerfil" href="perfil.php?us=<?php echo $_GET['u'];?>"><?php
            } ?>
                    <img src="assets/imagens/icones/arrow-97-24.png" alt="voltar" />
                </a>
                <div class="imagemPerfilChat">
                    <a href="perfil.php?us=<?php echo $_GET['u'];?>">
                        <img src="<?php echo $foto;?>" alt="imagemPerfil"/>
                    </a>
                </div>
                <h3><?php echo $nome;?></h3>
            </div>
            <div class="chatMensagens" id="chatCaixaMens"></div>
            <div class="chatFormDiv">
                <form id="chatForm" method="POST">
                    <input type="hidden" name="usuarioMensagem" value="<?php echo $_GET['u'];?>" />
                    <textarea name="mensagemTextarea" id="mensagemTextarea" placeholder="Digite sua mensagem aqui..."></textarea>
                    <button id="chatBotao" class="btn btnAzul">Enviar</button>
                </form>
            </div>
        </div><?php
	include('includes/footer.php');
?>