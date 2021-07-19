<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
	class ChecarArquivo{
		private $fotoDePerfilExtencao = array('jpg', 'jpeg', 'png');
		private $fotoDePerfilTamanho = 35000;
		private $fotoComunidadeExtencao = array('jpg', 'jpeg', 'png', 'gif');
		private $fotoComunidadeTamanho = 1000000;
		private $videoExtencao = array('mp4', 'flv');
		private $videoTamanho = 10000000;
		private $mensagemErro = [
			"*Nenhum arquivo foi selecionado \n",
			"*Extancao nao aceita \n",
			"*Arquivo muito grande \n",
			"*O arquivo possui erros \n",
			"*Erro ao mover o arquivo \n",
			"*ERRO* \n"];
		
		// checha, upload e retorna local da foto de perfil
		public function fotoDePerfil($arquivo, $id){
			$arquivoExtencao = $this->arquivoExtencao($arquivo);
			$arquivoTamanho = $this->arquivoTamanho($arquivo);
			$arquivoErro = $this->arquivoErro($arquivo);
			$checar = $this->checarFotoDePerfil($arquivoExtencao, $arquivoTamanho, $arquivoErro);
			if($checar){
				$pasta = 'uploads/fotoDePerfil/';
				$localArquivo = $pasta.$id.uniqid().'.'.$arquivoExtencao;
				$localDoArquivo = $this->moverArquivo($arquivo, $localArquivo);
				if($localDoArquivo)
					return $localDoArquivo;
				else
					return false;
			}
			else
				return false;
		}
		
		// checha, upload e retorna local da foto da comunidade
		public function fotoCominidade($arquivo, $comun){
			$arquivoExtencao = $this->arquivoExtencao($arquivo);
			$arquivoTamanho = $this->arquivoTamanho($arquivo);
			$arquivoErro = $this->arquivoErro($arquivo);
			$checar = $this->checarFotoComunidade($arquivoExtencao, $arquivoTamanho, $arquivoErro);
			if($checar){
				$pasta = 'uploads/fotoComunidade/';
				$localArquivo = $pasta.$comun.uniqid().'.'.$arquivoExtencao;
				$localDoArquivo = $this->moverArquivo($arquivo, $localArquivo);
				if($localDoArquivo)
					return $localDoArquivo;
				else
					return false;
			}
			else
				return false;
		}
		
		// checha, upload e retorna local da foto do topico
		public function fotoTopico($arquivo, $topic){
			$arquivoExtencao = $this->arquivoExtencao($arquivo);
			$arquivoTamanho = $this->arquivoTamanho($arquivo);
			$arquivoErro = $this->arquivoErro($arquivo);
			$checar = $this->checarFotoComunidade($arquivoExtencao, $arquivoTamanho, $arquivoErro);
			if($checar){
				$pasta = 'uploads/fotoTopico/';
				$localArquivo = $pasta.$topic.uniqid().'.'.$arquivoExtencao;
				$localDoArquivo = $this->moverArquivo($arquivo, $localArquivo);
				if($localDoArquivo)
					return $localDoArquivo;
				else
					return false;
			}
			else
				return false;
		}
		
		// checha, upload e retorna local do video do topico
		public function videoTopico($arquivo, $topic){
			$arquivoExtencao = $this->arquivoExtencao($arquivo);
			$arquivoTamanho = $this->arquivoTamanho($arquivo);
			$arquivoErro = $this->arquivoErro($arquivo);
			$checar = $this->checarVideo($arquivoExtencao, $arquivoTamanho, $arquivoErro);
			if($checar){
				$pasta = 'uploads/videoTopico/';
				$localArquivo = $pasta.$topic.uniqid().'.'.$arquivoExtencao;
				$localDoArquivo = $this->moverArquivo($arquivo, $localArquivo);
				if($localDoArquivo)
					return $localDoArquivo;
				else
					return false;
			}else
				return false;			
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
			$tipo = substr($arquivo['type'], 6);
			$tipo = strtolower($tipo);
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
			if($tamanho == 0){
				echo $this->mensagemErro[0];
				return false;
			}
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
			if($tamanho == 0){
				echo $this->mensagemErro[0];
				return false;
			}
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
			if($tamanho == 0){
				echo $this->mensagemErro[0];
				return false;
			}
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
