<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
	class ChecarValoresInseridos extends Conexao {
		private $mensagemErro = [
	/*0*/	"*Nome precisa estar entre 4 e 25 caracteres \n", 
	/*1*/	"*Emails nao estao iguais \n",
	/*2*/	"*Email nao esta em formato valido \n",
	/*3*/	"*Email ja esta em uso \n",
	/*4*/	"*Senhas nao estao iguais \n",
	/*5*/	"*Senha precisa estar entre 5 e 25 caracteres \n",
	/*6*/	"*Senha aceita apenas letras e numeros \n",
	/*7*/	"*Descricao precisa estar entre 0 e 180 caracteres \n",
	/*8*/	"*Titulo precisa estar entre 5 e 90 caracteres \n",
	/*9*/	"*Conteudo esta vazio \n",
	/*10*/	"*Conteudo deve conter pelo menos 2 caracteres \n",
	/*11*/	"*Nome da comunidade precisa estar entre 3 e 25 caracteres \n",
	/*12*/	"*Descricao deve conter ente 3 e 150 caracteres \n",
	/*13*/	"*Descricao da comunidade esta vazia \n"];

		public function checarNome($nome){
			if(strlen($nome) < 4 || strlen($nome) > 25 || str_replace(' ', '', $nome) == ''){
				echo $this->mensagemErro[0];
				return false;
			}
			return true;
		}
		
		public function checarEmail($email, $email2){
			if($email != $email2){
				echo $this->mensagemErro[1];
				return false;
			}
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				echo $this->mensagemErro[2];
				return false;
			}
			$query = $this->con()->prepare("SELECT * FROM usuario WHERE email='$email'");
			$query->execute();
			if($query->rowCount() != 0){
				echo $this->mensagemErro[3];
				return false;
			}
			return true;
		}
		
		public function checarSenha($senha, $senha2){
			if($senha != $senha2){
				echo $this->mensagemErro[4];
				return false;
			}
			if(strlen($senha) < 4 || strlen($senha) > 25 || str_replace(' ', '', $senha) == ''){
				echo $this->mensagemErro[5];
				return false;
			}
			if(preg_match('/[^A-Za-z0-9]/', $senha)){
				echo $this->mensagemErro[6];
				return false;
			}
			return true;
		}
		
		public function checarDescricao($descricao){
			$descChec = preg_replace('/\s+/', '', $descricao);
			if(strlen($descricao) < 0 || strlen($descricao) > 150 || $descChec == ''){
				echo $this->mensagemErro[7];
				return false;
			}
			return true;
		}
		
		public function checarTitulo($titulo){
			if(strlen($titulo) < 4 || strlen($titulo) > 90 || str_replace(' ', '', $titulo) == ''){
				echo $this->mensagemErro[8];
				return false;
			}
			return true;
		}

		public function nomeComunidade($nome){
			if(strlen($nome) < 3 || strlen($nome) > 25 || str_replace(' ', '', $nome) == ''){
				echo $this->mensagemErro[11];
				return false;
			}
			return true;
		}
		
		public function checarConteudo($conteudo){
			$contChec = preg_replace('/\s+/', '', $conteudo);
			if($contChec == ''){
				echo $this->mensagemErro[9];
				return false;
			}
			if(strlen($conteudo) < 2){
				echo $this->mensagemErro[10];
				return false;
			}
			return true;
		}

		public function checarDescricaoComunidade($conteudo){
			$contChec = preg_replace('/\s+/', '', $conteudo);
			if($contChec == ''){
				echo $this->mensagemErro[13];
				return false;
			}
			if(strlen($conteudo) < 3 || strlen($conteudo > 150)){
				echo $this->mensagemErro[12];
				return false;
			}
			return true;
		}
	};
?>
