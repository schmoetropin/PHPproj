$(document).ready(function(){
    function tipoMidiaTopico(){
        if(_q('.uploadArquivoForm')){
            _q('.uploadArquivoForm').addEventListener('click', function(){
                _('topicoUpload').style.display = 'block';
                _('topicoLink').style.display = 'none';
                _('topicoLink').value = '';
                _('tipoMidiaPrevisualizacao').value = 'nenhum';
<<<<<<< HEAD
=======
                _q('.previsualizacaoMidia').innerHTML = '';
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
            });

            _q('.linkImagemForm').addEventListener('click', function(){
                _('topicoUpload').style.display = 'none';
                _('topicoUpload').value = '';
                _('topicoLink').style.display = 'block';
                _('topicoLink').placeholder = 'Link imagem';
                _('topicoLink').value = '';
                _('tipoMidiaPrevisualizacao').value = 'linkImagem';
<<<<<<< HEAD
=======
                _q('.previsualizacaoMidia').innerHTML = '';
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
            });

            _q('.linkVideoForm').addEventListener('click', function(){
                _('topicoUpload').style.display = 'none';
                _('topicoUpload').value = '';
                _('topicoLink').style.display = 'block';
                _('topicoLink').placeholder = 'Link youtube (link completo)';
                _('topicoLink').value = '';
                _('tipoMidiaPrevisualizacao').value = 'linkVideo';
<<<<<<< HEAD
=======
                _q('.previsualizacaoMidia').innerHTML = '';
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
            });

            _q('.semMidiaForm').addEventListener('click', function(){
                _('topicoUpload').style.display = 'none';
                _('topicoUpload').value = '';
                _('topicoLink').style.display = 'none';
                _('topicoLink').value = '';
                _('tipoMidiaPrevisualizacao').value = 'nenhum';
<<<<<<< HEAD
=======
                _q('.previsualizacaoMidia').innerHTML = '';
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
            });

            if(_q('.manterMidiaForm')){
                _q('.manterMidiaForm').addEventListener('click', function(){
                    _('topicoUpload').style.display = 'none';
                    _('topicoUpload').value = '';
                    _('topicoLink').style.display = 'none';
                    _('topicoLink').value = '';
                    _('tipoMidiaPrevisualizacao').value = 'nenhum';
                    _q('.previsualizacaoMidia').innerHTML = '';
                });
            }
        }
    }
    tipoMidiaTopico();

    // previsualizacao criacao edicao topico link e upload
<<<<<<< HEAD
    if(_('topicoUpload')){   
        const arquivo = _('topicoUpload');
        const prev = _q('.previsualizacaoMidia');
        arquivo.addEventListener('change', function(e){
            let extencao = e.target.files[0].type;
            let prevMidia = null;
            if(extencao === 'video/mp4'){
                prev.innerHTML = "<video id='prevMidiaVid' conrols autoplay muted></video>";
                prevMidia = _('prevMidiaVid');
            }else if(extencao === 'image/jpg' || extencao === 'image/jpeg' || extencao === 'image/png' || extencao === 'image/gif'){
                prev.innerHTML = "<img id='prevMidiaImg' />";
                prevMidia = _('prevMidiaImg');
            }else{
                prev.innerHTML = "<p class='mensagemErro'>*Extencao não suportada</p>";
                prevMidia = null;
            }
            prevMidia.src = URL.createObjectURL(e.target.files[0]);
            prevMidia.onload = function(){
                URL.revokeObjectURL(prevMidia.src);
            }
        });

        $('#topicoLink').on('change paste keyup', function(){
            let _this = this;
            setTimeout(function(){
                let midia = $(_this).val();
                if($('#tipoMidiaPrevisualizacao').val() === 'linkImagem')
                    $('.previsualizacaoMidia').html("<img src='"+midia+"' class='preVisMidEditTop'>");
                else if($('#tipoMidiaPrevisualizacao').val() === 'linkVideo'){
                    let subMidia = midia.substring(32, 43);
                    $('.previsualizacaoMidia').html("<iframe width='700' height='400' src='https://www.youtube.com/embed/"+subMidia+"' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>");
                }
            }, 100);
        });
    }
=======
    function prevUploadLinkTopico(){
        if(_('topicoUpload')){    
            $('#topicoUpload').change(function(){;
                if(this.files && this.files[0]){
                    var arquivo = this.files[0];
                    var extencao = arquivo.type.substring(6);
                    var exibirArquivo = new FileReader();
                    if(extencao === 'mp4')
                        $('.previsualizacaoMidia').html("<video id='preVisMidCricTop' controls autoplay muted></video>");
                    else if(extencao === 'jpg' || extencao === 'jpeg' || extencao === 'png' || extencao === 'gif')
                        $('.previsualizacaoMidia').html("<img src='' id='preVisMidCricTop'>");
                    else
                        $('.previsualizacaoMidia').html("<strong class='mensagemErro'>*Erro midia</strong>");
                    exibirArquivo.onload = function(e){
                        $('#preVisMidCricTop').attr('src', e.target.result);
                    }
                    exibirArquivo.readAsDataURL(arquivo);
                }
            });
    
            $('#topicoLink').on('change paste keyup', function(){
                var _this = this;
                setTimeout(function(){
                    var midia = $(_this).val();
                    if($('#tipoMidiaPrevisualizacao').val() === 'linkImagem')
                        $('.previsualizacaoMidia').html("<img src='"+midia+"' class='preVisMidEditTop'>");
                    else if($('#tipoMidiaPrevisualizacao').val() === 'linkVideo'){
                        var subMidia = midia.substring(32, 43);
                        $('.previsualizacaoMidia').html("<iframe width='700' height='400' src='https://www.youtube.com/embed/"+subMidia+"' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>");
                    }
                }, 100);
            });
        }
    }
    prevUploadLinkTopico();
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
});