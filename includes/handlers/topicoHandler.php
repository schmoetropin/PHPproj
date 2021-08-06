<?php
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
        <h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
        exit();
    }
    require_once('../includesRequire.php');
    $topObj = new Topico();
    $exbTop = new ExibirTopico();
    $eT4Top = new ExibirTop4Topicos();
    $criTop = new CriarTopico();
    $nomeUn = new CriarNomeUnico();
    $tipoTU = new TopicoTipoUsuarioConteudo();
    
    // exibir todos topicos
    if(isset($_POST['topicos'])){
        $comId = $nomeUn->selecionarId($_POST['comunidade'], 'comunidade');
        $exbTop->exibirTodosTopicos($comId);
	}
    // exibir top 4 topicos
    if(isset($_POST['top4Topicos'])){
        $comId = $nomeUn->selecionarId($_POST['comunidade'], 'comunidade');
        $eT4Top->exibirto4Topicos($comId);
    }
    
    // criar novo topico
    if(isset($_POST['topicoArquivoRadio'])){
        $rad = $_POST['topicoArquivoRadio'];
        $us = $nomeUn->selecionarId($_SESSION['logUsuario'], 'usuario');
        $com = $nomeUn->selecionarId($_POST['topicoComunidade'], 'comunidade');
        $tit = $_POST['tituloTopico'];
        $con = $_POST['conteudoTopico'];
        if($rad == 'nenhum')
            $criTop->criarTopico($us, $com, $tit, NULL, NULL, $con);
        else if($rad == 'upload'){
            if($_FILES['topicoUpload']['size'] == 0)
                $criTop->criarTopico($us, $com, $tit, NULL, NULL, $con);
            else
                $criTop->criarTopico($us, $com, $tit, $_FILES['topicoUpload'], NULL, $con);
        }else if($rad == 'linkImagem'){
            if(empty($_POST['topicoLink']))
                $criTop->criarTopico($us, $com, $tit, NULL, NULL, $con);
            else{
                $link = '[*IMAGE*]'.$_POST['topicoLink'];
                $criTop->criarTopico($us, $com, $tit, NULL, $link, $con);
            }
        }else if($rad == 'linkVideo'){
            if(empty($_POST['topicoLink']))
                $criTop->criarTopico($us, $com, $tit, NULL, NULL, $con);
            else{
                $link = '[*VIDEO*]'.$_POST['topicoLink'];
                $criTop->criarTopico($us, $com, $tit, NULL, $link, $con);
            }
        }
    }

    // deletar topico
	if(isset($_POST['delTopTextComparacao'])){
        $input = $_POST['delTopTextConfirmacao'];
        $comp = $_POST['delTopTextComparacao'];
        $topico = $_POST['topico'];
        if(isset($_SESSION['logUsuario'])){
            $us = $nomeUn->selecionarId($_SESSION['logUsuario'], 'usuario');
            $uObj = new Usuario($us);
            $nome = $uObj->getNome();
            $upnome = strtoupper($nome);
            if($input == $comp.$upnome)
                $topObj->deletarTopico($topico);
        }
    };

    // exibir topico selecionado
    if(isset($_POST['exibirTopico']))
        echo $exbTop->exibirPaginaTopico($_POST['topicoId']);

    // exibe dados do topico para edicao
    if(isset($_POST['tituloTopicoEdit'])){
        $tOb = new Topico($_POST['tituloTopicoEdit']);
        echo $tOb->getTitulo();
    }

    if(isset($_POST['arquivoTopicoEdit'])){
        $tOb = new Topico($_POST['arquivoTopicoEdit']);
        $id = $tOb->getId();
        $tipo = $tOb->getTipoArquivo();
        $arquivo = $tOb->getArquivo();
        echo $tipoTU->tipoConteudo($tipo, $arquivo, 'edit', $id, 'conteudo');
    }

    if(isset($_POST['conteudoTopicoEdit'])){
        $tOb = new Topico($_POST['conteudoTopicoEdit']);
        echo $tOb->getConteudo();
    }

    // editar topico
    // editar titulo
    if(isset($_POST['editarTitulo'])){
        $top = $_POST['topPagId'];
        $tit = $_POST['editarTitulo'];
        $topO = new Topico($top);
        $mens = $topO->setTitulo($tit);
        echo $mens;
    }

    // editar midia
    if(isset($_POST['topArqRadio'])){
        $top = $_POST['topPagId'];
        $rad = $_POST['topArqRadio'];
        $lin = $_POST['topicoLink'];
        $arq = $_FILES['editarArquivo'];
        $topO = new Topico($top);
        if($rad != 'manter'){
            if($rad == 'upload'){
                if($arq['size'] > 0 || $arq['tmp_name'] != NULL || $arq['tmp_name'] != ''){
                    $mens = $topO->setArquivoUpload($arq, $top);
                    echo $mens;
                }
            }else if($rad == 'linkImagem'){
                if($lin != '' || $lin != NULL){
                    $mens = $topO->setArquivoEmbbedImagem($lin);
                    echo $mens;
                }
            }else if($rad == 'linkVideo'){
                if($lin != '' || $lin != NULL){
                    $mens = $topO->setArquivoEmbbedVideo($lin);
                    echo $mens;
                }
            }else if($rad == 'nenhum'){
                $mens = $topO->setArquivoNenhum();
                echo $mens;
            }
        }
    }

    // editar conteudo
    if(isset($_POST['editarConteudo'])){
        $top = $_POST['topPagId'];
        $con = $_POST['editarConteudo'];
        $topO = new Topico($top);
        $mens = $topO->setConteudo($con);
        echo $mens;
    }
?>