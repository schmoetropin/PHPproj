<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
	class Mensagem extends Conexao {
		private $checarValores;
		private $crNomeU;
		
		public function __construct(){
			$this->checarValores = new ChecarValoresInseridos();
			$this->crNomeU = new CriarNomeUnico();
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
					$mensagem = chunk_split($mensagem, 55, '<br />');
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
		
		public function checarTodasConversas($usuario){
			$usId = $this->crNomeU->selecionarId($usuario, 'usuario');
			$sql = "SELECT * FROM mensagem 
					WHERE enviadoPor='$usId' 
					OR enviadoPara='$usId'
					ORDER BY data DESC";
			$query = $this->con()->prepare($sql);
			$query->execute();
			if($query->rowCount() > 0){
				$arr = [];
				while($row = $query->fetch(PDO::FETCH_ASSOC)){
					$envPor = $row['enviadoPor'];
					$envPara = $row['enviadoPara'];
					$usObj = null;
					if($row['enviadoPor'] == $usId){
						if(!in_array($row['enviadoPara'], $arr))
							array_push($arr, $row['enviadoPara']);
					}if($row['enviadoPara'] == $usId){
						if(!in_array($row['enviadoPor'], $arr))
							array_push($arr, $row['enviadoPor']);
					}
				}
				$this->printTodasConversas($arr);
			}else{ ?>
				<small style="margin: 0 0 0 7%;">*Você não iniciou nehuma conversa</small><?php
			}
		}

		private function printTodasConversas($arr = []){
			for($i = 0; $i < count($arr); $i++){
				$usObj = new Usuario($arr[$i]);
				$nome = $usObj->getNome();
				$foto = $usObj->getFotoDePerfil();
				$nomeU = $usObj->getNomeUnico(); ?>
				<a href="chat.php?u=<?php echo $nomeU;?>&l=<?php echo $_SESSION['logUsuario'];?>">
					<div class='enviadoPorUsuario' style='cursor: pointer;'>
						<div id='foto'>
							<img src='<?php echo $foto;?>'>
						</div>
						<h4 id='nome'><?php echo $nome;?></h4>						
					</div>
				</a><?php
			}
		}
	};
?>
