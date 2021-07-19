<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
	class Like extends Conexao {
		private $atualizarDados;
		public function __construct(){
			$this->atualizarDados = new AtualizarMesasColunas();
		}

		// like
		public function likeAlgumaCoisa($logUsuario, $noUsuario, $noTopico, $noPost){
			if(isset($noTopico)){
				$tObj = new Topico($noTopico);
				$comunidade = $tObj->getNaComunidade();
			}else
				$comunidade = NULL;
			$data = date('Y-m-d H:i:s');
			$query = $this->con()->prepare('INSERT INTO botaoLike(dataLike, logUsuario, noUsuario, noTopico, noPost, comunidadeTopico) VALUES(:dataLike, :logUsuario, :noUsuario, :noTopico, :noPost, :comunidadeTopico)');
			$arr = array(
				':dataLike'=> $data,
				':logUsuario' => $logUsuario,
				':noUsuario' => $noUsuario,
				':noTopico' => $noTopico,
				':noPost' => $noPost,
				':comunidadeTopico'=> $comunidade);
			$query->execute($arr);
			$this->atualizarDados->atualisarLikes($noUsuario, $noTopico, $noPost, '+');
		}
		
		// unlike
		public function unlikeAlgumaCoisa($id, $logUsuario, $noUsuario, $noTopico, $noPost){
			$query = $this->con()->prepare("DELETE FROM botaoLike WHERE id='$id'");
			$query->execute();
			$this->atualizarDados->atualisarLikes($noUsuario, $noTopico, $noPost, '-');
		}
		
		// exibe formulario like
		public function likeForm($topico, $post){
			if(isset($topico) && empty($post)){
				$area = $topico;
				$row = 'noTopico';
				$nomeArea = 'Topico';
				$areaObj = new Topico($topico);
			}else if(empty($topico) && isset($post)){
				$area = $post;
				$row = 'noPost';
				$nomeArea = 'Post';
				$areaObj = new Post($post);
			}
			if(isset($_SESSION['logUsuario'])){
				$nomeUn = new CriarNomeUnico();
				$usuario = $nomeUn->selecionarId($_SESSION['logUsuario'], 'usuario');?>
				<input type='hidden' class='like<?php echo $nomeArea.'Id';?>' value='<?php echo $area;?>'>
				<form id='like<?php echo $nomeArea.'Form'.$area;?>' method='POST' onsubmit='return false' style='float: left;'>
					<input type='hidden' id='likeAreaId' name='likeAreaId' value='<?php echo $area;?>'><?php					
				$query = $this->con()->prepare("SELECT * FROM botaoLike WHERE $row='$area' AND logUsuario='$usuario'");
				$query->execute();
				if($query->rowCount() != 0){
					$row = $query->fetch(PDO::FETCH_ASSOC);
					$id = $row['id'];?>
					<input type='hidden' id='likeId' name='likeId' value='<?php echo $id;?>'>
					<input type='hidden' id='areaTipo' name='areaTipo' value='<?php echo $nomeArea;?>'>
					<input type='hidden' id='opcaoLikeUnlike' name='opcaoLikeUnlike' value='unlike'>
					<button type='submit' id='like<?php echo $nomeArea.'Botao'.$area;?>' class='btnInvisivel likeAreaBotao' name='unlikeAreaBotao'><img src='assets/imagens/icones/blue-like.png'></button><?php
				}else{?>
					<input type='hidden' id='areaTipo' name='areaTipo' value='<?php echo $nomeArea;?>'>
					<input type='hidden' id='opcaoLikeUnlike' name='opcaoLikeUnlike' value='like'>
					<button type='submit' id='like<?php echo $nomeArea.'Botao'.$area;?>' class='btnInvisivel likeAreaBotao' name='likeAreaBotao'><img src='assets/imagens/icones/gray-like.png'></button><?php
				}?>
				</form> likes: <?php echo $areaObj->getNumeroLikes();
			}else{?>
				<button id='likeAreaBotao' class='btnInvisivel likeAreaBotao'><img src='assets/imagens/icones/gray-like.png'></button> likes: <?php echo $areaObj->getNumeroLikes();
			}
		}
	};
?>
