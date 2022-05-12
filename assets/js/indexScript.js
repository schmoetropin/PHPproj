$(document).ready(function(){
	const comuH = 'includes/handlers/comunidadeHandler.php';
	const pesH = 'includes/handlers/pesquisaHandler.php';
	function exibirComunidades(){
<<<<<<< HEAD
		let comunidades = 'sim';
=======
		var comunidades = 'sim';
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
		$.ajax({
			type: 'POST',
			url: comuH,
			data: {comunidades: comunidades},
			cache: false,
			success: function(data){
				$('#indexColunaPrincipal').html(data);
				excluirComunidade();
			}
		});
	}
<<<<<<< HEAD
	
	function exibirTop4Topicos(){
		let top4TopicoIndex = 'sim';
=======
	exibirComunidades();
	
	function exibirTop4Topicos(){
		var top4TopicoIndex = 'sim';
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
		$.ajax({
			type: 'POST',
			url: comuH,
			data: {top4TopicoIndex: top4TopicoIndex},
			cache: false,
			success: function(data){
				$('.top4TopicosIndex').html(data);
<<<<<<< HEAD
			}
		});
	}

	function playVideoMouseoverTop4Topico(){
		if(_q('.top4TopId')){
			_a('.top4TopId').forEach(function(valores){
				let id = valores.value;
				_('top4TopCompleto'+id).addEventListener('mouseover', function(){
					if(_('top4TopVideo'+id))
						_('top4TopVideo'+id).play();
				});
				_('top4TopCompleto'+id).addEventListener('mouseleave', function(){
					if(_('top4TopVideo'+id))
						_('top4TopVideo'+id).pause();
				});
			});
		}
	}
	playVideoMouseoverTop4Topico();
=======
				playVideoMouseoverTop4Topico();
			}
		});
	}
	exibirTop4Topicos();

	function playVideoMouseoverTop4Topico(){
		_a('.top4TopId').forEach(function(valores){
			var id = valores.value;
			_('top4TopCompleto'+id).addEventListener('mouseover', function(){
				if(_('top4TopVideo'+id))
					_('top4TopVideo'+id).play();
			});
			_('top4TopCompleto'+id).addEventListener('mouseleave', function(){
				if(_('top4TopVideo'+id))
					_('top4TopVideo'+id).pause();
			});
		});
	}
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36

	// exibe criacao de comunidade
	if(_('botaoCriarComunidade')){
		_('botaoCriarComunidade').addEventListener('click', function(){
			_q('.fundoOpacoPadrao').style.display = 'block';
			_('caixaCriarCominidade').style.display = 'block';
			_q('body').style.overflow = 'hidden';
		});
	}

	// fecha criacao de comunidade
	if(_('fecharCaixaCriarCominidade')){
		_('fecharCaixaCriarCominidade').addEventListener('click', function(){
			_q('.fundoOpacoPadrao').style.display = 'none';
			_('caixaCriarCominidade').style.display = 'none';
			_q('body').style.overflow = 'auto';
		});
	}

	//previsualizacao imagem comunidade
<<<<<<< HEAD
	if(_('fotoCriacaoComunidade')){
		_('fotoCriacaoComunidade').addEventListener('change', function(e){
			let ext = e.target.files[0].type;
			if(ext === 'image/jpg' || ext === 'image/jpeg' || ext === 'image/png' || ext === 'image/gif')
				_q('.previsualisacaoImgCom').innerHTML = "<img id='prevImagCom' />";
			_('prevImagCom').src = URL.createObjectURL(e.target.files[0]);
			_('prevImagCom').onload = function(){
				URL.revokeObjectURL(_('prevImagCom').src);
			}
		});
	}
