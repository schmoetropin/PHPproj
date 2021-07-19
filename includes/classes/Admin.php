<?php
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
    class Admin extends Conexao {
        public function enviarConviteAdmin($admin, $usuario){
            $uObj = new Usuario($usuario);
            $checUs = $uObj->getTipoUsuario();
            if($checUs < 3){
                $query = $this->con()->prepare("INSERT INTO reqAdminUsuario(admin, usuario) VALUES('$admin', '$usuario')");
                $query->execute();
            }
        }
    };
?>