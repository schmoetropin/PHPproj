<?php
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
        <h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
        exit();
    }
    require_once('../includesRequire.php');
    $admObj = new Admin();

    
?>