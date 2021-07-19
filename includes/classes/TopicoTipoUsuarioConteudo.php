<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
    class TopicoTipoUsuarioConteudo{
		// tipo usuario que postou o topico
		public function tipoUsuarioTopico($criadoPor, $naComunidade){
			$modObj = new Moderador();
			$usObj = new Usuario($criadoPor);
			$usNome = $usObj->getNome();
			$usNome = substr($usNome, 0, 12);
			$usEmail = $usObj->getEmail();
			$usData = $usObj->getDataRegistro();
			$usNumPosts = $usObj->getNumeroPosts();
			$usDescricao = $usObj->getDescricaoPerfil();
			$checarMod = $modObj->checarModerador($criadoPor, $naComunidade);
			if($checarMod){
				$usNome = "<p style='color: #00695C;'>".$usNome."</p>";
				$usDetalhes = "
				<ul>
					<li>$usEmail</li>
					<li>Posts: $usNumPosts</li>
					<li>$usData</li>
					<li>Descricao: $usDescricao</li>
				</ul>";
			}else if($usObj->getNomeTipoUsuario() == 'administrador'){
				$usNome = "<p style='color: #c62828;'>".$usNome."</p>";
				$usDetalhes = '';
			}else{
				$usNome = "<p>".$usNome."</p>";
				$usDetalhes = "
				<ul>
					<li>$usEmail</li>
					<li>Posts: $usNumPosts</li>
					<li>$usData</li>
					<li>Descricao: $usDescricao</li>
				</ul>";
			}
			return $j = [$usNome, $usDetalhes];
		}

        // tipo de conteudo do topico imagem, video, etc
		public function tipoConteudo($tipoArquivo, $arquivo, $exibCont, $id, $conteudo){
			if($tipoArquivo == 'semArquivo'){
				if($exibCont == 'edit'){?>
					<p class='mensagemErro'>*Sem Midia</p><?php
				}else{?>
					<div class='conteudoTopico'><?php echo $conteudo;?></div><?php
				}
			}else if($tipoArquivo == 'imagem' || $tipoArquivo == 'embbedImagem'){?>
				<div class='conteudoTopico'>
					<img src='<?php echo $arquivo;?>' class='preVisMidEditTop'><br><?
				if($exibCont == 'sim'){
					echo $conteudo;
				}?>
				</div><?php
			}else if($tipoArquivo == 'video'){?>
				<div class='conteudoTopico'><?php
					if($exibCont == 'sim'){?>
						<video controls autoplay='autoplay'><?php
					}else if($exibCont == 'top'){?>
						<video id='top4TopVideo<?php echo $id;?>' muted><?php
					}else{?>
						<video id='topicoVideo<?php echo $id;?>' muted><?php
					}?>
						<source src='<?php echo $arquivo;?>'>
					</video><br><?php
					if($exibCont == 'sim'){
						echo $conteudo;
					}?>
				</div><?php
			}else if($tipoArquivo == 'embbedVideo'){
				$subArquivo = substr($arquivo, 32);
				$subArquivo = substr($subArquivo, 0, 11);?>
				<div class='conteudoTopico'>
					<iframe width='700' height='400' src='https://www.youtube.com/embed/<?php echo $subArquivo;?>' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe><br><?php
					if($exibCont == 'sim'){
						echo $conteudo;
					}?>
				</div><?php
			}
		}
    }
?>