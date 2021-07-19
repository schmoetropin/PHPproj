<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
    class CriarComunidade extends Conexao {
		private $checarVariaveis;
		private $checarArquivo;
		private $atualizarDados;
		private $nomeUnico;
    	public function __construct(){
			$this->checarVariaveis = new ChecarValoresInseridos();
			$this->checarArquivo = new ChecarArquivo();
			$this->atualizarDados = new AtualizarMesasColunas();
			$this->nomeUnico = new CriarNomeUnico();
		}

        public function criarCominidade($criadoPor, $nom, $cont, $fot){
			$nome = FormatarValoresInseridos::formatarTexto($nom);
			$conteudo = FormatarValoresInseridos::formatarTexto($cont);
			$checarTitulo = $this->checarVariaveis->nomeComunidade($nome);
			$checarDescricao = $this->checarVariaveis->checarDescricaoComunidade($conteudo);
			if($checarTitulo && $checarDescricao){
				$nomeUnico = $this->nomeUnico->criar($nome, 'comunidade');
				$foto = $this->checarArquivo->fotoCominidade($fot, $nomeUnico);
				if($foto){
					$this->inserirValoresNaComunidade($criadoPor, $nome, $conteudo, $foto, $nomeUnico);
					echo "Comunidade criada!";
				}
			}
		}
				
		private function inserirValoresNaComunidade($criadoPor, $nome, $conteudo, $fot, $nomeUnico){
			$data = date('Y-m-d');
			$dataT = date('Y-m-d H:i:s');
			$query = $this->con()->prepare("INSERT INTO comunidade(nome, descricao, criadoPor, dataCriacao, dataUltimoTopico, fotoComunidade, nomeUnico) VALUES(:nome, :descricao, :criadoPor, :dataCriacao, :dataUltimoTopico, :fotoComunidade, :nomeUnico)");
			$arr = array(
				':nome'=> $nome,
				':descricao'=> $conteudo,
				':criadoPor'=> $criadoPor,
				':dataCriacao'=> $data,
				':dataUltimoTopico'=> $dataT,
				':fotoComunidade'=> $fot,
				':nomeUnico'=> $nomeUnico);
			$query->execute($arr);
			$this->atualizarDados->atualizarUsuarioModInscricaoComunidade($nomeUnico, $criadoPor);
		}
    }
?>