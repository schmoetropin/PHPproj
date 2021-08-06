<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
	class Post extends Conexao {
		private $post;
		private $postId;
		private $checarValores;
		private $atualizarDados;
		public function __construct($pos = NULL){
			$this->checarValores = new ChecarValoresInseridos();
			$this->atualizarDados = new AtualizarMesasColunas();
			if(isset($pos)){
				$query = $this->con()->prepare("SELECT * FROM post WHERE id='$pos'");
				$query->execute();
				$this->post = $query->fetch(PDO::FETCH_ASSOC);
				$this->postId = $this->post['id'];
			}
		}
		
		public function postarEmTopico($postadoPor, $noTopico, $noPost, $cont){
			$conteudo = FormatarValoresInseridos::formatarTexto($cont);
			$checarCont = $this->checarValores->checarConteudo($conteudo);
			if($checarCont){
				$this->inserirValoresEmPost($postadoPor, $noTopico, $noPost, $conteudo);
				$topObj = new Topico($noTopico);
				$comunidade = $topObj->getNaComunidade();
				$this->atualizarDados->atualizarUsuarioComunidadeTopicoPostsNPosts($postadoPor, $noTopico, $comunidade, $noPost, '+');
				return true;
			}
			return false;
		}
		
		private function inserirValoresEmPost($postadoPor, $noTopico, $noPost, $conteudo){
			$data = date('Y-m-d H:i:s');
			$query = $this->con()->prepare('INSERT INTO post(postadoPor, conteudo, noTopico, noPost, dataPostagem) VALUES(:postadoPor, :conteudo, :noTopico, :noPost, :dataPostagem)');
			$arr = array(
				':postadoPor'=> $postadoPor,
				':conteudo'=> $conteudo,
				':noTopico'=> $noTopico,
				':noPost'=> $noPost,
				':dataPostagem'=> $data);
			$query->execute($arr);
		}

		public function deletarPost($id){
			$lQuery = $this->con()->prepare("DELETE FROM botaoLike WHERE noPost='$id'");
			$lQuery->execute();
			$cQuery = $this->con()->prepare("SELECT * FROM post WHERE noPost='$id'");
			$cQuery->execute();
			while($row = $cQuery->fetch(PDO::FETCH_ASSOC)){
				$cId = $row['id'];
				$lQuery = $this->con()->prepare("DELETE FROM botaoLike WHERE noPost='$cId'");
				$lQuery->execute();
			}
			$cQuery = $this->con()->prepare("DELETE FROM post WHERE noPost='$id'");
			$cQuery->execute();
			$pQuery = $this->con()->prepare("DELETE FROM post WHERE id='$id'");
			$pQuery->execute();
		}
				
		public function getId(){
			return $this->postId;
		}
				
		public function getNumeroRespostas(){
			return $this->post['numeroRespostas'];
		}
		
		public function getNumeroLikes(){
			return $this->post['numeroLikes'];
		}

		public function setConteudo($val){
			$conteudo = FormatarValoresInseridos::formatarTexto($val);
			$checarCont = $this->checarValores->checarConteudo($conteudo);
			if($checarCont){
				$query = $this->con()->prepare("UPDATE post SET conteudo='$val' WHERE id='$this->postId'");
				$query->execute();
			}
		}
		
		public function setNumeroRespostas($val){
			$query = $this->con()->prepare("UPDATE post SET numeroRespostas='$val' WHERE id='$this->postId'");
			$query->execute();
		}
		
		public function setNumeroLikes($val){
			$query = $this->con()->prepare("UPDATE post SET numeroLikes='$val' WHERE id='$this->postId'");
			$query->execute();
		}
	};
?>
