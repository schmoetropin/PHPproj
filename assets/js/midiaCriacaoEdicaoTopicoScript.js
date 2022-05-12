$(document).ready(function(){
    function tipoMidiaTopico(){
        if(_q('.uploadArquivoForm')){
            _q('.uploadArquivoForm').addEventListener('click', function(){
                _('topicoUpload').style.display = 'block';
                _('topicoLink').style.display = 'none';
                _('topicoLink').value = '';
                _('tipoMidiaPrevisualizacao').value = 'nenhum';
            });

            _q('.linkImagemForm').addEventListener('click', function(){
                _('topicoUpload').style.display = 'none';
                _('topicoUpload').value = '';
                _('topicoLink').style.display = 'block';
                _('topicoLink').placeholder = 'Link imagem';
                _('topicoLink').value = '';
                _('tipoMidiaPrevisualizacao').value = 'linkImagem';
            });

            _q('.linkVideoForm').addEventListener('click', function(){
                _('topicoUpload').style.display = 'none';
                _('topicoUpload').value = '';
                _('topicoLink').style.display = 'block';
                _('topicoLink').placeholder = 'Link youtube (link completo)';
                _('topicoLink').value = '';
                _('tipoMidiaPrevisualizacao').value = 'linkVideo';
            });

            _q('.semMidiaForm').addEventListener('click', function(){
                _('topicoUpload').style.display = 'none';
                _('topicoUpload').value = '';
                _('topicoLink').style.display = 'none';
                _('topicoLink').value = '';
                _('tipoMidiaPrevisualizacao').value = 'nenhum';
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
});