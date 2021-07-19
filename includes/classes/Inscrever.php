<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
	class Inscrever extends Conexao {
		private $atualizarDados;

		public function __construct(){
			$this->atualizarDados = new AtualizarMesasColunas();
		}

		// exibe botao inscrever, se ja inscrito exibe desiscrever
		public function exibirBotaoInscricao($comunidade, $topico){
			if(isset($comunidade) && empty($topico)){
				$area = $comunidade;
			}else if(empty($comunidade) && isset($topico)){
				$topicoObj = new Topico($topico);
				$comunidade = $topicoObj->getNaComunidade();
				$comObj = new Comunidade($comunidade);
				$area = $comObj->getNomeUnico();
			}
					
			if(isset($_SESSION['logUsuario'])){
				$nomeU = new CriarNomeUnico();
				$logU = $nomeU->selecionarId($_SESSION['logUsuario'], 'usuario');
				$comNU = $nomeU->selecionarId($area, 'comunidade');
				$checarInscricao = $this->checarInscricao($logU, $comNU);?>
				<form id='inscreverForm' method='POST' onsubmit='return false'>
					<input type='hidden' id='logUsuario' name='logUsuario' value='<?php echo $_SESSION['logUsuario'];?>'>
					<input type='hidden' id='comunidade' name='comunidade' value='<?php echo $area;?>'><?php					
				if($checarInscricao > 0){?>
					<input type='hidden' id='increverDesiscrever' name='increverDesiscrever' value='desiscrever'>
					<button class='btn inscreverComunidadeBotao' name='inscreverComunidadeBotao' id='inscreverComunidadeBotao'>Desinscrever</button><?php
				}else{?>
					<input type='hidden' id='increverDesiscrever' name='increverDesiscrever' value='inscrever'>
					<button class='btn btnAzul inscreverComunidadeBotao' name='inscreverComunidadeBotao' id='inscreverComunidadeBotao'>Inscrever</button><?php
				}?>
				</form><?php
			}else{?>
				<input type='hidden' id='logUsuario' value='nenhum'>
				<button class='btn btnAzul' id='semUsuarioInsc'>Inscrever</button><?php
			}
		}
		
		// inscreve usuario na comunidade
		public function inscreverUs($usuario, $comunidade){
			$query = $this->con()->prepare("INSERT INTO inscricao(usuario, comunidade) VALUES('$usuario', '$comunidade')");
			$query->execute();
			$this->atualizarDados->atualizarInscricaoComunidadeUsuario($comunidade, $usuario, '+');
		}
		
		// desinscreve usuario na comunidade
		public function desiscrever($usuario, $comunidade){
			$modObj = new Moderador();
			$checarModerador = $modObj->checarModerador($usuario, $comunidade);
			if($checarModerador){?>
				<p class='mensagemErro'>*Voce nao pode desiscrever da comunidade por ser moderador</p><?php
			}else{
				$query = $this->con()->prepare("DELETE FROM inscricao WHERE usuario='$usuario' AND comunidade='$comunidade'");
				$query->execute();
				$this->atualizarDados->atualizarInscricaoComunidadeUsuario($comunidade, $usuario, '-');
			}
		}
		
		//checa se usuario ja esta inscrito na comunidade
		public function checarInscricao($usuario, $comunidade){
			$query = $this->con()->prepare("SELECT * FROM inscricao WHERE usuario='$usuario' AND comunidade='$comunidade'");
			$query->execute();
			return $query->rowCount();
		}

		// remove inscricao do usuario
		public function removerIncricao($comunidade){
			$query = $this->con()->prepare("SELECT usuario FROM inscricao WHERE comunidade='$comunidade'");
			$query->execute();
			if($query->rowCount() > 0){
				while($row = $query->fetch(PDO::FETCH_ASSOC)){
					$usuario = $row['usuario'];
					$this->atualizarDados->atualizarInscricaoComunidadeUsuario($comunidade, $usuario, '-');
				}
			}
			$query = $this->con()->prepare("DELETE FROM inscricao WHERE comunidade='$comunidade'");
			$query->execute();;
		}
	};
?>
