<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
	class FormatarValoresInseridos{
		public static function formatarTexto($texto){
			$texto = strip_tags($texto);
			return $texto;
		}
		
		public static function formatarEmail($email){
			$email = strip_tags($email);
			$email = strtolower($email);
			$email = str_replace(' ', '', $email);
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);
			return $email;
		} 
	};
?>
