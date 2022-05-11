<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
    class ExibirPost extends Conexao {
		private $likeObj;
		public function __construct(){
			$this->likeObj = new Like();
		}

        public function exibirPosts($topico, $post = NULL, $usuario = NULL){
            if(isset($topico) && empty($post))
                $query = $this->con()->prepare("SELECT * FROM post WHERE noTopico='$topico' AND noPost IS NULL");
            else if(isset($topico) && isset($post))
                $query = $this->con()->prepare("SELECT * FROM post WHERE noTopico='$topico' AND noPost='$post'");
            else
                $query = $this->con()->prepare("SELECT * FROM post WHERE postadoPor='$usuario'");
            $query->execute();
            if($query->rowCount() > 0){
                $i = 0; $j = [];
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $j[$i] = [
                        'postadoPor'=> $row['postadoPor'],
                        'conteudo'=> $row['conteudo'],
                        'dataPostagem'=> $row['dataPostagem'],
                        'numeroLikes'=> $row['numeroLikes'],
                        'numeroRespostas'=> $row['numeroRespostas'],
                        'noTopico'=> $row['noTopico'],
                        'id'=> $row['id']];
                    $i++;
                }
                if(isset($topico) && empty($post))
                    $this->printPosts($j);
                else if(isset($topico) && isset($post))
                    $this->printPosts($j, $post);
                else
                    $this->printPosts($j, NULL, $usuario);
            }else{
				if(isset($usuario)){
					if(isset($_SESSION['logUsuario'])){
						if(empty($_GET['us']) || ($_SESSION['logUsuario'] == $_GET['us'])){?>
							<small style="margin: 7% 7% 7% 6%;">*Voce ainda nao postou em nenhum topico</small><?php
						}else{?>
							<small style="margin: 7% 7% 7% 6%;">*Este usuario nao postou em nenhum topico</small><?php
						}
					}else{?>
						<small style="margin: 7% 7% 7% 6%;">*Este usuario nao postou em nenhum topico</small><?php
					}
				}
				if(isset($topico) && empty($post)){?>
					<small style="margin: 7% 7% 7% 1%;">*Ninguem postou neste topico</small><?php
				}
			}
        }
        
        public function printPosts($row = [], $pos = NULL, $us = NULL){
			for($i = 0; $i < count($row); $i++){
				$postadoPor = $row[$i]['postadoPor'];
				$conteudo = nl2br($row[$i]['conteudo']);
				$data = $row[$i]['dataPostagem'];
				$likes = $row[$i]['numeroLikes'];
				$comentarios = $row[$i]['numeroRespostas'];
                $id = $row[$i]['id'];
                $top = $row[$i]['noTopico'];
				
				$usuario = new Usuario($postadoPor);
				$uNome = substr($usuario->getNome(), 0, 12);
				$uFoto = $usuario->getFotoDePerfil();
				$uPosts = $usuario->getNumeroPosts();
				$uData = $usuario->getDataRegistro();
				$uEmail = $usuario->getEmail();
				$uNomeU = $usuario->getNomeUnico();
				$uId = $usuario->getId();

				$topObj = new Topico($row[$i]['noTopico']);
				$comunidade = $topObj->getNaComunidade();
				$nomeDeta = $this->tipoUsuarioPost($postadoPor, $comunidade);?>
				<div class='post'>
					<input type='hidden' class='postId' value='<?php echo $id;?>'>
					<a href='perfil.php?us=<?php echo $uNomeU;?>'>
						<div class='postUsuario'><?php 
							echo $nomeDeta[0];?>
							<div><img src='<?php echo $uFoto;?>'></div><?php 
							echo $nomeDeta[1];?>
						</div>
					</a>
					<p class='dataPost'><?php echo $data;?></p>
					<div class='conteudoPost'><?php echo $conteudo;?></div>
					<div class='postRodape'><?php
					if(empty($us)){
                        if(empty($pos)){?>
							<button class='btn btnTransparente exibirComentariosPost' id='exibirComentariosPost<?php echo $id;?>'>Comentarios(<?php echo $comentarios;?>)</button><?php
						}
						if(isset($_SESSION['logUsuario'])){
							$this->editarDeletarPostForm($postadoPor, $id, $comunidade, $row[$i]['conteudo']);
						}
					}?>
						<div class='LikeArea' id='postLikeArea<?php echo $id;?>'><?php
							$this->likeObj->likeForm(NULL, $id);?>
						</div>
					</div>
					<div class='comentarioPost' id='comentarioPost<?php echo $id;?>' style='margin-top: 0;'><?php
					if(empty($us)){?>
						<hr  style='margin-top: 35px;' class='hrPadrao'><?php
						if(isset($_SESSION['logUsuario']))
							$this->comentarPostForm($top, $id);
					}
                    if(empty($us) && empty($pos)){
						$this->exibirComentariosPostArea($id, $comentarios, $top);
					}?>
					</div>
				</div><?php
			}
        }
        
        private function editarDeletarPostForm($postadoPor, $id, $comunidade, $conteudo){
			$nomeU = new CriarNomeUnico();
			$modObj = new Moderador();
			$usObj = new Usuario();
			$logUid = $nomeU->selecionarId($_SESSION['logUsuario'], 'usuario');
			if($logUid == $postadoPor || $modObj->checarModerador($logUid, $comunidade) || $usObj->tipoUsuario($logUid) == 3){?>
				<div class='delEditPost'>
					<input type='submit' id='editPostBotao<?php echo $id;?>' value='editar post' class='btn btnLaranja editPostBotao'><?php
					if($modObj->checarModerador($logUid, $comunidade) || $usObj->tipoUsuario($logUid) == 3){?>
						<input type='submit' id='delPostBotao<?php echo $id;?>' value='deletar post' class='btn btnVermelho'><?php
					}?>
				</div><?php
				if($modObj->checarModerador($logUid, $comunidade) || $usObj->tipoUsuario($logUid) == 3){
					$uniq = uniqid();
					$this->deletarPostForm($id, $uniq);
				}
				$this->editarPostForm($id, $conteudo);
			}
		}

		private function comentarPostForm($topico, $id){?>
			<button class='btn btnAzul' id='botaoExibirComentarioForm<?php echo $id;?>' style="margin: 5px 0 5px 7%;">Comentar</button>
			<div id='comentarPostArea<?php echo $id;?>' style='display: none;'>
				<form id='comentarPostForm<?php echo $id;?>' method='POST' onsubmit='return false' style="margin: 0 0 0 5px;">
					<input type='hidden' name='noTopico' id='noTopico<?php echo $id;?>' value='<?php echo $topico;?>'>						
					<input type='hidden' name='noPost' id='noPost<?php echo $id;?>' value='<?php echo $id;?>'>
					<small>Post deve conter pelo menos 2 caracteres</small><br>
                    <input type='hidden' name='noComentario' id='noComentario<?php echo $id;?>' value='nenhum'>
					<textarea name='postConteudo' id='postConteudo<?php echo $id;?>' placeholder='Comente aqui...'></textarea>
					<input type='submit' id='botaoComentarPost<?php echo $id;?>' name='botaoComentarPost' class='btn btnVerde' value='comentar'>
				</form><br>
				<div class='contadorComentarioPost<?php echo $id;?>'></div>
			</div><?php
        }

		private function exibirComentariosPostArea($post, $numeroComentarios, $topico){?>
			<div class='comentarPostMensagens<?php echo $post;?>'></div><?php
			if($numeroComentarios > 0){?>
                <input type='hidden' id='topicoIdHidden<?php echo $post;?>' value='<?php echo $topico;?>'>
                <input type='hidden' class='postIdHidden' value='<?php echo $post;?>'>
                <div id='comentariosDoPost<?php echo $post;?>'><?php
					$this->exibirPosts($topico, $post);?>
				</div><?php
            }else{?>
				<br><small style="margin: 5px 0 0 8%;">Sem comentarios</small><?php
			}
		}

		private function deletarPostForm($id, $uniq){?>
			<div class='delPost' id='delPost<?php echo $id;?>'>
				<img src='assets/imagens/icones/close.png' class='botaoFecharPadrao' id='fecharDelPost<?php echo $id;?>' class="botaoFecharPadrao">
				<small>Valor: <?php echo $uniq;?><br>
				Tem certeza que deseja deletar o post, se sim digite o valor gerado acima abaixo</small>
				<form id='deletarPostForm<?php echo $id;?>' method='POST' onsubmit='return false'>
					<input type='hidden' name='delPostId' value='<?php echo $id;?>'>
					<input type='hidden' name='delPostValor' value='<?php echo $uniq;?>'>
					<input type='text' name='delPostInput' placeholder='Digite o valor aqui' required>
					<input type='submit' name='delPostBotao' id='delPostFormBotao<?php echo $id;?>' value='deletar post' class='btn btnVermelho'>
				</form>
			</div><?php
		}

		private function editarPostForm($id, $conteudo){?>
			<div class='editPost' id='editPost<?php echo $id;?>'>
				<img src='assets/imagens/icones/close.png' class='botaoFecharPadrao' id='fecharEditPost<?php echo $id;?>' class="botaoFecharPadrao">
				<small>Editar post</small>
				<form id='editarPostForm<?php echo $id;?>' method='POST' onsubmit='return false'>
					<input type='hidden' name='editPostId' value='<?php echo $id;?>'>
					<small>Post deve conter pelo menos 2 caracteres</small>
					<textarea id='editarPostTextarea<?php echo $id;?>' name='editarPostTextarea'><?php echo $conteudo;?></textarea>
					<div class='editarPostContador<?php echo $id;?>'></div>
					<input type='submit' name='editPostBotao' id='editPostFormBotao<?php echo $id;?>' value='editar post' class='btn btnVermelho'>
				</form>
			</div><?php
		}

		private function tipoUsuarioPost($postadoPor, $comunidade){
			$modObj = new Moderador;
			$usuario = new Usuario($postadoPor);
			$uNome = substr($usuario->getNome(), 0, 12);
			$uPosts = $usuario->getNumeroPosts();
			$uData = $usuario->getDataRegistro();
			$uEmail = $usuario->getEmail();
			$checarMod = $modObj->checarModerador($postadoPor, $comunidade);
			if($usuario->getNomeTipoUsuario() == 'administrador')
				$uNome = "<p style='color: #c62828;'>$uNome</p>";
			else if($checarMod)
				$uNome = "<p style='color: #004D40;'>$uNome</p>";
			else
				$uNome = "<p>$uNome</p>";

			if($usuario->getNomeTipoUsuario() != 'administrador'){
				$uPDetalhes = "
				<ul>
					<li>$uEmail</li>
					<li>Posts: $uPosts</li>
					<li>$uData</li>
				</ul>";
			}else
				$uPDetalhes = '';
			return $j = [$uNome, $uPDetalhes];
		}
    };
?>