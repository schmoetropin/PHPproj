<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
	class Mensagem extends Conexao {
		private $checarValores;
		
		public function __construct(){
			$this->checarValores = new ChecarValoresInseridos();
		}
		
		// envia mensagem
		public function enviarMensagem($logUsuario, $para, $mens){
			$mensagem = FormatarValoresInseridos::formatarTexto($mens);
			$checarMes = $this->checarValores->checarConteudo($mensagem);
			if($checarMes){
				$data = date('Y-m-d H:i:s');
				$query = $this->con()->prepare("INSERT INTO mensagem(enviadoPor, mensagem, enviadoPara, data) VALUES('$logUsuario', '$mensagem', '$para', '$data')");
				$query->execute();
			}
		}
		
		// exibe mensagens enviadas a determinado usuario
		public function exibirMensagens($logUsuario, $usuario){
			$query = $this->con()->prepare("SELECT * FROM mensagem WHERE enviadoPor='$logUsuario' AND enviadoPara='$usuario' OR enviadoPor='$usuario' AND enviadoPara='$logUsuario' ORDER BY data ASC");
			$query->execute();
			if($query->rowCount() > 0){
				while($row = $query->fetch(PDO::FETCH_ASSOC)){
					$enviadoPor = $row['enviadoPor'];
					$mensagem = $row['mensagem'];
					$data = $row['data'];
					$usObj = new Usuario($enviadoPor);
					$nome = $usObj->getNome();
					$nomeU = new CriarNomeUnico();
					$logU = $nomeU->selecionarId($_SESSION['logUsuario'], 'usuario');?>
					<div class='mensagem'><?php
					if($logU == $enviadoPor){?>
						<div class='mensagemUsuario' style='color: #0D47A1; float: left;'><?php echo $nome;?></div>
						<div style='font-size: 9px; float: right; margin-right: 5%;'><?php echo $data;?></div>
						<div class='mensagemConteudo' style='border-color: #0D47A1; width: 100%;'><?php echo $mensagem;?></div><?php
					}else{?>
						<div class='mensagemUsuario' style='color: #c62828; float: left;'><?php echo $nome;?></div>
						<div style='font-size: 9px; float: right; margin-right: 5%;'><?php echo $data;?></div>
						<div class='mensagemConteudo' style='border-color: #c62828; width: 100%'><?php echo $mensagem;?></div><?php
					}?>
					</div><?php
				}
			}else{?>
				<small>Nenhuma mensagem ainda foi enviada</small><?php
			}
		}
		
		// checa se alguem enviou mensagem para o usuario
		public function checarMensagensInbox($usuario){
			$usObj = new Usuario($usuario);
			$usNomeU = $usObj->getNomeUnico();
			$query = $this->con()->prepare("SELECT DISTINCT enviadoPor, enviadoPara FROM mensagem WHERE enviadoPor='$usuario' OR enviadoPara='$usuario' ORDER BY data DESC");
			$query->execute();
			if($query->rowCount() > 0){
				while($row = $query->fetch(PDO::FETCH_ASSOC)){
					if($usuario == $row['enviadoPor'])
						$enviadoDe = $row['enviadoPara'];
					else
						$enviadoDe = $row['enviadoPor'];
					$enviadoDeObj = new Usuario($enviadoDe);
					$nome = $enviadoDeObj->getNome();
					$foto = $enviadoDeObj->getFotoDePerfil();
					$nomeU = $enviadoDeObj->getNomeUnico();
					if($row['enviadoPor'] != $usuario){?>
						<input type='hidden' class='usuarioConversa' value='<?php echo $nomeU;?>'>
						<div id='enviadoPorUsuario<?php echo $nomeU;?>' class='enviadoPorUsuario' style='cursor: pointer;'>
							<div id='foto'>
								<img src='<?php echo $foto;?>'>
							</div>
							<h4 id='nome'><?php echo $nome;?></h4>						
						</div>
						<div class='caixaMensagemForm' id='caixaMensagemForm<?php echo $nomeU;?>' style='display: none;'>
							<div id='perfilMensagem<?php echo $nomeU;?>' class='perfilMensagem'></div>
							<input type='hidden' id='logUsuario<?php echo $nomeU;?>' value='<?php echo $usNomeU;?>'>
							<input type='hidden' id='usuario<?php echo $nomeU;?>' value='<?php echo $nomeU;?>'>
							<form id='mensagemForm<?php echo $nomeU;?>' method='POST' onsubmit='return false' onsubmit='this.disabled=true'>
								<input type='hidden' name='usuarioMensagem' id='usuarioMensagem' class='usuarioMensagem' value='<?php echo $nomeU;?>'>
								<textarea class='mensagemTextarea<?php echo $nomeU;?>' id='mensagemTextarea' name='mensagemTextarea' required></textarea>		
								<button class='btn btnAzul enviarMensagem' id='enviarMensagem<?php echo $nomeU;?>' name='enviarMensagem'>Enviar</button>
							</form>
						</div><?php
					}else{
						$str1 = "SELECT * FROM mensagem WHERE enviadoPor='$usuario' AND enviadoPara='$enviadoDe'";
						$str2 = "SELECT * FROM mensagem WHERE enviadoPor='$enviadoDe' AND enviadoPara='$usuario'";
						$query1 = $this->con()->prepare($str1);
						$query1->execute();
						$query2 = $this->con()->prepare($str2);
						$query2->execute();
						if(!($query1->rowCount() > 0 && $query2->rowCount() > 0)){?>
							<small style="margin: 4px 0 4px 25%;">
								*<a href="perfil.php?us=<?php echo $nomeU;?>" style="text-transform: capitalize; color: #222; font-weight: bold;">
									<?php echo $nome?>
								</a> nao the respondeu</small><?php
						}
					}
				}
			}else{?>
				<small style="margin: 0 0 0 7%;">*Ninguem te enviou uma mensagem</small><?php
			}
		}
	};
?>
