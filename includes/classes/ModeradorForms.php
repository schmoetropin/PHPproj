<?php
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){?>
		<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small><?php
		exit();
	}
    class ModeradorForms extends Conexao {
        private $nomeU;

        public function __construct(){
            $this->nomeU = new CriarNomeUnico();
        }

        // formulario de convite para moderacao
        public function requisicaoModerador($moderador, $usuario){
            $moderadorId = $this->nomeU->selecionarId($moderador, 'usuario');
            $usuarioId = $this->nomeU->selecionarId($usuario, 'usuario');
            $u = new Usuario($usuarioId);
            $tipo = $u->getTipoUsuario();
            $arrayComunidades = [];
            if($tipo == 1)
                $arrayComunidades = $this->arrayComunidadesUsuario($moderadorId, $usuarioId);
            else if($tipo == 2)
                $arrayComunidades = $this->arrayComunidadesModerador($moderadorId, $usuarioId);?>
            <div id='adicionarModeradorCaixa'>
                convidar usuario para cargo moderador
                <form id='adicionarModeradorForm' method='POST' onsubmit='return false'>
                    <input type='hidden' id='moderador' name='moderador' value='<?php echo $moderador;?>'>
                    <input type='hidden' id='usuario' name='usuario' value='<?php echo $usuario;?>'>
                    Escolha a comunidade: <select id='comunidade' name='comunidade'><?php
                    for($i = 0; $i < count($arrayComunidades); $i++){
                        $coObj = new Comunidade($arrayComunidades[$i]);
                        $nomeU = $coObj->getNomeUnico();
                        $nome = $coObj->getNome();?>
                        <option value='<?php echo $nomeU;?>'><?php echo $nome;?></option><?php
                    }?>
                    </select>
                    <input type='submit' id='enviarAdicionarModerador' value='enviar' class='btn btnVerde'>
                </form>
            </div><?php
        }

        // exibir formularios recebidos para moderacao
        public function exibirModRequisicaoRecebida($usuario){
            $usuarioId = $this->nomeU->selecionarId($usuario, 'usuario');
            $query = $this->con()->prepare("SELECT * FROM reqModeradorUsuario WHERE usuario='$usuarioId'");
            $query->execute();
            if($query->rowCount() > 0){
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $reqId = $row['id'];
                    $usObj = new Usuario($row['moderador']);
                    $uNomeU = $usObj->getNomeUnico();
                    $nome = substr($usObj->getNome(), 0, 15);
                    $tipo = $usObj->getTipoUsuario();
                    
                    $coObj = new Comunidade($row['comunidade']);
                    $coNome = $coObj->getNome();
                    $coFoto = $coObj->getFotoComunidade();
                    $cNomeU = $coObj->getNomeUnico();

                    $formId = $uNomeU.'**'.$usuario.'**'.$cNomeU;
                    if($tipo == 2)
                        $mod = "moderador <a href='perfil.php?us=$uNomeU'><p style='display: inline;'>$nome</p></a>";
                    else if($tipo == 3)
                        $mod = "administrador <a href='perfil.php?us=$uNomeU'><p style='display: inline; color: #c62828;'>$nome</p></a>";?>
                    <input type='hidden' class='requisicaoId' value='<?php echo $formId;?>'>
                    <div id='modReqRecebida<?php echo $formId;?>' class='modReqRecebida'>
                        <div class='recComunidade'>
                            <a href='comunidade.php?c=<?php echo $cNomeU;?>'>
                                <div><img src='<?php echo $coFoto;?>'></div>
                                <h4><?php echo $coNome;?></h4>
                            </a>
                        </div>
                        <div class='recConteudo'>
                            O <?php echo $mod;?> te convidou para fazer parte do grupo de moderacao da comunidade <a href='comunidade.php?c=<?php echo $cNomeU;?>' style='color: #222; font-weight: bold;'><?php echo $coNome;?></a>
                        </div>
                        <div class='recForm'>
                            <form id='aceitarModRequisicaoForm<?php echo $formId;?>' onsubmit='return false'>
                                <input type='hidden' name='usuario' value='<?php echo $usuario;?>'>
                                <input type='hidden' name='comunidade' value='<?php echo $cNomeU;?>'>
                                <input type='hidden' name='acetRec' value='aceitar'>
                                <input type='submit' id='aceitarModRequisicao<?php echo $formId;?>' class='btn btnVerde aceitarModRequisicao' value='aceitar'>
                            </form>
                            <form id='recusarModRequisicaoForm<?php echo $formId;?>' onsubmit='return false'>
                                <input type='hidden' name='usuario' value='<?php echo $usuario;?>'>
                                <input type='hidden' name='comunidade' value='<?php echo $cNomeU;?>'>
                                <input type='hidden' name='acetRec' value='recusar'>
                                <input type='submit' id='recusarModRequisicao<?php echo $formId;?>' class='btn btnVermelho recusarModRequisicao' value='recusar'>
                            </form>
                        </div>
                    </div><?php
                }
            }
        }

        // exibir comunidades de determinado moderador
        public function exibirComunidadesModerador($usuario){
			$query = $this->con()->prepare("SELECT * FROM comunidadeModerador WHERE moderador='$usuario'");
			$query->execute();?>
			<ul><?php
			while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $cmId = $row['id'];
                $modO = new Usuario($usuario);
                $modNomeUnico = $modO->getNomeUnico();
				$coObj = new Comunidade($row['comunidade']);
				$nome = substr($coObj->getNome(), 0, 20);
                $nomU = $coObj->getNomeUnico();
                $id = $coObj->getId();
                $foto = $coObj->getFotoComunidade();
                $modComuNU = $modNomeUnico.'**'.$nomU;?>
                <li>
                    <input type='hidden' class='comunidadeModeradorNU' value='<?php echo $modComuNU;?>'>
                    <a href='comunidade.php?c=<?php echo $nomU;?>'>
                        <div id='comunImagem'><img src='<?php echo $foto;?>'></div>
                        <h4><?php echo $nome;?></h4>
                    </a><?php
                    if(isset($_SESSION['logUsuario'])){
                        $nomeU = new CriarNomeUnico();
                        $logU = $nomeU->selecionarId($_SESSION['logUsuario'], 'usuario'); 
                        $uObj = new Usuario($logU);
                        $checUs = $uObj->getTipoUsuario();
                        if($logU == $usuario){?>
                            <div id='sairModComun'><?php 
                                $this->exibirRenunciarCargModeradorForm($modComuNU, 'sair');?>
                            </div>
                            <div id='sairModComunidadeMens<?php echo $modComuNU;?>'></div><?php
                        }else if($checUs == 3){?>
                            <div id='sairModComun'><?php 
                                $this->exibirRenunciarCargModeradorForm($modComuNU, 'retirar');?>
                            </div>
                            <div id='sairModComunidadeMens<?php echo $modComuNU;?>'></div><?php
                        }
                    }?>
                </li><?php
			}?>
			</ul><?php
        }
       
        // exibe formulario renuncia de cargo moderador 
        private function exibirRenunciarCargModeradorForm($modComunNU, $botaoNome){?>
            <input type='hidden' class='comunModeradorMesClass' value='<?php echo $modComunNU;?>'>
            <form id='recusarCargModeradorForm<?php echo $modComunNU;?>' onsubmit='return false'>
                <input type='hidden' name='comunModeradorId' value='<?php echo $modComunNU;?>'>
                <input type='submit' id='recusarCargModeradorBotao<?php echo $modComunNU;?>' class='btn btnVermelho' value='<?php echo $botaoNome;?>'>
            </form><?php
        }

        private function arrayComunidadesUsuario($moderador, $usuario){
            $u = new Usuario($moderador);
            $tipo = $u->getTipoUsuario();
            $arr1 = [];
            $arr2 = [];
            $arrCom = [];
            $reqQuery = $this->con()->prepare("SELECT comunidade FROM reqModeradorUsuario WHERE usuario='$usuario'");
            $reqQuery->execute();
            while($row = $reqQuery->fetch(PDO::FETCH_ASSOC)){
                array_push($arr2, $row['comunidade']);
            }
            if($tipo == 2){
                $query = $this->con()->prepare("SELECT comunidade FROM comunidadeModerador WHERE moderador='$moderador'");
                $query->execute();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    array_push($arr1, $row['comunidade']);
                }
            }else if($tipo == 3){
                $query = $this->con()->prepare("SELECT id FROM comunidade WHERE id<>'-50'");
                $query->execute();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    array_push($arr1, $row['id']);
                }
            }
            $arrCom = array_values(array_diff($arr1, $arr2));
            return $arrCom;
        }

        private function arrayComunidadesModerador($moderador, $mod){
            $u = new Usuario($moderador);
            $tipo = $u->getTipoUsuario();
            $arr1 = [];
            $arr2 = [];
            $arrCom = [];
            $reqQuery = $this->con()->prepare("SELECT comunidade FROM reqModeradorUsuario WHERE usuario='$mod'");
            $reqQuery->execute();
            while($row = $reqQuery->fetch(PDO::FETCH_ASSOC)){
                array_push($arr2, $row['comunidade']);
            }
            if($tipo == 2){
                $queryM1 = $this->con()->prepare("SELECT comunidade FROM comunidadeModerador WHERE moderador='$moderador'");
                $queryM1->execute();
                $queryM2 = $this->con()->prepare("SELECT comunidade FROM comunidadeModerador WHERE moderador='$mod'");
                $queryM2->execute();
                $mod1 = [];
                $mod2 = [];
                while($row = $queryM1->fetch(PDO::FETCH_ASSOC)){
                    array_push($mod1, $row['comunidade']);
                }
                while($row = $queryM2->fetch(PDO::FETCH_ASSOC)){
                    array_push($mod2, $row['comunidade']);
                }
                $arr1 = array_values(array_diff($mod1, $mod2));
            }else if($tipo == 3){
                $query = $this->con()->prepare("SELECT id FROM comunidade WHERE id<>'-50'");
                $query->execute();
                $queryM2 = $this->con()->prepare("SELECT comunidade FROM comunidadeModerador WHERE moderador='$mod'");
                $queryM2->execute();
                $mod1 = [];
                $mod2 = [];
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    array_push($mod1, $row['id']);
                }
                while($row = $queryM2->fetch(PDO::FETCH_ASSOC)){
                    array_push($mod2, $row['comunidade']);
                }
                $arr1 = array_values(array_diff($mod1, $mod2));
            }
            $arrCom = array_values(array_diff($arr1, $arr2));
            return $arrCom;
        }
    };
?>