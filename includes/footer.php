<?php
	if(empty($checarIncludeRequire)){
		if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
			<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
			exit();
		}
	}?>		
		</div>
<<<<<<< HEAD
		<div class="copiarEmailMens" id="copiarEmailMens">Copiar email</div>
		<div id="enviarEmailDiv" class="enviarEmailDiv">
			Email: <input type="text" id="emailDeContato" value="schmoemaster@gmail.com" disabled />
			<button id="copiarEmailDeContato" class="btn btnAzul">Copiar</button>
		</div>
		<footer>
			<p style="float: left;">criado por: marcos paulo peters braga</p>
			<div class="footerLinksContato" style="float: right; margin: 2px 1% 0 0;">
				<p style="float: left; margin: -2px 4px 0 0; font-weight: bold;">Contato: </p>
				<a href="https://www.linkedin.com/in/marcos-paulo-peters-braga-4a9351229/" target="_blank" rel="noopener noreferrer">
					<img src="assets/imagens/icones/linkedin-3-24.png" alt="linkedin" />
				</a>
				<a href="https://github.com/schmoetropin" target="_blank" rel="noopener noreferrer">
					<img src="assets/imagens/icones/github-10-24.png" alt="github" />
				</a>
				<a href="https://www.instagram.com/marcospaulopeters/" target="_blank" rel="noopener noreferrer">
					<img src="assets/imagens/icones/instagram-5-24.png" alt="instagram" />
				</a>
				<a href="https://wa.me/5531984644214" target="_blank" rel="noopener noreferrer">
					<img src="assets/imagens/icones/whatsapp-24.png" alt="whatsapp" />
				</a>
				<a href="http://t.me/marcospaulopeters/" target="_blank" rel="noopener noreferrer">
					<img src="assets/imagens/icones/telegram-24.png" alt="telegram" />
				</a>
				<div id="enviarEmailIcone" style="cursor: pointer; float: right; margin-left: 3px;">
					<img src="assets/imagens/icones/email-24.png" alt="email" />
				</div>
			</div><?php 
=======
		<footer>
			<p>criado por: marcos paulo peters braga 2020</p><?php 
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			if(isset($_SESSION['logUsuario']))
				require_once('restauracao/restIndex.php');?>
		</footer><?php 
		require_once('footer/footerJsScripts.php');?>
	</body>
</html>