<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
    class AtualizarMesasColunas extends Conexao {
		//apos criar comuniade, atualiza usuario para moderador e o inscreve da mesma
        public function atualizarUsuarioModInscricaoComunidade($nomeUnico, $criadoPor){
			$nomeUn = new CriarNomeUnico();
			$comunidade = $nomeUn->selecionarId($nomeUnico, 'comunidade');
			$uOb = new Usuario($criadoPor);
			$tipoU = $uOb->getTipoUsuario();
			if($tipoU != 3){
				$modObj = new Moderador();
				$modObj->atualizarModUsuario($criadoPor, $comunidade);
				$inscObj = new Inscrever();
				$inscObj->inscreverUs($criadoPor, $comunidade);
			}
        }
		
		// atualiza numero de topicos na comunidade e usuario, e tambem decrementa numero de posts
		// caso o topico seja deletado
        public function atualizarUsuarioComunidadeNTopicos($us, $com, $post, $valor){
			$usObj = new Usuario($us);
			$usTopicos = $usObj->getNumeroTopicos();
			if($valor == '+')
				$usTopicos++;
			else
				$usTopicos--;
			$usObj->setNumeroTopicos($usTopicos);
			
			$comObj = new Comunidade($com);
			$comTopicos = $comObj->getNumeroTopicos();
			if($valor == '+')
				$comTopicos++;
			else
				$comTopicos--;
			$comObj->setNumeroTopicos($comTopicos);
			
			if($valor == '-'){
				if($post > 0){
					$comPosts = $comObj->getNumeroPosts();
					$comPosts = $comPosts - $post;
					$comObj->setNumeroTopicos($comPosts);
				}
			}
        }
		
		// atualiza usuario, comunidade e topico sobre o numero de posts
        public function atualizarUsuarioComunidadeTopicoPostsNPosts($postadoPor, $topico, $comunidade, $post, $valor){
			$uObj = new Usuario($postadoPor);
            $uNumPost = $uObj->getNumeroPosts();
            if($valor == '+')
                $uNumPost++;
            else
                $uNumPost--;
			$uObj->setNumeroPosts($uNumPost);
			
			$topObj = new Topico($topico);
            $topNumPost = $topObj->getNumeroPosts();
            if($valor == '+')
                $topNumPost++;
            else
                $topNumPost--;
			$topObj->setNumeroPosts($topNumPost);
			
			$comunidade = $topObj->getNaComunidade();
			$comunObj = new Comunidade($comunidade);
            $comunNumPost = $comunObj->getNumeroPosts();
            if($valor == '+')
                $comunNumPost++;
            else
                $comunNumPost--;
			$comunObj->setNumeroPosts($comunNumPost);
			
			if(isset($post)){
				$poObj = new Post($post);
				$comentarios = $poObj->getNumeroRespostas();
				if($valor == '+')
					$comentarios++;
				else
					$comentarios--;
				$poObj->setNumeroRespostas($comentarios);
			}
        }
		
		// atualiza numero likes
        public function atualisarLikes($usuario, $topico, $post, $valor){
			if(isset($usuario)){
				$usObj = new Usuario($usuario);
				$usLikes = $usrObj->getNumeroLikes();
				if($valor == '+')
					$usLikes++;
				else
					$usLikes--;
				$usObj->setNumeroLikes($usLikes);
			}
			
			if(isset($topico)){
				$topObj = new Topico($topico);
				$topLikes = $topObj->getNumeroLikes();
				if($valor == '+')
					$topLikes++;
				else
					$topLikes--;
				$topObj->setNumeroLikes($topLikes);
			}
			
			if(isset($post)){
				$posObj = new Post($post);
				$posLikes = $posObj->getNumeroLikes();
				if($valor == '+')
					$posLikes++;
				else
					$posLikes--;
				$posObj->setNumeroLikes($posLikes);
			}
		}

		// atualiza numero amigos
		public function atualizarUsuarioAmigos($us1, $us2, $val){
			$u1Obj = new Usuario($us1);
			$u1NumeroAmigos = $u1Obj->getNumeroAmigos();
			if($val == '-')
				$u1NumeroAmigos--;
			else
				$u1NumeroAmigos++;
			$u1Obj->setNumeroAmigos($u1NumeroAmigos);
			
			$u2Obj = new Usuario($us2);
			$u2NumeroAmigos = $u2Obj->getNumeroAmigos();
			if($val == '-')
				$u2NumeroAmigos--;
			else
				$u2NumeroAmigos++;
			$u2Obj->setNumeroAmigos($u2NumeroAmigos);
		}

		// atualiza numero inscritos na comunidade
		public function atualizarInscricaoComunidadeUsuario($comunidade, $usuario, $valor){
			$comun = new Comunidade($comunidade);
			$inscritos = $comun->getNumeroInscritos();
			if($valor == '+')
				$inscritos++;
			else
				$inscritos--;
			$comun->setNumeroInscritos($inscritos);
			
			if(isset($usuario)){
				$us = new Usuario($usuario);
				$usInsc = $us->getNumeroInscricoes();
				if($valor == '+')
					$usInsc++;
				else
					$usInsc--;
				$us->setNumeroInscricoes($usInsc);
			}
		}
    };
?>