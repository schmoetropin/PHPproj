<?php
if(empty($checarIncludeRequire)){
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
}?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- CSS --><?php
    $pastaCss = 'assets/css/';
    $pastaCssRes = 'resolucoes/';?>
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss;?>caixasPosicaoFixaStyle.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss;?>padraoReutilizavelStyle.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss;?>headerStyle.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss;?>indexComunidadesStyle.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss;?>comunidadeTopicosStyle.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss;?>topicoPostsStyle.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss;?>perfilStyle.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss;?>style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss;?>top4TopicosStyle.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss.$pastaCssRes;?>max-width1333.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss.$pastaCssRes;?>max-width1330.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss.$pastaCssRes;?>max-width1300.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss.$pastaCssRes;?>max-width1265.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss.$pastaCssRes;?>max-width1160.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss.$pastaCssRes;?>max-width1000.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss.$pastaCssRes;?>max-width950.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss.$pastaCssRes;?>max-width900.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss.$pastaCssRes;?>max-width890.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss.$pastaCssRes;?>max-width770.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss.$pastaCssRes;?>max-width750.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss.$pastaCssRes;?>max-width700.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss.$pastaCssRes;?>max-width650.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss.$pastaCssRes;?>max-width615.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss.$pastaCssRes;?>max-width562.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss.$pastaCssRes;?>max-width490.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss.$pastaCssRes;?>max-width470.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $pastaCss.$pastaCssRes;?>max-width396.css">
<!-- JS -->
    <script src="assets/js/jQuery.js"></script>
    <script src="assets/js/script.js"></script>
</head>