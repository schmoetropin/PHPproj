<?php
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
    class CriarNomeUnico extends Conexao {
        public function criar($nome, $mesa){
            $arr = [' ', '"', "'", ';', ':', '?', '!', '$', '&', '%', '#', '@', '+', '=', '-', '\\', '/', '.', '*', '¨', '^', '~', '(', ')', '[', ']', '{', '}', ','];
            $nomeU = str_replace($arr, '', $nome);
            $nomeU = strtolower($nomeU);
            $nomeU = strip_tags($nomeU);
            $nomeUnico = $nomeU;
            if($mesa != 'topico'){
                $query = $this->con()->prepare("SELECT nomeUnico FROM $mesa WHERE nomeUnico='$nomeUnico'");
                $query->execute();
                $i = 0;
                while($query->rowCount() > 0){
                    $nomeUnico = $nomeU.$i;
                    $query = $this->con()->prepare("SELECT nomeUnico FROM $mesa WHERE nomeUnico='$nomeUnico'");
                    $query->execute();
                    $i++;
                }
            }
            return $nomeUnico;
        }

        public function selecionarId($nomeU, $mesa){
            $query = $this->con()->prepare("SELECT id FROM $mesa WHERE nomeUnico='$nomeU'");
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['id'];
        }
    };
?>