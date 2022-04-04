<?php
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
    abstract class Conexao {
        private $DBNAME = 'forumdb';
        private $HOST = '127.0.0.1';
        private $LOGIN = 'root';
        private $SENHA = '';
        
        protected function con(){
            try{
                $con = new PDO("mysql:dbname=$this->DBNAME;host=$this->HOST", $this->LOGIN, $this->SENHA);
                return $con;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }
    }
?>
