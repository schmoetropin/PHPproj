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
<<<<<<< HEAD
        private $con;

        protected function con(){
            try{
                $this->con = new PDO("mysql:dbname=$this->DBNAME;host=$this->HOST", $this->LOGIN, $this->SENHA);
                return $this->con;
=======
        
        protected function con(){
            try{
                $con = new PDO("mysql:dbname=$this->DBNAME;host=$this->HOST", $this->LOGIN, $this->SENHA);
                return $con;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }
    }
<<<<<<< HEAD
?>
=======
?>
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
