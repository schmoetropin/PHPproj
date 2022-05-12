<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
    class CriarTopico extends Conexao {
        private $checarValores;
		private $checarArquivo;
		private $atualizarDados;
		private $nomeUnico;
        public function __construct(){
			$this->checarValores = new ChecarValoresInseridos();
			$this->checarArquivo = new ChecarArquivo();
			$this->atualizarDados = new AtualizarMesasColunas();
			$this->nomeUnico = new CriarNomeUnico();
        }
        
        public function criarTopico($criadoPor, $comunidade, $tit, $arq, $emb, $cont){
			$uObj = new Usuario($criadoPor);
			$tipoUs = $uObj->getTipoUsuario();
			$inscObj = new Inscrever();
			if($inscObj->checarInscricao($criadoPor, $comunidade) > 0 || $tipoUs == 3){
				$titulo = FormatarValoresInseridos::formatarTexto($tit);
				$conteudo = FormatarValoresInseridos::formatarTexto($cont);		
				$checarTitulo = $this->checarValores->checarTitulo($titulo);
				$checarCont = $this->checarValores->checarConteudo($conteudo);
				$tipoArquivo = null;
				$embbed = null;
				if(isset($emb))
					$embbed = FormatarValoresInseridos::formatarTexto($emb);
				if($checarTitulo && $checarCont){
					$topTempNom = $this->nomeUnico->criar($titulo, 'topico');
					$topTempNom  = $criadoPor.$topTempNom;
					if(isset($arq) && empty($emb)){
						if($tipoArquivo = $this->checarArquivo->checarTipoDeArquivo($arq)){
							if($tipoArquivo == 'imagem')
								$arquivo = $this->checarArquivo->fotoTopico($arq, $topTempNom);
							else if($tipoArquivo == 'video')
								$arquivo = $this->checarArquivo->videoTopico($arq, $topTempNom);
							else 
								$tipoArquivo = false;
						}
						return false;
					}else if(isset($emb) && empty($arq)){
						$tipoArquivo = $this->checarEmbbedLink($embbed);
						$arquivo = substr($embbed, 9);					
					}else if(empty($arq) && empty($emb)){
						$tipoArquivo = 'semArquivo';
						$arquivo = NULL;
					}else{
						echo '*Erro no tipo de arquivo.</br>';
						return false;
					}
					if($tipoArquivo){
						$this->inserirValoresNoTopico($criadoPor, $comunidade, $titulo, $tipoArquivo, $arquivo, $conteudo);
						$this->atualizarDados->atualizarUsuarioComunidadeNTopicos($criadoPor, $comunidade, NULL, '+');
						echo 'Topico criado!</br>';
						return true;
					}
					return false;
				}
				return false;
			}else{
				echo '*Voce nao e inscrito nessa comunidade!<br />';
				return false;
			}
		}
		
		private function checarEmbbedLink($emb){
			$tipo = substr($emb, 0, 9);
			if($tipo == '[*IMAGE*]')
				return 'embbedImagem';
			else if($tipo == '[*VIDEO*]'){
				$checarVideo = substr($emb, 9, 32);
				if($checarVideo != 'https://www.youtube.com/watch?v='){
					echo "*Isto nao e um link do youtube \n";
					return false;
				}
				return 'embbedVideo';
			}else
				return false;
		}
		
		private function inserirValoresNoTopico($criadoPor, $comunidade, $titulo, $tipoArquivo, $arquivo, $conteudo){
			$data = date('Y-m-d H:i:s');
			$query = $this->con()->prepare('INSERT INTO topico(titulo, conteudo, arquivo, tipoArquivo, criadoPor, naComunidade, dataCriacao, dataUltimoPost) VALUES(:titulo, :conteudo, :arquivo, :tipoArquivo, :criadoPor, :naComunidade, :dataCriacao, :dataUltimoPost)');
			$arr = array(
				':titulo' => $titulo,
				':conteudo' => $conteudo,
				':arquivo' => $arquivo,
				':tipoArquivo' => $tipoArquivo,
				':criadoPor' => $criadoPor,
				':naComunidade' => $comunidade,
				':dataCriacao' => $data,
				':dataUltimoPost' => $data);
			$query->execute($arr);
			$comObj = new Comunidade($comunidade);
			$comObj->setDataUltimoTopico($data);
        }
    };
?>