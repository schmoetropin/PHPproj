<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
	class Topico extends Conexao {
		private $topico;
		private $topicoId;
		private $checarValores;
		private $checarArquivo;
		private $atualizarDados;
		
		public function __construct($top = NULL){
			$this->checarValores = new ChecarValoresInseridos();
			$this->checarArquivo = new ChecarArquivo();
			$this->atualizarDados = new AtualizarMesasColunas();
			if(isset($top)){
				$query = $this->con()->prepare("SELECT * FROM topico WHERE id='$top'");
				$query->execute();
				$this->topico = $query->fetch(PDO::FETCH_ASSOC);
				$this->topicoId = $this->topico['id'];
			}
		}

		public function deletarTopico($topico){
			$topQuery = $this->con()->prepare("SELECT * FROM topico WHERE id='$topico'");
			$topQuery->execute();
			$row = $topQuery->fetch(PDO::FETCH_ASSOC);
			if($row['tipoArquivo'] == 'video' || $row['tipoArquivo'] == 'imagem'){
				$arquivo = '../../'.$row['arquivo']; 
				unlink($arquivo);
			}
			$this->deletarLikesTopico($topico);
			$numPosts = $this->deleterPostsLike($topico);
			$usuario = $row['criadoPor'];
			$comunidade = $row['naComunidade'];
			$query = $this->con()->prepare("DELETE FROM topico WHERE id='$topico'");
			$query->execute();
			$this->atualizarDados->atualizarUsuarioComunidadeNTopicos($usuario, $comunidade, $numPosts, '-');
		}

		private function deletarLikesTopico($topico){
			$topQuery = $this->con()->prepare("SELECT * FROM topico WHERE id='$topico'");
			$topQuery->execute();
			if($topQuery->rowCount() > 0){
				$likeQ = $this->con()->prepare("SELECT * FROM botaoLike WHERE noTopico='$topico'");
				$likeQ->execute();
				if($likeQ->rowCount() > 0){
					while($row = $likeQ->fetch(PDO::FETCH_ASSOC)){
						$likId = $row['id'];
						$delLikQ = $this->con()->prepare("DELETE FROM botaoLike WHERE id='$likId'");
						$delLikQ->execute();
					}
				}
			}
		}

		private function deleterPostsLike($topico){
			$postQ = $this->con()->prepare("SELECT * FROM post WHERE noTopico='$topico'");
			$postQ->execute();
			if($postQ->rowCount() > 0){
				$numPosts = $postQ->rowCount();
				while($row = $postQ->fetch(PDO::FETCH_ASSOC)){
					$post = $row['id'];
					$poObj = new Post(NULL);
					$poObj->deletarPost($post);
				}
			}
			return $numPosts;
		}
		
		public function getId(){
			return $this->topicoId;
		}
		
		public function getNaComunidade(){
			return $this->topico['naComunidade'];
		}
		
		public function getTitulo(){
			return $this->topico['titulo'];
		}

		public function getConteudo(){
			return $this->topico['conteudo'];
		}

		public function getTipoArquivo(){
			return $this->topico['tipoArquivo'];
		}

		public function getArquivo(){
			return $this->topico['arquivo'];
		}
		
		public function getNumeroPosts(){
			return $this->topico['numeroPosts'];
		}
		
		public function getNumeroLikes(){
			return $this->topico['numeroLikes'];
		}

		public function getDataCriacao(){
			return $this->topico['dataCriacao'];
		}

		public function getCriadoPor(){
			return $this->topico['criadoPor'];
		}

		public function setTitulo($val){
			$titulo = FormatarValoresInseridos::formatarTexto($val);
			$checarTit = $this->checarValores->checarTitulo($titulo);
			if($checarTit){
				$query = $this->con()->prepare("UPDATE topico SET titulo='$titulo' WHERE id='$this->topicoId'");
				$query->execute();
				return "<small class='mensagemSucesso'>Titulo editado!</small>";
			}
		}
		
		public function setArquivoUpload($val, $top){
			$tipo = $this->checarArquivo->checarTipoDeArquivo($val);
			$arquivo = null;
			if($tipo == 'imagem')
				$arquivo = $this->checarArquivo->fotoTopico($val, $top);
			else if($tipo == 'video')
				$arquivo = $this->checarArquivo->videoTopico($val, $top);
			if($tipo && $arquivo){
				if($this->getTipoArquivo() == 'imagem' || $this->getTipoArquivo() == 'video')
					unlink('../../'.$this->getArquivo());
				$query = $this->con()->prepare("UPDATE topico SET arquivo='$arquivo', tipoArquivo='$tipo' WHERE id='$this->topicoId'");
				$query->execute();
				return "<small class='mensagemSucesso'>Midia editada!</small>";
			}
		}

		public function setArquivoEmbbedImagem($val){
			$link = strip_tags($val);
			$query = $this->con()->prepare("UPDATE topico SET arquivo='$link', tipoArquivo='embbedImagem' WHERE id='$this->topicoId'");
			$query->execute();
			if($this->getTipoArquivo() == 'imagem' || $this->getTipoArquivo() == 'video')
				unlink('../../'.$this->getArquivo());
			return "<small class='mensagemSucesso'>Midia editada!</small>";
		}

		public function setArquivoEmbbedVideo($val){
			$link = strip_tags($val);
			$checarLink = substr($link, 0, 32);
			if($checarLink == 'https://www.youtube.com/watch?v='){
				$query = $this->con()->prepare("UPDATE topico SET arquivo='$link', tipoArquivo='embbedVideo' WHERE id='$this->topicoId'");
				$query->execute();
				if($this->getTipoArquivo() == 'imagem' || $this->getTipoArquivo() == 'video')
					unlink('../../'.$this->getArquivo());
				return "<small class='mensagemSucesso'>Midia editada!</small>";
			}
		}

		public function setArquivoNenhum(){
			$query = $this->con()->prepare("UPDATE topico SET arquivo=NULL, tipoArquivo='semArquivo' WHERE id='$this->topicoId'");
			$query->execute();
			if($this->getTipoArquivo() == 'imagem' || $this->getTipoArquivo() == 'video')
				unlink('../../'.$this->getArquivo());
			return "<small class='mensagemSucesso'>Midia editada!</small>";
		}
		
		public function setConteudo($val){
			$conteudo = FormatarValoresInseridos::formatarTexto($val);
			$checarTit = $this->checarValores->checarConteudo($conteudo);
			if($checarTit){
				$query = $this->con()->prepare("UPDATE topico SET conteudo='$conteudo' WHERE id='$this->topicoId'");
				$query->execute();
				return "<small class='mensagemSucesso'>Conteudo editado!</small>";
			}
		}
		
		public function setNumeroPosts($val){
			$query = $this->con()->prepare("UPDATE topico SET numeroPosts='$val' WHERE id='$this->topicoId'");
			$query->execute();
		}
		
		public function setNumeroLikes($val){
			$query = $this->con()->prepare("UPDATE topico SET numeroLikes='$val' WHERE id='$this->topicoId'");
			$query->execute();
		}
		
	};
?>
