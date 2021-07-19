<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
	class Amigos extends Conexao {
		private $atualizarDados;
		private $nomeUnico;
		public function __construct(){
			$this->atualizarDados = new AtualizarMesasColunas();
			$this->nomeUnico = new CriarNomeUnico();
		}

		// checar se existe um pedido de amizade entre dois usuarios
		public function checarRequisicaoAmizade($deUsuario, $paraUsuario){
			$query = $this->con()->query("SELECT * FROM reqAmizade WHERE deUsuario='$deUsuario' AND paraUsuario='$paraUsuario' OR paraUsuario='$deUsuario' AND deUsuario='$paraUsuario'");
			return $query->fetch();
		}
		
		// inserir um pedido de amizade
		public function requisicaoDeAmizade($deUsuario, $paraUsuario){
			$query = $this->con()->prepare("INSERT INTO reqAmizade(deUsuario, paraUsuario) VALUES('$deUsuario', '$paraUsuario')");
			$query->execute();
		}
		
		// checar se recebeu algum pedido de amizade
		public function checarRequerimentosDeAmizadeRecebido($logUsuario){
			$logUId = $this->nomeUnico->selecionarId($logUsuario, 'usuario');
			$query = $this->con()->prepare("SELECT * FROM reqAmizade WHERE paraUsuario='$logUId'");
			$query->execute();
			if($query->rowCount() > 0){?>
				<br /><small style="margin: 0 0 0 3%;">Pedido(s) de amizade:</small><br /><br /><?php
				while($row = $query->fetch(PDO::FETCH_ASSOC)){
					$usuario = $row['deUsuario'];
					$id = $row['id'];
					$usObj = new Usuario($usuario);
					$nomeU = $usObj->getNomeUnico();
					$usId = $usObj->getId();
					$nome = substr($usObj->getNome(), 0, 5);
					$foto = $usObj->getFotoDePerfil();?>
					<input type='hidden' class='reqAmId' value='<?php echo $id;?>'>
					<div class='requisicaoAmizade' id='requisicaoAmizade<?php echo $id;?>'>
						<a href='perfil.php?us=<?php echo $nomeU;?>'>
							<div class='foto'>
								<img src='<?php echo $foto;?>'>
							</div>
							<div class='nome'><?php 
								echo $nome;?>
							</div>
						</a>
						<form id='aceitarRequisicaoForm<?php echo $id;?>' method='POST' onsubmit='return false'>
							<input type='hidden' name='logUsuario' id='logUsuario' value='<?php echo $logUsuario;?>'>
							<input type='hidden' name='usuario' id='usuario' value='<?php echo $nomeU;?>'>
							<input type='hidden' id='opicao' name='opicao' value='aceitarR'>
							<button class='btn btnVerde aceitarRequisicao' id='aceitarRequisicao<?php echo $id;?>'>aceitar</button>
						</form>
						<form id='ignorarRequisicaoForm<?php echo $id;?>' method='POST' onsubmit='return false'>
							<input type='hidden' name='logUsuario' id='logUsuario' value='<?php echo $logUsuario;?>'>
							<input type='hidden' name='usuario' id='usuario' value='<?php echo $nomeU;?>'>
							<input type='hidden' id='opicao' name='opicao' value='ignorarR'>
							<button class='btn ignorarRequisicao' id='ignorarRequisicao<?php echo $id;?>'>ignorar</button>
						</form>
					</div><?php
				}?>
				<hr class="hrPadrao"><?php
			}else{
				if(isset($_SESSION['logUsuario'])){
					if(empty($_GET['us']) || ($_SESSION['logUsuario'] == $_GET['us'])){?>
						<small style="margin: 0 0 0 7%;">*Voce nao recebeu nenhum pedido de amizade</small><br /><?php
					} 
				}
			}
		}
		
		// checar se enviou algum pedido de amizade
		public function checarTodosRequerimentosDeAmizadeEnviado($logUsuario){
			$logUId = $this->nomeUnico->selecionarId($logUsuario, 'usuario');
			$query = $this->con()->query("SELECT * FROM reqAmizade WHERE deUsuario='$logUId'");
			$query->execute();
			if($query->rowCount() > 0){?>
				<br /><small style="margin: 0 0 0 3%;">Pedido(s) de amizade enviado(s):</small><br /><br /><?php
				while($row = $query->fetch(PDO::FETCH_ASSOC)){
					$usuario = $row['paraUsuario'];
					$usObj = new Usuario($usuario);
					$nome = $usObj->getNome();
					$nome = substr($nome, 0, 10);
					$nomeU = $usObj->getNomeUnico();
					$foto = $usObj->getFotoDePerfil();
					$id = $row['id'];?>
					<div class='requisicaoAmizadeEnviado'>
						<input type='hidden' class='reqAmizadeEnviadoId' value='<?php echo $id;?>'>
						<form id='carcelarReqAmizadeForm<?php echo $id;?>' method='POST' onsubmit='return false'>
							<input type='hidden' name='cancelarReqAmizade' value='<?php echo $id;?>'>
							<button id='cancelarReqAmizade<?php echo $id;?>' class='btnInvisivel'><img src='assets/imagens/icones/close.png' class='cancelarReqAmizade botaoFecharPadrao'></button>
						</form>
						<a href='perfil.php?us=<?php echo $nomeU;?>'>
						<div class='foto'>
							<img src='<?php echo $foto;?>'>
						</div>
						<div class='nome'><?php 
							echo $nome;?>
						</div>
						</a>
						<button class='btn'>requerimento enviado</button>
					</div><?php
				}?>
				<hr class="hrPadrao"><?php
			}else{?>
				<small style="margin: 0 0 0 7%;">*Voce nao enviou nehum pedido de amizade</small><?php
			}
		}

		public function formularioRequerimentoAmizade($logUsuario, $pagUsuario){?>
			<div class='requizicaoAmizadeFormArea'>
				<form id='requizicaoAmizadeForm' method='POST' onsubmit='return false'>
					<input type='hidden' id='rLogUsuario' name='rLogUsuario' value='<?php echo $logUsuario;?>'>
					<input type='hidden' id='rUsuario' name='rUsuario' value='<?php echo $pagUsuario;?>'>
					<button class='btn btnVerde' id='enviarRequerimentoAmizade'>requisicao amizade</button>
				</form>
			</div><?php
		}

		public function cancelarReqAmizade($id){
			$query = $this->con()->prepare("DELETE FROM reqAmizade WHERE id='$id'");
			$query->execute();
		}
		
		// aceita pedido amizade
		public function aceitarRequisicao($logUsuario, $usuario){
			$query = $this->con()->prepare("DELETE FROM reqAmizade WHERE paraUsuario='$logUsuario' AND deUsuario='$usuario'");
			$query->execute();
			$query = $this->con()->prepare("INSERT INTO amigos(usuario, amigo) VALUES('$logUsuario', '$usuario')");
			$query->execute();
			$this->atualizarDados->atualizarUsuarioAmigos($logUsuario, $usuario, '+');
		}
		
		// ignora pedido amizade
		public function ignorarRequisicao($logUsuario, $usuario){
			$query = $this->con()->prepare("DELETE FROM reqAmizade WHERE paraUsuario='$logUsuario' AND deUsuario='$usuario'");
			$query->execute();
		}

		// checa se usuarios ja sao amigos
		public function checarListaDeAmigos($logUsuario, $usuario){
			$query = $this->con()->prepare("SELECT * FROM amigos WHERE usuario='$logUsuario' AND amigo='$usuario' OR usuario='$usuario' AND amigo='$logUsuario'");
			$query->execute();
			if($query->rowCount() > 0)
				return true;
			else
				return false;
		}
 
		public function exibirRequizicaoAmizadeEnviadoUsuario($pagUsuario){
			$usObj = new Usuario($pagUsuario);
			$nome = $usObj->getNome();
			$nome = substr($nome, 0, 10);
			$nomeU = $usObj->getNomeUnico();
			$foto = $usObj->getFotoDePerfil();?>
			<div class='requisicaoAmizadeEnviado'>
				<a href='perfil.php?us=<?php echo $nomeU;?>'>
					<div class='foto'>
						<img src='<?php echo $foto;?>'>
					</div>
					<div class='nome'><?php 
						echo $nome;?>
					</div>
				</a>
				<button class='btn'>requerimento enviado</button>
			</div><?php
		}

		// exibe lista de amigos
		public function exibirAmigos($usuario){
			$query = $this->con()->prepare("SELECT * FROM amigos WHERE usuario='$usuario' OR amigo='$usuario'");
			$query->execute();
			if($query->rowCount() > 0){
				while($row = $query->fetch(PDO::FETCH_ASSOC)){
					if($usuario == $row['usuario'])
						$amigo = $row['amigo'];
					else
						$amigo = $row['usuario'];
					$amObj = new Usuario($amigo);
					$foto = $amObj->getFotoDePerfil();
					$nome = $amObj->getNome();
					$nome = substr($nome, 0, 9);
					$nomeU = $amObj->getNomeUnico();?>
					<a href='perfil.php?us=<?php echo $nomeU;?>'>
						<div class='usAmigo'>
							<div><img src='<?php echo $foto;?>'></div><?php 
							echo $nome;?>
						</div>
					</a><?php
				}
			}else{?>
				<small style="margin: 7%;">*Nenhum amigo adicionado</small><?php
			}
		}
		
		public function removerAmigoForm($pagUsuario){
			$usObj = new Usuario($this->nomeUnico->selecionarId($pagUsuario, 'usuario'));
			$nome = $usObj->getNome();?>
			<div style='text-align: center; margin-top: 40px;' id='situacaoAmizade'>
				<h5 style='display: inline; margin-left: 6px; text-transform: capitalize;'><?php echo $nome;?></h5> e seu amigo!!
				<form id='removerAmigoForm' method='POST' onsubmit='return false'>
					<input type='hidden' name='paginaUsuario' id='paginaUsuario' value='<?php echo $pagUsuario;?>'>
					<button class='btn btnVermelho' id='removerAmigo' style='margin-top: 8px; height: 4em; width: 10em;'>remover amigo</button> 
				</form>
			</div><?php
		}

		//remove amigo
		public function removerAmigo($logUsuario, $amigo){
			$query = $this->con()->prepare("DELETE FROM amigos WHERE usuario='$logUsuario' AND amigo='$amigo' OR usuario='$amigo' AND amigo='$logUsuario'");
			$query->execute();
			$this->atualizarDados->atualizarUsuarioAmigos($logUsuario, $amigo, '-');
		}
	};
?>
