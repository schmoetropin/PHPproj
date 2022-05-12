<?php
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
    class RedirecionarPagina extends Conexao {
        private $nomeU;

        public function __construct(){
            $this->nomeU = new CriarNomeUnico();
        }

        public function checarComAdmMod($comunidade){
            if($comunidade == '-50' && empty($_SESSION['logUsuario'])){
                header('Location: index.php');
                exit();
            }else if($comunidade == '-50' && isset($_SESSION['logUsuario'])){
                $logU = $this->nomeU->selecionarId($_SESSION['logUsuario'], 'usuario');
                $us = new Usuario($logU);
                $check = $us->getTipoUsuario();
                if($check < 2){
                    header('Location: index.php');
                    exit();
                }
	        }
        }

        public function checarTopAdmMod($topico){
            $top = new Topico($topico);
            $comunidade = $top->getNaComunidade();
            if($comunidade == '-50' && empty($_SESSION['logUsuario'])){
                header('Location: index.php');
                exit();
            }else if($comunidade == '-50' && isset($_SESSION['logUsuario'])){
                $logU = $this->nomeU->selecionarId($_SESSION['logUsuario'], 'usuario');
                $us = new Usuario($logU);
                $check = $us->getTipoUsuario();
                if($check < 2){
                    header('Location: index.php');
                    exit();
                }
	        }
        }

        public function redirecComNExistente($comunidade){
            $query = $this->con()->prepare("SELECT id FROM comunidade WHERE id='$comunidade'");
            $query->execute();
            if($query->rowCount() == 0){
                header('Location: index.php');
                exit();
            }
        }

        public function redirecTopNExistente($topico){
            $query = $this->con()->prepare("SELECT id FROM topico WHERE id='$topico'");
            $query->execute();
            if($query->rowCount() == 0){
                header('Location: index.php');
                exit();
            }
        }

        public function redirecUsNExistente($usuario){
<<<<<<< HEAD
            $query = $this->con()->prepare("SELECT id FROM usuario WHERE id='$usuario'");
=======
            $query = $this->con()->prepare("SELECT id FROM comunidade WHERE id='$usuario'");
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
            $query->execute();
            if($query->rowCount() == 0){
                header('Location: index.php');
                exit();
            }
        }

        public static function redirecionarComplementoEnderecoNaoExistente($endereco){
            $s = '&';
            if(strpos($endereco, $s) !== false){
                header('Location: index.php');
                exit();
            }
        }

        public static function redirecionarPesquisa($pesq){
            $pesquisa = strip_tags($pesq);
            if($pesquisa == NULL || str_replace(' ', '', $pesquisa) == ''){
                header('Location: index.php');
                exit();
            }
        }
    };
?>