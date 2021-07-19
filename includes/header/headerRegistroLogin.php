<?php
if(empty($checarIncludeRequire)){
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
}?>
<!-- LOGIN -->
<div id="caixaLogin">
<form method="POST" id="loginForm" onsubmit="return false">
    <input type="email" id="logEmail" name="logEmail" placeholder="Email" required><br>
    <input type="password" id="logSenha" name="logSenha" placeholder="Senha" required><br>
    <input type="submit" value="Login" class="btn btnAzul" id="inputLoginForm">
</form>
<div id="mensagemLogin"></div>
</div>
<!-- REGISTRO -->
<div class="fundoOpacoPadrao"></div>
<div id="caixaRegistro">
    <img src="assets/imagens/imagemFundo/imagemLado_1.jpg" id="imagemLadoRegistro">
    <div class="imagenIconeRegistro">
        <img src="assets/imagens/icones/register-head-icon.png">
    </div>
    <img src="assets/imagens/icones/close.png" id="fecharCaixaRegistro" class="botaoFecharPadrao">
    <form method="POST" id="registroForm" onsubmit="return false">
        <input type="text" id="regNome" name="regNome" placeholder="Nome" required><br>
        <input type="email" id="regEmail" name="regEmail" placeholder="Email" required><br>
        <input type="email" id="regEmail2" name="regEmail2" placeholder="Confirmar Email" required><br>
        <input type="password" id="regSenha" name="regSenha" placeholder="Senha" required><br>
        <input type="password" id="regSenha2" name="regSenha2" placeholder="Confirmar Senha" required><br>
        <input type="submit" value="Registrar" class="btn btnVermelho" id="inputRegistroForm" name="inputRegistroForm">
    </form>
    <div id="mensagemRegistro"></div>
</div>