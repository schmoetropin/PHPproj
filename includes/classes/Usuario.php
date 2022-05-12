<?php	
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
	class Usuario extends Conexao {
		private $usuario;
		private $usuarioId;
		private $checarValor;
		private $checarArquivo;
<<<<<<< HEAD
		private $mFObj;
		private $nomeU;
=======
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36

/*************************
*** CONSTRUCTOR
*************************/		
		public function __construct($us = NULL){
			if(isset($us)){
				$this->checarValor = new checarValoresInseridos();
				$this->checarArquivo = new checarArquivo();
<<<<<<< HEAD
				$this->mFObj = new ModeradorForms();
				$this->nomeU = new CriarNomeUnico();
=======
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
				$query = $this->con()->prepare("SELECT * FROM usuario WHERE id='$us'");
				$query->execute();
				$this->usuario = $query->fetch(PDO::FETCH_ASSOC);
				$this->usuarioId = $this->usuario['id'];
			}
		}

		public function checarUsuario($us){
			$query = $this->con()->prepare("SELECT id FROM usuario WHERE id='$us'");
			$query->execute();
			if($query->rowCount() > 0)
				return true;
			else
				return false;
		}

		public function tipoUsuario($usuario){
			$query = $this->con()->prepare("SELECT tipoUsuario FROM usuario WHERE id='$usuario'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			return $row['tipoUsuario'];
		}

<<<<<<< HEAD
		public function exibirTipoUsuarioPerfil($usuario, $tipo){
=======
		public function exibirTipoUsuarioPerfil($tipo){
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			if($tipo == 'usuario'){?>
				<p class='tipoUsuario btn btnAzul'><?php echo $tipo;?></p><?php
			}else if($tipo == 'moderador'){?>
				<button class='tipoUsuario btn btnVerde' id='modComunBot'><?php echo $tipo;?></button>
				<div id='modComunCaixa'>
					<h3>Moderador</h3>
					<img src='assets/imagens/icones/close.png' id='fecharModComunCaixa'>
<<<<<<< HEAD
					<div id='modComunCaixaComunidades'><?php
						$id = $this->nomeU->selecionarId($usuario, 'usuario');
						$this->mFObj->exibirComunidadesModerador($id);?>
					</div>
=======
					<div id='modComunCaixaComunidades'></div>
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
				</div><?php
			}else{?>
				<p class='tipoUsuario btn btnVermelho'><?php echo $tipo;?></p><?php
			}
		}
		
		public function exibirComunidadesInscritas($us){
			$query = $this->con()->prepare("SELECT * FROM inscricao WHERE usuario='$us' AND comunidade<>-50");
			$query->execute();
			if($query->rowCount() > 0){
				while($row = $query->fetch(PDO::FETCH_ASSOC)){
					$comObj = new Comunidade($row['comunidade']);
					$nome = $comObj->getNome(); 
					$subNome = substr($nome, 0, 17);
					$foto = $comObj->getFotoComunidade();
					$nomeU = $comObj->getNomeUnico();?>
					<a href='comunidade.php?c=<?php echo $nomeU;?>'>
						<div class='usuarioComunidadeInsc'>
							<div class='foto'>
								<img src='<?php echo $foto;?>'>
							</div><?php 
							echo $subNome;?>
						</div>
					</a><?php
				}
			}else{
				if(isset($_SESSION['logUsuario'])){
					if(empty($_GET['us']) || ($_SESSION['logUsuario'] == $_GET['us'])){?>
						<small style="margin: 7px;">*Voce ainda nao se inscreveu em nenhuma comunidade</small><?php
					}else{?>
						<small style="margin: 7px;">*Este usuario nao se inscreveu em nenhuma comunidade</small><?php
					}
				}else{?>
					<small style="margin: 7px;">*Este usuario nao se inscreveu em nenhuma comunidade</small><?php
				}
			}		
		}
			
/*************************
*** GETTERS
*************************/
		public function getId(){
			return $this->usuarioId;
		}
		
		public function getNome(){
			return $this->usuario['nome'];
		}

		public function getNomeUnico(){
			return $this->usuario['nomeUnico'];
		}
		
		public function getFotoDePerfil(){
			return $this->usuario['fotoPerfil'];
		}
		
		public function getEmail(){
			return $this->usuario['email'];
		}
		
		public function getNumeroTopicos(){
			return $this->usuario['numeroTopicos'];
		}
		
		public function getNumeroPosts(){
			return $this->usuario['numeroPosts'];
		}
		
		public function getNumeroAmigos(){
			return $this->usuario['numeroAmigos'];
		}
		
		public function getDataRegistro(){
			return $this->usuario['dataRegistro'];
		}
		
		public function getNumeroInscricoes(){
			return $this->usuario['numeroInscricoes'];
		}
				
		public function getNumeroLikes(){
			return $this->usuario['numeroLikes'];
		}

		public function getTipoUsuario(){
			return $this->usuario['tipoUsuario'];
		}
		
		public function getNomeTipoUsuario(){
			$query = $this->con()->prepare("SELECT * FROM tipoUsuario WHERE id='".$this->usuario['tipoUsuario']."'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			return $row['tipo'];
		}
		
		public function getDescricaoPerfil(){
			return $this->usuario['descricaoPerfil'];
		}

/*************************
*** SETTERS
*************************/
		public function setNome($val){
			$nome = FormatarValoresInseridos::formatarTexto($val);
			$checar = $this->checarValor->checarNome($nome);
			if($checar){
				$query = $this->con()->prepare("UPDATE usuario SET nome='$nome' WHERE id='$this->usuarioId'");
				$query->execute();
				return true;
			}
			return false;
		}
		
		public function setEmail($val, $val2){
			$email = FormatarValoresInseridos::formatarEmail($val);
			$email2 = FormatarValoresInseridos::formatarEmail($val2);
			$checar = $this->checarValor->checarEmail($email, $email2);
			if($checar){
				$query = $this->con()->prepare("UPDATE usuario SET email='$email' WHERE id='$this->usuarioId'");
				$query->execute();
				return true;
			}			
			return false;
		}
		
		public function setSenha($val, $val2){
			$senha = FormatarValoresInseridos::formatarTexto($val);
			$senha2 = FormatarValoresInseridos::formatarTexto($val2);
			$checar = $this->checarValor->checarSenha($senha, $senha2);
			if($checar){
				$query = $this->con()->prepare("UPDATE usuario SET senha='$senha' WHERE id='$this->usuarioId'");
				$query->execute();
				return true;
			}		
			return false;
		}
		
		public function setDescricaoPerfil($val){
			$descricao = FormatarValoresInseridos::formatarTexto($val);
			$checar = $this->checarValor->checarDescricao($descricao);
			if($checar){
				$query = $this->con()->prepare("UPDATE usuario SET descricaoPerfil='$descricao' WHERE id='$this->usuarioId'");
				$query->execute();
				return true;
			}	
			return false;
		}
		
		public function setFotoPerfil($val){
			$fotoPerfil = $this->checarArquivo->fotoDePerfil($val, $this->getNomeUnico());
			if($fotoPerfil){
				$fotoAntiga = $this->getFotoDePerfil();
				if($fotoAntiga != 'assets/imagens/icones/fotoPerfilPadrao.png'){
					unlink('../../'.$fotoAntiga);
				}
				$query = $this->con()->prepare("UPDATE usuario SET fotoPerfil='$fotoPerfil' WHERE id='$this->usuarioId'");
				$query->execute();
				return true;
			}
			return false;
		}
		
		public function setNumeroPosts($val){
			$query = $this->con()->prepare("UPDATE usuario SET numeroPosts='$val' WHERE id='$this->usuarioId'");
			$query->execute();
		}
		
		public function setNumeroTopicos($val){
			$query = $this->con()->prepare("UPDATE usuario SET numeroTopicos='$val' WHERE id='$this->usuarioId'");
			$query->execute();
		}
		
		public function setNumeroLikes($val){
			$query = $this->con()->prepare("UPDATE usuario SET numeroLikes='$val' WHERE id='$this->usuarioId'");
			$query->execute();
		}
		
		public function setNumeroAmigos($val){
			$query = $this->con()->prepare("UPDATE usuario SET numeroAmigos='$val' WHERE id='$this->usuarioId'");
			$query->execute();
		}
		
		public function setNumeroinscricoes($val){
			$query = $this->con()->prepare("UPDATE usuario SET numeroInscricoes='$val' WHERE id='$this->usuarioId'");
			$query->execute();
		}

		public function setTipoUsuario($val){
			$query = $this->con()->prepare("UPDATE usuario SET tipoUsuario='$val' WHERE id='$this->usuarioId'");
			$query->execute();
		}
	};
?>