=======
	function previsualizarImagemCom(){
		$('#fotoCriacaoComunidade').change(function(){
			if(this.files && this.files[0]){	
				var imagem = this.files[0];
				var exibirArq = new FileReader();
				exibirArq.onload = function(e){
					$('#pevImagCom').attr('src', e.target.result);
				}
				exibirArq.readAsDataURL(imagem);
			}
		})
	}
	previsualizarImagemCom();
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36

	// criar comunidade
	if(_('inputCriarComunidade')){
		_('inputCriarComunidade').addEventListener('click', function(){
<<<<<<< HEAD
			let form = _('criarComunidadeForm');
			let fd = new FormData(form);
			let arquivo;
=======
			var form = _('criarComunidadeForm');
			var fd = new FormData(form);
			var arquivo;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			if(_('fotoCriacaoComunidade').files && _('fotoCriacaoComunidade').files[0]){
				arquivo = _('fotoCriacaoComunidade').files[0];
				if(arquivo.length > 0)
					fd.append('fotoComunidade', arquivo);
			}
<<<<<<< HEAD
			let ajax = new XMLHttpRequest();
=======
			var ajax = new XMLHttpRequest();
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			ajax.onreadystatechange = function(evt){
				if(ajax.readyState === 4 && ajax.status === 200){
					_('fotoCriacaoComunidade').value = '';
					_('nomeComunidade').value = '';
					_('descricaoComunidade').value = '';
					_q('.contadorNomeComunidade').innerHTML = '';
					_q('.contadorDescricaoComunidade').innerHTML = '';
<<<<<<< HEAD
					_q('.previsualisacaoImgCom').innerHTML = '';
=======
					_('pevImagCom').src = '';
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
					exibirComunidades();
					_('mensagemErroComunidadeDiv').style.display = 'block';
					_('fundoOpacoMensagemComunidadeErro').style.display = 'block';
					_('mensagemCriarComunidadeDiv').innerHTML = this.responseText;
				}
			}
			ajax.open('POST', comuH);
			ajax.send(fd);
		});
	}

	function fecharCriarComunidadeMes(){
		if(_('fecharCriarComunidadeMes')){
			_('fecharCriarComunidadeMes').addEventListener('click',function(){
				_('mensagemErroComunidadeDiv').style.display = 'none';
				_('fundoOpacoMensagemComunidadeErro').style.display = 'none';
			});
		}
	}
	fecharCriarComunidadeMes();
	
	function contadorTamanhoComunidadeTituloEDescricao(){
		$('#nomeComunidade').on('change paste keyup', function(){
<<<<<<< HEAD
			let nomTamanho = $('#nomeComunidade').val();
=======
			var nomTamanho = $('#nomeComunidade').val();
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			$('.contadorNomeComunidade').html('<small>Caracteres: '+(nomTamanho.length)+'</small>');
		});

		$('#descricaoComunidade').on('change paste keyup', function(){
<<<<<<< HEAD
			let desTamanho = $('#descricaoComunidade').val();
=======
			var desTamanho = $('#descricaoComunidade').val();
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			$('.contadorDescricaoComunidade').html('<small>Caracteres: '+(desTamanho.length)+'</small>');
		});
	}
	contadorTamanhoComunidadeTituloEDescricao();

	function excluirComunidade(){
		_a('.comunidadeId').forEach(function(valores){
<<<<<<< HEAD
			let id = valores.value;
=======
			var id = valores.value;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			$('#botaoExcluirComunidade'+id).click(function(){
				_('messConfirmDelComunidade'+id).style.display = 'block';
				_q('.fundoOpacoPadrao').style.display = 'block';
				_q('body').style.overflow = 'hidden';
				
			});
			$('#fecharMessConfirmDelComunidade'+id).click(function(){
				_('messConfirmDelComunidade'+id).style.display = 'none';
				_q('.fundoOpacoPadrao').style.display = 'none';
				_q('body').style.overflow = 'auto';
			});
			confirmExcluirComunidade(id);
		});
	}
<<<<<<< HEAD
	excluirComunidade();
=======
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36

	function confirmExcluirComunidade(id){
		$('#botaoConfirmacaoDeleterComunidade'+id).click(function(){
			$.ajax({
				type: 'POST',
				url: comuH,
				data: $('#excluirComunidade'+id).serialize(),
				cache: false,
				success(data){
					_q('body').style.overflow = 'auto';
					_q('.fundoOpacoPadrao').style.display = 'none';
					exibirComunidades();
					exibirTop4Topicos();
					exibirPesquisaComunidade();
				}
			});
		});
	}

	function exibirPesquisaComunidade(){
		if(_('pesquisaCom')){
			var pesquisaCom = _('pesquisaCom').value;
			$.ajax({
				type: 'POST',
				url: pesH,
				data: {pesquisaCom: pesquisaCom},
				cache: false,
				success: function(data){
					$('.indexColunaPrincipal').html(data);
					excluirComunidade();
				}
			});
		}
	}
	exibirPesquisaComunidade();
});