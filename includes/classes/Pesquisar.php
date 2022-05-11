<?php
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
    class Pesquisar extends Conexao {
        private $comObj;
        private $topObj;
        public function __construct(){
            $this->comObj = new ExibirComunidade();
            $this->topObj = new ExibirTopico();
        }
        public function exibirResultadoComunidades($term){
            $query = $this->con()->prepare("SELECT * FROM comunidade WHERE id<>-50 AND (nome LIKE '%$term%' OR descricao LIKE '%$term%')");
            $query->execute();
            $i = 0; $j = [];
            if($query->rowCount() > 0){
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $j[$i] = [
                        'id'=> $row['id'],
                        'nome'=> $row['nome'],
                        'descricao'=> $row['descricao'],
                        'criadoPor'=> $row['criadoPor'],
                        'dataCriacao'=> $row['dataCriacao'],
                        'numeroPosts'=> $row['numeroPosts'],
                        'numeroTopicos'=> $row['numeroTopicos'],
                        'numeroInscritos'=> $row['numeroInscritos'],
                        'fotoComunidade'=> $row['fotoComunidade'],
                        'link'=> 'comunidade.php?c='.$row['nomeUnico'],
                        'nomeUnico'=> $row['nomeUnico']];
                    $i++;
                }
                return $this->comObj->printComunidade($j, NULL);
            }
        }
       
        public function exibirResultadoTopicos($term, $comun){
            $query = $this->con()->prepare("SELECT * FROM topico WHERE titulo LIKE '%$term%' AND naComunidade='$comun'");
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
                        'comunidade'=> $comun];
                    $i++;
                }
                return $this->topObj->printTopico($j, NULL);
            }
        }
    };
?>