<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
    class ExibirTopico extends Conexao {
		private $selecUsId;
		private $tipUsCont;
		private $likeObj;

		public function __construct(){
			$this->selectUsId = new CriarNomeUnico();
			$this->tipUsCont = new TopicoTipoUsuarioConteudo();
			$this->likeObj = new Like();
		}

		// exibe todos os topicos nas paginas comunidade, pesquisa, perfil
        public function exibirTodosTopicos($comunidade, $usuario = NULL){
			$str = '';
			if(isset($comunidade))
				$query = $this->con()->prepare("SELECT * FROM topico WHERE naComunidade='$comunidade' ORDER BY dataUltimoPost DESC");
			else if(isset($usuario))
				$query = $this->con()->prepare("SELECT * FROM topico WHERE criadoPor='$usuario' AND naComunidade<>'-50' ORDER BY dataCriacao DESC");
			$query->execute();
			$i = 0; $j = [];
			if($query->rowCount() > 0){
				
				while($row = $query->fetch(PDO::FETCH_ASSOC)){
					$j[$i] = [
						'titulo'=> $row['titulo'],
						'conteudo'=> $row['conteudo'],
						'arquivo'=> $row['arquivo'],
						'numeroLikes'=> $row['numeroLikes'],
						'numeroPosts'=> $row['numeroPosts'],
						'tipoArquivo'=> $row['tipoArquivo'],
						'dataCriacao'=> $row['dataCriacao'],
						'tipoArquivo'=> $row['tipoArquivo'],
						'id'=> $row['id'],
						'criadoPor'=> $row['criadoPor'],
						'comunidade'=> $comunidade];
					$i++;
				}
			}else{
				if(isset($usuario)){
					if(isset($_SESSION['logUsuario'])){
						if(empty($_GET['us']) || ($_SESSION['logUsuario'] == $_GET['us'])){?>
							<small style="margin: -28px 0px 0 6%; position: absolute;">*Voce ainda nao criou nenhum topico</small><?php
						}else{?>
							<small style="margin: -28px 0px 0 6%; position: absolute;">*Este usuario nao criou nenhum topico</small><?php
						}
					}else{?>
						<small style="margin: -28px 0px 0 6%; position: absolute;">*Este usuario nao criou nenhum topico</small><?php
					}
				}else{?>
					<small style="margin: 0 0px 0 6%; position: absolute;">*Nenhum topico ainda foi criado nesta comunidade</small><?php
				}
			}
			if(isset($comunidade))
				$this->printTopico($j);
			else if(isset($usuario))
				$this->printTopico($j, $usuario);
		}

		// exibe topico na pagina topico
		public function exibirPaginaTopico($topico){
			$query = $this->con()->prepare("SELECT * FROM topico WHERE id='$topico'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			$titulo = $row['titulo'];
			$conteudo = nl2br($row['conteudo']);
			$arquivo = $row['arquivo'];
			$tipoArquivo = $row['tipoArquivo'];
			$data = $row['dataCriacao'];
			$criadoPor = $row['criadoPor'];
			$numeroLikes = $row['numeroLikes'];
			$naComunidade = $row['naComunidade'];
			$id = $row['id'];
			
			$usObj = new Usuario($criadoPor);
			$usFotoPerfil = $usObj->getFotoDePerfil();
			$usNomeU = $usObj->getNomeUnico();
			$nomeDeta = $this->tipUsCont->tipoUsuarioTopico($criadoPor, $naComunidade);
			$modObj = new Moderador();
			if(isset($_SESSION['logUsuario'])){
				$lu = $this->selectUsId->selecionarId($_SESSION['logUsuario'], 'usuario');
				$uObj = new Usuario($lu);
				$checU = $uObj->getTipoUsuario();
				if($modObj->checarModerador($lu, $naComunidade) || $lu == $criadoPor || $checU == 3){?>
					<button class='btn btnLaranja' id='editarTopico'>editarTopico</button><?php
				}
			}?>
			<h2 class='tituloTopico'><?php echo $titulo;?></h2>
			<div class='topicoPaginaTopico'>
				<div class='topicoCabecalho'>
					<p>Criado: <?php echo $data;?></p>
				</div>
				<div class='detalhesUsuario'>
					<a href='perfil.php?us=<?php echo $usNomeU?>'><?php 
						echo $nomeDeta[0];?>
						<div><img src='<?php echo $usFotoPerfil;?>'></div>
					</a><?php 
					echo $nomeDeta[1];?>
				</div><?php 
				$this->tipUsCont->tipoConteudo($tipoArquivo, $arquivo, 'sim', $id, $conteudo);?>
				<div class='topicoRodape'>
					<input type='hidden' id='topicoNome' value='<?php echo $id;?>'>
<<<<<<< HEAD
					<div class='LikeArea' id='topicoLikeArea'><?php
						$this->likeObj->likeForm($id, NULL);?>
					</div>
=======
					<div class='LikeArea' id='topicoLikeArea'></div>
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
				</div>
			</div><?php
		}

		// print todos os topicos
		public function printTopico($row = [], $us = NULL){
			for($i = 0; $i < count($row); $i++){
				$titulo = $row[$i]['titulo'];
				$conteudo = nl2br($row[$i]['conteudo']);
				$arquivo = $row[$i]['arquivo'];
				$numeroLikes = $row[$i]['numeroLikes'];
				$numeroPosts = $row[$i]['numeroPosts'];
				$tipoArquivo =  $row[$i]['tipoArquivo'];
				$data =  $row[$i]['dataCriacao'];
				$tipoArquivo = $row[$i]['tipoArquivo'];
				$id = $row[$i]['id'];
				$comunidade = $row[$i]['comunidade'];
				
				$criadoPor = $row[$i]['criadoPor'];
				$usObj = new Usuario($criadoPor);
				$nome = $usObj->getNome();
				$uNome = substr($nome, 0, 5);
				$uFoto = $usObj->getFotoDePerfil();
				$nomeU = $usObj->getNomeUnico();
				$uId = $usObj->getId();
				$modObj = new Moderador();
				$checarMod = $modObj->checarModerador($uId, $comunidade);
				if($checarMod)
					$uNome = "<p style='color: #00695C; display: inline;'>".$uNome."</p>";
				else if($usObj->getNomeTipoUsuario() == 'administrador')
					$uNome = "<p style='color: #c62828; display: inline;'>".$uNome."</p>";?>
				<div class='topicoInteiro'>
					<a href='perfil.php?us=<?php echo $nomeU;?>'><div class='linkUsuario'></div></a>
					<a href='topico.php?t=<?php echo $id;?>'>
						<input type='hidden' class='topicoId' value='<?php echo $id;?>'>
						<div class='topico' id='topico<?php echo $id;?>'>
							<h4><?php echo $titulo;?></h4>
							<div class='topicoUsuario'>
								Postado por: <?php echo $uNome;?>
								<div>
									<img src='<?php echo $uFoto?>'>
								</div>
							</div>
							<div class='topicoConteudo'><?php 
								$this->tipUsCont->tipoConteudo($tipoArquivo, $arquivo, 'nao', $id, $conteudo);?>
							</div>
							<ul>
								<li>Posts: <?php echo $numeroPosts;?></li>
								<li>Likes: <?php echo $numeroLikes;?></li>
								<li><?php echo $data;?></li>
							</ul>
						</div>
					</a><?php
					if(isset($_SESSION['logUsuario']) && empty($us))
						$this->deletarTopicoForm($id, $_SESSION['logUsuario'], $titulo, $comunidade);?>
				</div><?php
			}
		}
	
		// exibe formulatio para deletar topico
		private function deletarTopicoForm($id, $log, $titulo, $comunidade){
			$logU = $this->selectUsId->selecionarId($log, 'usuario');
			$uObj = new Usuario($logU);
			$checUs = $uObj->getTipoUsuario();
			$modObj = new Moderador();
			$subTit = substr($titulo, 0, 15);
			$textoConf = uniqid();
			if($modObj->checarModerador($logU, $comunidade) || $checUs == 3){?>
				<div style='position: absolute; z-index: 80; margin: -65px 0 0 3px;'><input type='submit' class='btn btnVermelho' id='deletarTopico<?php echo $id;?>' value='excluir topico'></div>
				<div class='fundoOpacoPadrao'></div>
				<div id='delTopicoCaixa<?php echo $id;?>' class='delTopicoCaixa'>
					<img src='assets/imagens/icones/close.png' id='fecharDelTopicoCaixa<?php echo $id;?>' class='fecharDelTopicoCaixa botaoFecharPadrao'>
					<small>Tem certeza que deseja excluir o topico <?php echo '"'.strtoupper($subTit);?>..."<br>
					Se sim digite a seguinte sentenca abaixo '<?php echo $textoConf;?>' junto com seu nome de usuario em letra maiuscula<br>
					Ex.: se a sentenca for '1a2b3c4d' e seu nome de usuario joao voce devera digitar '1a2b3c4dJOAO'</small>
					<form id='deletarTopicoForm<?php echo $id;?>' method='POST' onsubmit='return false'>
						<input type='hidden' name='topico' value='<?php echo $id;?>'>
						<input type='hidden' name='delTopTextComparacao' value='<?php echo $textoConf;?>'>
						<input type='text' name='delTopTextConfirmacao' placeholder='Digite a sentenca aqui' required>
						<input type='submit' id='botaoDeletarTopico<?php echo $id;?>' class='btn btnAzul' value='confirmar'>
					</form>
				</div><?php
			}
		}
    };
?>