<?php
    if(empty($checarIncludeRequire)){
        if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
            <h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
            exit();
        }
    }
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET');
    header('Access-Control-Allow-Headers, Origin, X-Requested-With, Content-Type, Accept');
    session_start();
    ob_start();
    date_default_timezone_set('America/Sao_Paulo');
    require_once('classes/Conexao.php');
    require_once('classes/Admin.php');
    require_once('classes/AtualizarMesasColunas.php');
    require_once('classes/Amigos.php');
    require_once('classes/ChecarArquivo.php');
    require_once('classes/ChecarValoresInseridos.php');
    require_once('classes/Comunidade.php');
    require_once('classes/CriarComunidade.php');
    require_once('classes/CriarNomeUnico.php');
    require_once('classes/ExibirComunidade.php');
    require_once('classes/FormatarValoresInseridos.php');
    require_once('classes/Inscrever.php');
    require_once('classes/Like.php');
    require_once('classes/Mensagem.php');
    require_once('classes/Moderador.php');
    require_once('classes/ModeradorForms.php');
    require_once('classes/Pesquisar.php');
    require_once('classes/Post.php');
    require_once('classes/RedirecionarPagina.php');
    require_once('classes/Registro.php');
    require_once('classes/Topico.php');
    require_once('classes/TopicoTipoUsuarioConteudo.php');
    require_once('classes/CriarTopico.php');
    require_once('classes/ExibirTopico.php');
    require_once('classes/ExibirTop4Topicos.php');
    require_once('classes/ExibirPost.php');
    require_once('classes/Usuario.php');
    $checarIncludeRequire = 'sim';
?>