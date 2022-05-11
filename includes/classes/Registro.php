<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
	class Registro extends Conexao {
		private $checarValores;
		private $nomeUnico;

		public function __construct(){
			$this->checarValores =  new ChecarValoresInseridos();
			$this->nomeUnico =  new CriarNomeUnico();
		}

		public function registrar($no, $em, $em2, $se, $se2){
			$nome = FormatarValoresInseridos::formatarTexto($no);
			
			$email = FormatarValoresInseridos::formatarEmail($em);
			$email2 = FormatarValoresInseridos::formatarEmail($em2);
			
			$senha = FormatarValoresInseridos::formatarTexto($se);
			$senha2 = FormatarValoresInseridos::formatarTexto($se2);
			
			$checarNome = $this->checarValores->checarNome($nome);
			$checarEmail = $this->checarValores->checarEmail($email, $email2);
			$checarSenha = $this->checarValores->checarSenha($senha, $senha2);
			
			if($checarNome && $checarEmail && $checarSenha){
				$this->inserirValoresNoUsusario($nome, $email, $senha);?>
				<p class='mensagemSucesso'>Conta criada!</p>
				<script>
					_('regNameInput').value = '';
					_('regEmailInput').value = '';
					_('regEmailInput2').value = '';
					_('regPasswordInput').value = '';
					_('regPasswordInput2').value = '';
				</script><?php
			}
		}
		
		public function login($em, $se){
			$se = md5($se);
			$query = $this->con()->prepare("SELECT nomeUnico FROM usuario WHERE email='$em' AND senha='$se'");
			$query->execute();
			if($query->rowCount() > 0){
				$row = $query->fetch(PDO::FETCH_ASSOC);
				$_SESSION['logUsuario'] = $row['nomeUnico'];?>
				<script>location.href = 'index.php'</script><?php
			}else{?>
				<p class='mensagemErro'>Conta nao encontrada</p><?php
			}
		}

		public function logout(){
			session_destroy();?>
			<script>location.href = 'index.php';</script><?php
			exit();
		}
		
		private function inserirValoresNoUsusario($nome, $email, $senha){
			$nomeU = $this->nomeUnico->criar($nome, 'usuario');
			$senha = md5($senha);
			$data = date('Y-m-d');
			$fotoPerfil = 'assets/imagens/icones/fotoPerfilPadrao.png';
			$query = $this->con()->prepare('INSERT INTO usuario(nome, email, senha, dataRegistro, fotoPerfil, nomeUnico) VALUES(:nome, :email, :senha, :dataRegistro, :fotoPerfil, :nomeUnico)');
			$arr = array(
				':nome'=> $nome,
				':email'=> $email,
				':senha'=> $senha,
				':dataRegistro'=> $data,
				':fotoPerfil'=> $fotoPerfil,
				':nomeUnico'=> $nomeU);
			$query->execute($arr);
		}		
	};
?>
