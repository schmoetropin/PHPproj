<?php
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
    class Moderador extends Conexao {

        public function checarModerador($usuario, $comunidade){
			$query = $this->con()->prepare("SELECT * FROM comunidadeModerador WHERE moderador='$usuario' AND comunidade='$comunidade'");
			$query->execute();
			if($query->rowCount() > 0)
				return true;
			else
				return false;
        }
        
        // atualiza usuario para moderador
        public function atualizarModUsuario($usuario, $comunidade){
            $usObj = new Usuario($usuario);
			$tipoUsuario = $usObj->getTipoUsuario();
			$query = $this->con()->prepare("INSERT INTO comunidadeModerador(moderador, comunidade) VALUES($usuario, $comunidade)");
			$query->execute();
			if($tipoUsuario < 2)
				$usObj->setTipoUsuario(2);
        }

        // remove convite para ser moderador
        public function excluirModReqUsuario($usuario, $comunidade){
            $query = $this->con()->prepare("DELETE FROM reqModeradorUsuario WHERE usuario='$usuario' AND comunidade='$comunidade'");
            $query->execute();
        }

        // checa se usuario recebeu algum convite para ser moderador
        public function checarModRequerimentos($usuario, $comunidade){
            $query = $this->con()->prepare("SELECT * FROM reqModeradorUsuario WHERE usuario='$usuario' AND comunidade='$comunidade'");
            $query->execute();
            if($query->rowCount() > 0)
                return true;
            else
                return false;
        }

        // envia convite para usuario se tornar moderador
        public function enviarModRequerimento($moderador, $usuario, $comunidade){
            $query = $this->con()->prepare("INSERT INTO reqModeradorUsuario(moderador, usuario, comunidade) VALUES('$moderador', '$usuario', '$comunidade')");
            $query->execute();
        }
        
        // exibe todas os convites de moderacao enviados por determinado moderador
        public function exibirTodosModRequisicaoEnviada($moderador){
            $query = $this->con()->prepare("SELECT * FROM reqModeradorUsuario WHERE moderador='$moderador'");
            $query->execute();
            $j = []; $i = 0;
            if($query->rowCount() > 0){?>
                <small style="margin: 0 0 0 3%;">Convites para moderacao:</small><?php
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $j[$i] = [
                        'id'=> $row['id'],
                        'usuario'=> $row['usuario'],
<<<<<<< HEAD
                        'comunidade'=> $row['comunidade'],
                        'moderador'=> $row['moderador']
                    ];
=======
                        'comunidade'=> $row['comunidade']];
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
                    $i++;
                }
                $this->exibirRequisicaoModeradorEnviada($j);?>
                <hr class="hrPadrao"><?php
            }
            
        }

        // exibe convite de moderacao de determinado moderador para determinado usuario
        public function exibirModRequisicaoEnviadaUsuario($moderador, $usuario){
            $query = $this->con()->prepare("SELECT * FROM reqModeradorUsuario WHERE moderador='$moderador' AND usuario='$usuario'");
            $query->execute();
            $j = []; $i = 0;
            if($query->rowCount() > 0){
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $j[$i] = [
                        'id'=> $row['id'],
                        'moderador'=> $row['moderador'],
                        'usuario'=> $row['usuario'],
                        'comunidade'=> $row['comunidade']];
                    $i++;
                }
            }
            $this->exibirRequisicaoModeradorEnviada($j);
        }

        private function exibirRequisicaoModeradorEnviada($row = []){
            for($i = 0; $i < count($row); $i++){
                $id = $row[$i]['id'];
                $mObj = new Usuario($row[$i]['moderador']);
                $mNUnico = $mObj->getNomeUnico();
                $usObj = new Usuario($row[$i]['usuario']);
                $nomeU = $usObj->getNomeUnico();
                $nome = substr($usObj->getNome(), 0, 15);
                $foto = $usObj->getFotoDePerfil();
                $coObj = new Comunidade($row[$i]['comunidade']);
                $nomeCom = substr($coObj->getNome(), 0, 15);
                $comNomeUnico = $coObj->getNomeUnico();
                $formId = $mNUnico.'**'.$nomeU.'**'.$comNomeUnico; ?>
                <div class='modReqEnviada'>
                    <input type='hidden' class='reqModEnviadoId' value='<?php echo $formId;?>'>
                    <form id='carcelarReqModForm<?php echo $formId;?>' method='POST' onsubmit='return false'>
                        <input type='hidden' name='cancelarReqMod' value='<?php echo $formId;?>'>
                        <button id='cancelarReqMod<?php echo $formId;?>' class='btnInvisivel'><img src='assets/imagens/icones/close.png' class='cancelarReqMod'></button>
                    </form>
                    <h5><?php echo $nomeCom;?></h5>
                    <a href='perfil.php?us=<?php echo $nomeU;?>'>
                        <div><img src='<?php echo $foto;?>'></div>
                        <h4><?php echo $nome;?></h4>
                    </a>
                    <button class='btn btnVerde'>requisicao moderador enviada</button>
                </div><?php
            }
        }

        // Cancela requisicao enviada a determinado usuario
        public function cancelarReqMod($formId){
            list($mod, $usuario, $comunidade) = explode('**',$formId);
            $modQuery = $this->con()->prepare("SELECT id FROM usuario WHERE nomeUnico='$mod'");
            $modQuery->execute();
            $modRow = $modQuery->fetch(PDO::FETCH_ASSOC);
            $modId = $modRow['id'];
            $usuarioQuery = $this->con()->prepare("SELECT id FROM usuario WHERE nomeUnico='$usuario'");
            $usuarioQuery->execute();
            $usuarioRow = $usuarioQuery->fetch(PDO::FETCH_ASSOC);
            $usuarioId = $usuarioRow['id'];
            $comunidadeQuery = $this->con()->prepare("SELECT id FROM comunidade WHERE nomeUnico='$comunidade'");
            $comunidadeQuery->execute();
            $comunidadeRow = $comunidadeQuery->fetch(PDO::FETCH_ASSOC);
            $comunidadeId = $comunidadeRow['id'];
            $query = $this->con()->prepare("SELECT id FROM reqModeradorUsuario WHERE moderador='$modId' AND usuario='$usuarioId' AND comunidade='$comunidadeId'");
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $query = $this->con()->prepare("DELETE FROM reqModeradorUsuario WHERE id='$id'");
            $query->execute();
        }

        // exibe todos moderadores de determinada comunidade
        public function exibirModeradores($com, $top){
            if(isset($com))                
                $query = $this->con()->prepare("SELECT * FROM comunidadeModerador WHERE comunidade='$com'");
            else if(isset($top)){
                $topObj = new Topico($top);
                $comunidade = $topObj->getNaComunidade();
                $query = $this->con()->prepare("SELECT * FROM comunidadeModerador WHERE comunidade='$comunidade'");
            }
			$query->execute();?>
			<div id='comunidadeModerador'><?php
			if($query->rowCount() > 0){?>
				<ul><?php
				while($row = $query->fetch(PDO::FETCH_ASSOC)){
					$moderador = new Usuario($row['moderador']);
					$nomeU = $moderador->getNomeUnico();
					$nome = substr($moderador->getNome(), 0, 15);?>
					<li><a href='perfil.php?us=<?php echo $nomeU;?>'><?php echo $nome;?></a></li><?php
				}?>
				</ul><?php
			}?>
			</div><?php
        }
        
        // renuncia cargo moderador ou administrador remove moderador
        public function renunciarCargModerador($id){
            list($mod, $com) = explode('**', $id);
            $nuO = new CriarNomeUnico();
            $modId = $nuO->selecionarId($mod, 'usuario');
            $comId = $nuO->selecionarId($com, 'comunidade');
            if($modId && $comId){
                $usObj = new Usuario($modId);
                $coObj = new Comunidade($comId);
                $comunidadeNome = $coObj->getNome();
                if(isset($_SESSION['logUsuario'])){
                    $logU = $nuO->selecionarId($_SESSION['logUsuario'], 'usuario');
                    $uObj = new Usuario($logU);
                    $checUs = $uObj->getTipoUsuario();
                    if($modId == $logU && $checUs != 3){
                        $query = $this->con()->prepare("SELECT moderador FROM comunidadeModerador WHERE comunidade='$comId'");
                        $query->execute();
                        if($query->rowCount() > 1){
                            $query = $this->con()->prepare("SELECT comunidade FROM comunidadeModerador WHERE moderador='$modId'");
                            $query->execute();
                            if($query->rowCount() == 1)
                                $usObj->setTipoUsuario('1');
                            $query = $this->con()->prepare("SELECT id FROM comunidadeModerador WHERE moderador='$modId' AND comunidade='$comId'");
                            $query->execute();
                            $row = $query->fetch(PDO::FETCH_ASSOC);
                            $id = $row['id'];
                            $query = $this->con()->prepare("DELETE FROM comunidadeModerador WHERE id='$id'");
                            $query->execute();
                            return "<small class='mensagemSucesso'>Voce saiu do grupo de moderacao da comunidade $comunidadeNome</small>";
                        }else
                            return '*Voce e o unico moderador da comunidade '.$comunidadeNome.'.';
                    }else if($checUs == 3){
                        $query = $this->con()->prepare("SELECT comunidade FROM comunidadeModerador WHERE moderador='$modId'");
                        $query->execute();
                        if($query->rowCount() == 1)
                            $usObj->setTipoUsuario('1');
                        $query = $this->con()->prepare("SELECT id FROM comunidadeModerador WHERE moderador='$modId' AND comunidade='$comId'");
                        $query->execute();
                        $row = $query->fetch(PDO::FETCH_ASSOC);
                        $id = $row['id'];
                        $query = $this->con()->prepare("DELETE FROM comunidadeModerador WHERE id='$id'");
                        $query->execute();
                        return "<small class='mensagemSucesso'>Moderador retirado da comunidade $comunidadeNome</small>";
                    }else
                        return '*Erro';
                }
                return '*Erro';
            }
            return '*Erro';
        }

        public function removerModerador($moderador, $id){
            $usObj = new Usuario($moderador);
            $query = $this->con()->prepare("SELECT comunidade FROM comunidadeModerador WHERE moderador='$moderador'");
            $query->execute();
            if($query->rowCount() == 1)
                $usObj->setTipoUsuario('1');
            $query = $this->con()->prepare("DELETE FROM comunidadeModerador WHERE id='$id'");
            $query->execute();
        }
    };
?>