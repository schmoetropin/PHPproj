<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
	class Comunidade extends Conexao {
		private $comunidade;
		private $comunidadeId;
		private $checarVariaveis;
		private $checarArquivo;
		
		public function __construct($comun = NULL){
			$this->checarVariaveis = new ChecarValoresInseridos();
			$this->checarArquivo = new ChecarArquivo();
			if(isset($comun)){
				$query = $this->con()->prepare("SELECT * FROM comunidade WHERE id='$comun'");
				$query->execute();
				$this->comunidade = $query->fetch(PDO::FETCH_ASSOC);
				$this->comunidadeId = $this->comunidade['id'];
			}
		}

		public function excluirComunidade($comunidade){
			$topQuery = $this->con()->prepare("SELECT id FROM topico WHERE naComunidade='$comunidade'");
			$topQuery->execute();
			if($topQuery->rowCount() > 0){
				while($row = $topQuery->fetch(PDO::FETCH_ASSOC)){
					$topico = $row['id'];
					$topObj = new Topico();
					$topObj->deletarTopico($topico);
				}
			}
			$this->removerModeradores($comunidade);
			$this->removerRequerimentoModerador($comunidade);
			$inscObj = new Inscrever();
			$inscObj->removerIncricao($comunidade);
			$this->removerFotoComunidade($comunidade);
			$comQuery = $this->con()->prepare("DELETE FROM comunidade WHERE id='$comunidade'");
			$comQuery->execute();
		}
		
		private function removerModeradores($comunidade){
			$modObj = new Moderador();
			$query = $this->con()->prepare("SELECT id, moderador FROM comunidadeModerador WHERE comunidade='$comunidade'");
			$query->execute();
			if($query->rowCount() > 0){
				while($row = $query->fetch(PDO::FETCH_ASSOC)){
					$moderador = $row['moderador'];
					$id = $row['id'];
					$modObj->removerModerador($moderador, $id);
				}
			}
		}

		private function removerRequerimentoModerador($comunidade){
			$query = $this->con()->prepare("SELECT id FROM reqModeradorUsuario WHERE comunidade='$comunidade'");
			$query->execute();
			if($query->rowCount() > 0){
				while($row = $query->fetch(PDO::FETCH_ASSOC)){
					$id = $row['id'];
					$query = $this->con()->prepare("DELETE FROM reqModeradorUsuario WHERE id='$id'");
					$query->execute();
				}
			}
		}

		private function removerFotoComunidade($comunidade){
			$query = $this->con()->prepare("SELECT fotoComunidade FROM comunidade WHERE id='$comunidade'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			$imagem = '../../'.$row['fotoComunidade'];
			unlink($imagem);
		}
		
		// getters
		public function getId(){
			return $this->comunidadeId;
		}

		public function getNome(){
			return $this->comunidade['nome'];
		}

		public function getNomeUnico(){
			return $this->comunidade['nomeUnico'];
		}
		
		public function getDescricao(){
			return $this->comunidade['descricao'];
		}
		
		public function getDataCriacao(){
			return $this->comunidade['dataCriacao'];
		}

		public function getDataUltimoTopico(){
			return $this->comunidade['dataUltimoTopico'];
		}
		
		public function getUltimoTopico(){
			return $this->comunidade['getUltimoTopico'];
		}
		
		public function getNumeroTopicos(){
			return $this->comunidade['numeroTopicos'];
		}
		
		public function getNumeroPosts(){
			return $this->comunidade['numeroPosts'];
		}
		
		public function getNumeroInscritos(){
			return $this->comunidade['numeroInscritos'];
		}
		
		public function getFotoComunidade(){
			return $this->comunidade['fotoComunidade'];
		}

		public function getCriadoPor(){
			return $this->comunidade['criadoPor'];
		}

		// setters
		public function setNome($val){
			$nome = FormatarValoresInseridos::formatarTexto($val);
			$checarTitulo = $this->checarVariaveis->checarTitulo($nome);
			if($checarTitulo){
				$query = $this->con()->prepare("UPDATE comunidade SET nome='$nome' WHERE id='$this->comunidadeId'");
				$query->execute();
				echo "Nome da comunidade trocado! \n";
			}
		}

		public function setFotoComunidade($arq){
			$tempTit = str_replace(' ', '_', strtolower($this->getNome()));
			$foto = $this->checarArquivo->fotoCominidade($arq, $tempTit);
			if($foto){
				$fotoAntiga = $this->getFotoComunidade();
				unlink('../../'.$fotoAntiga);
				$query = $this->con()->prepare("UPDATE comunidade SET fotoComunidade='$foto' WHERE id='$this->comunidadeId'");
				$query->execute();
				echo "Foto da comunidade trocada! \n";
			}
		}

		public function setDescricao($val){
			$conteudo = FormatarValoresInseridos::formatarTexto($val);
			$checarDescricao = $this->checarVariaveis->checarConteudo($conteudo);
			if($checarDescricao){
				$query = $this->con()->prepare("UPDATE comunidade SET descricao='$conteudo' WHERE id='$this->comunidadeId'");
				$query->execute();
				echo "Descricao da comunidade trocado! \n";
			}
		}
				
		public function setNumeroTopicos($val){
			$query = $this->con()->prepare("UPDATE comunidade SET numeroTopicos='$val' WHERE id='$this->comunidadeId'");
			$query->execute();
		}
		
		public function setNumeroPosts($val){
			$query = $this->con()->prepare("UPDATE comunidade SET numeroPosts='$val' WHERE id='$this->comunidadeId'");
			$query->execute();
		}
		
		public function setNumeroInscritos($val){
			$query = $this->con()->prepare("UPDATE comunidade SET numeroInscritos='$val' WHERE id='$this->comunidadeId'");
			$query->execute();
		}

		public function setDataUltimoTopico($val){
			$query = $this->con()->prepare("UPDATE comunidade SET dataUltimoTopico='$val' WHERE id='$this->comunidadeId'");
			$query->execute();
		}
	};
?>
