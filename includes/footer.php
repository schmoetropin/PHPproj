<?php
	if(empty($checarIncludeRequire)){
		if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
			<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
			exit();
		}
	}?>		
		</div>
		<footer>
			<p>criado por: marcos paulo peters braga 2020</p><?php 
			if(isset($_SESSION['logUsuario']))
				require_once('restauracao/restIndex.php');?>
		</footer><?php 
		require_once('footer/footerJsScripts.php');?>
	</body>
</html>