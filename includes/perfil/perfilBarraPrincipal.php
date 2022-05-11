<?php
if(empty($checarIncludeRequire)){
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
}?>
<div class="barraTopoPerfil">
    <div id="AltRes">
        <h4 id="btSobre" class="btTopoPerfil">Sobre</h4>
        <h4 id="btTopicos" class="btTopoPerfil">Topicos</h4>
        <h4 id="btPosts" class="btTopoPerfil">Posts</h4>
        <h4 id="btAmigos" class="btTopoPerfil">Amigos</h4>
        <h4 id="btMensagens" class="btTopoPerfil">Mensagens</h4>
        <h4 id="btRequerimento" class="btTopoPerfil">Requerimento</h4>
    </div>
    <div id="baixRes">
        <button  class="btnInvisivel" id="baixResBotao"><img src="assets/imagens/icones/activity-feed-32.png"></button>
        <div id="baixResMenu">
            <h4 id="brSobre">Sobre</h4>
            <h4 id="brTopicos">Topicos</h4>
            <h4 id="brPosts">Posts</h4>
            <h4 id="brAmigos">Amigos</h4>
            <h4 id="brMensagens">Mensagens</h4>
            <h4 id="brRequerimento">Requerimento</h4>
        </div>
    </div>
</div>