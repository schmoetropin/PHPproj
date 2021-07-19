<?php
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){
        echo '<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small>';
        exit();
    }
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET');
    header('Access-Contrel-Allow-Headers, Origin, X-Requested-With, Content-Type, Accept');
    require_once('Restauracao.php');
    $resObj = new Restauracao();

    if(isset($_POST['restaurar']))
        $resObj->restaurarPadrao($_POST['restaurar']);
?>