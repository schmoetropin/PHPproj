<?php
    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){
        echo '<h3>Acesso negado</h3><br><small>Voce nao pode acessar esta pagina</small>';
        exit();
    }
    class Restauracao {
        private $HOST = '127.0.0.1';
        private $LOGIN = 'root';
        private $SENHA = '';
        private $DBNAME = 'forumdb';
        private $con;

        public function __construct(){
            $this->con = new mysqli($this->HOST, $this->LOGIN, $this->SENHA, $this->DBNAME);
            if(mysqli_connect_errno())
                echo mysqli_connect_errno();
        }

        public function restaurarPadrao($dados){
            if($dados == '0'){
                $this->excluirUploads();
                $str = $this->excluirValoresMesasQuery();
                $str .= $this->resetarPrimaryKeyQuery();
                $str .= $this->inserirValoresPadraoQuery();
                $this->con->multi_query($str);
            }else if($dados == '1')
                $this->copiarArquivos();
        }

        private function excluirUploads(){
            $comunidade = '../../uploads/fotoComunidade/*';
            $perfil = '../../uploads/fotoDePerfil/*';
            $fTopico = '../../uploads/fotoTopico/*';
            $vTopico = '../../uploads/videoTopico/*';

            foreach(glob($comunidade) as $arquivo){
                if($arquivo != '../../uploads/fotoComunidade/index.php')
                    unlink($arquivo);
            }
            foreach(glob($perfil) as $arquivo){
                if($arquivo != '../../uploads/fotoDePerfil/index.php')
                    unlink($arquivo);
            }
            foreach(glob($fTopico) as $arquivo){
                if($arquivo != '../../uploads/fotoTopico/index.php')
                    unlink($arquivo);
            }
            foreach(glob($vTopico) as $arquivo){
                if($arquivo != '../../uploads/videoTopico/index.php')
                    unlink($arquivo);
            }
        }

        private function copiarArquivos(){
            $comunidadeRestArq = 'arquivos/comunidade/';
            $comunidadeUpload = '../../uploads/fotoComunidade/';
            $arquivos = glob('arquivos/comunidade/*.*');
            foreach($arquivos as $arq){
                $localCopia = str_replace($comunidadeRestArq, $comunidadeUpload, $arq);
                copy($arq, $localCopia);
            }

            $topicoRestArq = 'arquivos/topico/imagem/';
            $topicoUpload = '../../uploads/fotoTopico/';
            $arquivos = glob('arquivos/topico/imagem/*.*');
            foreach($arquivos as $arq){
                $localCopia = str_replace($topicoRestArq, $topicoUpload, $arq);
                copy($arq, $localCopia);
            }

            $topicoRestArq = 'arquivos/topico/video/';
            $topicoUpload = '../../uploads/videoTopico/';
            $arquivos = glob('arquivos/topico/video/*.*');
            foreach($arquivos as $arq){
                $localCopia = str_replace($topicoRestArq, $topicoUpload, $arq);
                copy($arq, $localCopia);
            }

            $fPerfilRestArq = 'arquivos/fotoPerfil/';
            $fPerfilUpload = '../../uploads/fotoDePerfil/';
            $arquivos = glob('arquivos/fotoPerfil/*.*');
            foreach($arquivos as $arq){
                $localCopia = str_replace($fPerfilRestArq, $fPerfilUpload, $arq);
                copy($arq, $localCopia);
            }
        }

        private function excluirValoresMesasQuery(){
            $str =
           "DELETE FROM botaoLike;
            DELETE FROM post;
            DELETE FROM topico;
            DELETE FROM inscricao;
            DELETE FROM reqModeradorUsuario;
            DELETE FROM comunidadeModerador;
            DELETE FROM comunidade;
            DELETE FROM post;
            DELETE FROM amigos;
            DELETE FROM reqAmizade;
            DELETE FROM mensagem;
            DELETE FROM usuario;";
            return $str;
        }

        private function resetarPrimaryKeyQuery(){
            $str =
           "ALTER TABLE botaoLike AUTO_INCREMENT=1;
            ALTER TABLE post AUTO_INCREMENT=1;
            ALTER TABLE topico AUTO_INCREMENT=1;
            ALTER TABLE inscricao AUTO_INCREMENT=1;
            ALTER TABLE reqModeradorUsuario AUTO_INCREMENT=1;
            ALTER TABLE comunidadeModerador AUTO_INCREMENT=1;
            ALTER TABLE comunidade AUTO_INCREMENT=1;
            ALTER TABLE post AUTO_INCREMENT=1;
            ALTER TABLE amigos AUTO_INCREMENT=1;
            ALTER TABLE reqAmizade AUTO_INCREMENT=1;
            ALTER TABLE mensagem AUTO_INCREMENT=1;
            ALTER TABLE usuario AUTO_INCREMENT=1;";
            return $str;
        }

        private function inserirValoresPadraoQuery(){
            $usuario = "INSERT INTO `usuario`(`id`, `nome`, `email`, `senha`, `dataRegistro`, `fotoPerfil`, `tipoUsuario`, `nomeUnico`) VALUES ";
            $comunidade = "INSERT INTO `comunidade`(`id`, `nome`, `descricao`, `fotoComunidade`, `nomeUnico`) VALUES ";
            $str = 
           "$usuario ('1', 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', '2020-03-18' , 'assets/imagens/icones/fotoPerfilPadrao.png', '3', 'admin');
            $comunidade ('-50', 'admin e moderacao', 'comunidade destinada para discussao de ideias ou problemas sobre o forum', 'assets/imagens/icones/adminComunidade.jpg', 'admin_e_moderacao');
            INSERT INTO `inscricao`(`usuario`, `comunidade`) VALUES('1', '-50');";
            $str .= "$usuario ('2', 'restaurar', 'schmoetropin@schmoetropin.com', 'bc95346a88a94cd04167df629c5c0acd', '2020-03-18' , 'assets/imagens/icones/fotoPerfilPadrao.png', '4', 'restaurar');";
            return $str;
        }
    }
?>
