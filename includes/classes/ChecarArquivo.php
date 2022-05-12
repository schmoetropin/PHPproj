<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
	class ChecarArquivo{
		private $fotoDePerfilExtencao = array('image/jpg', 'image/jpeg', 'image/png');
		private $fotoDePerfilTamanho = 35000;
		private $fotoComunidadeExtencao = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
		private $fotoComunidadeTamanho = 1000000;
		private $videoExtencao = array('video/mp4', 'video/flv');
		private $videoTamanho = 10000000;
		private $mensagemErro = [
			'*Nenhum arquivo foi selecionado.<br />',
			'*Extancao nao aceita.<br />',
			'*Arquivo muito grande.<br />',
			'*O arquivo possui erros.<br />',
			'*Erro ao mover o arquivo.<br />',
			'*ERRO*.<br />'];
		
		// checha, upload e retorna local da foto de perfil
		public function fotoDePerfil($arquivo, $id){
<<<<<<< HEAD
			if($arquivo['size'] > 0){
				$arquivoExtencao = $this->arquivoExtencao($arquivo);
				$arquivoTamanho = $this->arquivoTamanho($arquivo);
				$arquivoErro = $this->arquivoErro($arquivo);
				$checar = $this->checarFotoDePerfil($arquivoExtencao, $arquivoTamanho, $arquivoErro);
				if($checar){
					$pasta = 'uploads/fotoDePerfil/';
					$arquivoExtencao = substr($arquivoExtencao,6);
					$localArquivo = $pasta.$id.uniqid().'.'.$arquivoExtencao;
					$localDoArquivo = $this->moverArquivo($arquivo, $localArquivo);
					if($localDoArquivo)
						return $localDoArquivo;
					return false;
				}
				return false;
			}
			echo $this->mensagemErro[0];
			return false;
=======
			$arquivoExtencao = $this->arquivoExtencao($arquivo);
			$arquivoTamanho = $this->arquivoTamanho($arquivo);
			$arquivoErro = $this->arquivoErro($arquivo);
			$checar = $this->checarFotoDePerfil($arquivoExtencao, $arquivoTamanho, $arquivoErro);
			if($checar){
				$pasta = 'uploads/fotoDePerfil/';
				$arquivoExtencao = substr($arquivoExtencao,6);
				$localArquivo = $pasta.$id.uniqid().'.'.$arquivoExtencao;
				$localDoArquivo = $this->moverArquivo($arquivo, $localArquivo);
				if($localDoArquivo)
					return $localDoArquivo;
				else
					return false;
			}
			else
				return false;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
		}
		
		// checha, upload e retorna local da foto da comunidade
		public function fotoCominidade($arquivo, $comun){
<<<<<<< HEAD
			if($arquivo['size'] > 0){
				$arquivoTamanho = $this->arquivoTamanho($arquivo);
				$arquivoExtencao = $this->arquivoExtencao($arquivo);
				$arquivoErro = $this->arquivoErro($arquivo);
				$checar = $this->checarFotoComunidade($arquivoExtencao, $arquivoTamanho, $arquivoErro);
				if($checar){
					$pasta = 'uploads/fotoComunidade/';
					$arquivoExtencao = substr($arquivoExtencao,6);
					$localArquivo = $pasta.$comun.uniqid().'.'.$arquivoExtencao;
					$localDoArquivo = $this->moverArquivo($arquivo, $localArquivo);
					if($localDoArquivo)
						return $localDoArquivo;
					return false;
				}
				return false;
			}
			echo $this->mensagemErro[0];
			return false;
=======
			$arquivoExtencao = $this->arquivoExtencao($arquivo);
			$arquivoTamanho = $this->arquivoTamanho($arquivo);
			$arquivoErro = $this->arquivoErro($arquivo);
			$checar = $this->checarFotoComunidade($arquivoExtencao, $arquivoTamanho, $arquivoErro);
			if($checar){
				$pasta = 'uploads/fotoComunidade/';
				$arquivoExtencao = substr($arquivoExtencao,6);
				$localArquivo = $pasta.$comun.uniqid().'.'.$arquivoExtencao;
				$localDoArquivo = $this->moverArquivo($arquivo, $localArquivo);
				if($localDoArquivo)
					return $localDoArquivo;
				else
					return false;
			}
			else
				return false;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
		}
		
		// checha, upload e retorna local da foto do topico
		public function fotoTopico($arquivo, $topic){
<<<<<<< HEAD
			if($arquivo['size'] > 0){
				$arquivoExtencao = $this->arquivoExtencao($arquivo);
				$arquivoTamanho = $this->arquivoTamanho($arquivo);
				$arquivoErro = $this->arquivoErro($arquivo);
				$checar = $this->checarFotoComunidade($arquivoExtencao, $arquivoTamanho, $arquivoErro);
				if($checar){
					$pasta = 'uploads/fotoTopico/';
					$arquivoExtencao = substr($arquivoExtencao,6);
					$localArquivo = $pasta.$topic.uniqid().'.'.$arquivoExtencao;
					$localDoArquivo = $this->moverArquivo($arquivo, $localArquivo);
					if($localDoArquivo)
						return $localDoArquivo;
					return false;
				}
				return false;
			}
			echo $this->mensagemErro[0];
			return false;
=======
			$arquivoExtencao = $this->arquivoExtencao($arquivo);
			$arquivoTamanho = $this->arquivoTamanho($arquivo);
			$arquivoErro = $this->arquivoErro($arquivo);
			$checar = $this->checarFotoComunidade($arquivoExtencao, $arquivoTamanho, $arquivoErro);
			if($checar){
				$pasta = 'uploads/fotoTopico/';
				$arquivoExtencao = substr($arquivoExtencao,6);
				$localArquivo = $pasta.$topic.uniqid().'.'.$arquivoExtencao;
				$localDoArquivo = $this->moverArquivo($arquivo, $localArquivo);
				if($localDoArquivo)
					return $localDoArquivo;
				else
					return false;
			}
			else
				return false;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
		}
		
		// checha, upload e retorna local do video do topico
		public function videoTopico($arquivo, $topic){
<<<<<<< HEAD
			if($arquivo['size'] > 0){	
				$arquivoExtencao = $this->arquivoExtencao($arquivo);
				$arquivoTamanho = $this->arquivoTamanho($arquivo);
				$arquivoErro = $this->arquivoErro($arquivo);
				$checar = $this->checarVideo($arquivoExtencao, $arquivoTamanho, $arquivoErro);
				if($checar){
					$pasta = 'uploads/videoTopico/';
					$arquivoExtencao = substr($arquivoExtencao,6);
					$localArquivo = $pasta.$topic.uniqid().'.'.$arquivoExtencao;
					$localDoArquivo = $this->moverArquivo($arquivo, $localArquivo);
					if($localDoArquivo)
						return $localDoArquivo;
					return false;
				}
				return false;
			}
			echo $this->mensagemErro[0];
			return false;			
=======
			$arquivoExtencao = $this->arquivoExtencao($arquivo);
			$arquivoTamanho = $this->arquivoTamanho($arquivo);
			$arquivoErro = $this->arquivoErro($arquivo);
			$checar = $this->checarVideo($arquivoExtencao, $arquivoTamanho, $arquivoErro);
			if($checar){
				$pasta = 'uploads/videoTopico/';
				$arquivoExtencao = substr($arquivoExtencao,6);
				$localArquivo = $pasta.$topic.uniqid().'.'.$arquivoExtencao;
				$localDoArquivo = $this->moverArquivo($arquivo, $localArquivo);
				if($localDoArquivo)
					return $localDoArquivo;
				else
					return false;
			}else
				return false;			
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
		}
		
		//checa tipo de arquivo, video ou imagem
		public function checarTipoDeArquivo($arq){
			$tipoArquivo = $this->arquivoExtencao($arq);
			if(in_array($tipoArquivo, $this->fotoComunidadeExtencao))
				return 'imagem';
			else if(in_array($tipoArquivo, $this->videoExtencao))
				return 'video';
			else
				return false;
		}
		
		// retorna a extencao do arquivo
		private function arquivoExtencao($arquivo){
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$tipo = finfo_file($finfo, $arquivo['tmp_name']);
			finfo_close($finfo);
			return $tipo;
		}
		
		// retorna o tamanho do arquivo
		private function arquivoTamanho($arquivo){
			return $arquivo['size'];
		}
		
		// checa se o arquivo contem erros
		private function arquivoErro($arquivo){
			if($arquivo['error'])
				return true;
			else
				return false;
		}
		
		// checa tamanho, extencao e se a foto de perfil contem erros
		private function checarFotoDePerfil($extencao, $tamanho, $erro){
<<<<<<< HEAD
=======
			if($tamanho == 0){
				echo $this->mensagemErro[0];
				return false;
			}
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			if(!in_array($extencao, $this->fotoDePerfilExtencao)){
				echo $this->mensagemErro[1];
				return false;
			}
			if($tamanho > $this->fotoDePerfilTamanho){
				echo $this->mensagemErro[2];
				return false;
			}
			if($erro){
				echo $this->mensagemErro[3];
				return false;
			}
			return true;
		}
		
		// checa tamanho, extencao e se a foto da comunidade contem erros
		private function checarFotoComunidade($extencao, $tamanho, $erro){
<<<<<<< HEAD
=======
			if($tamanho == 0){
				echo $this->mensagemErro[0];
				return false;
			}
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			if(!in_array($extencao, $this->fotoComunidadeExtencao)){
				echo $this->mensagemErro[1];
				return false;
			}
			if($tamanho > $this->fotoComunidadeTamanho){
				echo $this->mensagemErro[2];
				return false;
			}
			if($erro){
				echo $this->mensagemErro[3];
				return false;
			}
			return true;
		}
		
		// checa tamanho, extencao e se o video do topico contem erros
		private function checarVideo($extencao, $tamanho, $erro){
<<<<<<< HEAD
=======
			if($tamanho == 0){
				echo $this->mensagemErro[0];
				return false;
			}
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			if(!in_array($extencao, $this->videoExtencao)){
				echo $this->mensagemErro[1];
				return false;
			}
			if($tamanho > $this->videoTamanho){
				echo $this->mensagemErro[2];
				return false;
			}
			if($erro){
				echo $this->mensagemErro[3];
				return false;
			}
			return true;
		}
		
		// upload do arquivo e retorna o local do mesmo
		private function moverArquivo($arquivo, $localArquivo){
			if(move_uploaded_file($arquivo['tmp_name'], '../../'.$localArquivo))
				return $localArquivo;
			else{
				echo $this->mensagemErro[4];
				return false;
			}
		}
	};
?>
