<?php
	if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
    class ExibirTop4Topicos extends Conexao {
        private $tipUsCont;

        public function __construct(){
            $this->tipUsCont = new TopicoTipoUsuarioConteudo();
        }
		// exibe top4 topicos na pagina index ou comunidade
		// select id, titulo, numeroLikes, dataCriacao from topico where naComunidade <> -50 ORDER BY `topico`.`dataCriacao` DESC limit 4 
		public function exibirto4Topicos($comunidade = NULL){
			$str = '';
			if(isset($comunidade)){
				$query = $this->con()->prepare(
				   "SELECT noTopico, COUNT(*) AS topico 
					FROM botaoLike 
					WHERE dataLike >= NOW() - INTERVAL 1 DAY
					AND comunidadeTopico='$comunidade' 
					GROUP BY noTopico 
					ORDER BY topico DESC 
					LIMIT 4");
				$query->execute();
				if($query->rowCount() < 4){
					$query = $this->con()->prepare(
						"SELECT noTopico, COUNT(*) AS topico 
						 FROM botaoLike 
						 WHERE comunidadeTopico='$comunidade' 
						 GROUP BY noTopico 
						 ORDER BY topico DESC 
						 LIMIT 4");
					 $query->execute();
				}
				if($query->rowCount() == 0){?>
					<small style="margin: 0 0 0 6%;">*Nenhum topico ainda na lista de mais populares</small><?php
				}
			}else{
				$query = $this->con()->prepare(
				   "SELECT noTopico, COUNT(*) AS topico 
					FROM botaoLike 
					WHERE dataLike >= NOW() - INTERVAL 1 DAY 
					AND comunidadeTopico<>'-50'
					GROUP BY noTopico 
					ORDER BY topico DESC 
					LIMIT 4");
				$query->execute();
				if($query->rowCount() < 4){
					$query = $this->con()->prepare(
						"SELECT noTopico, COUNT(*) AS topico 
						 FROM botaoLike 
						 WHERE comunidadeTopico<>'-50'
						 GROUP BY noTopico 
						 ORDER BY topico DESC 
						 LIMIT 4");
					 $query->execute();
				}
			}
			$j = [];$i = 0;
			while($row = $query->fetch(PDO::FETCH_ASSOC)){
				$topObj = new Topico($row['noTopico']);
				$j[$i] =[
					'titulo'=> $topObj->getTitulo(),
					'arquivo'=> $topObj->getArquivo(),
					'numeroLikes'=> $topObj->getNumeroLikes(),
					'tipoArquivo'=> $topObj->getTipoArquivo(),
					'data'=> $topObj->getDataCriacao(),
					'conteudo'=> nl2br($topObj->getConteudo()),
					'tipoArquivo'=> $topObj->getTipoArquivo(),
					'id'=> $topObj->getId(),
					'criadoPor'=> $topObj->getCriadoPor()];
				$i++;
			}
			$this->printTop4Topicos($j);
        }
        
        // print top4 topicos
		private function printTop4Topicos($j = []){
			for($i = 0; $i < count($j); $i++){
				$id = $j[$i]['id'];
				$titulo = $j[$i]['titulo'];
				$tipoArquivo = $j[$i]['tipoArquivo'];
				$arquivo = $j[$i]['arquivo'];
				$conteudo = $j[$i]['conteudo'];
				$numeroLikes = $j[$i]['numeroLikes'];
				if(strlen($titulo) > 16)
					$titulo = substr($titulo, 0, 13).'...';
				$usObj = new Usuario($j[$i]['criadoPor']);
				$nome = $usObj->getNome();
				$uNome = substr($nome, 0, 5);
				$nomeUn = $usObj->getNomeUnico();
				$uId = $usObj->getId();?>
                <input type='hidden' class='top4TopId' value='<?php echo $id;?>'>
				<div class='top4TopCompleto' id='top4TopCompleto<?php echo $id;?>'>
					<a href='topico.php?t=<?php echo $id;?>'>
						<div class='top4top'>
							<div class='titulo'>
								<h5><?php echo $titulo;?></h5>
							</div>
							<div class='conteudo'><?php 
								$this->tipUsCont->tipoConteudo($tipoArquivo, $arquivo, 'top', $id, $conteudo);?>
							</div>
						</div>
					</a>
					<div class='top4topicoRodape'>
						<a href='perfil.php?us=<?php echo $nomeUn;?>'><?php echo $uNome;?></a>
						<div class='likes'>
							<small><?php echo $numeroLikes;?></small>
							<img src='assets/imagens/icones/arrow-178-32.png'>
						</div>
					</div>
				</div><?php
			}
		}
    }
?>