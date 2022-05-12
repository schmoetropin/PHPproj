$(document).ready(function(){
	const comuH = 'includes/handlers/comunidadeHandler.php';
	const pesH = 'includes/handlers/pesquisaHandler.php';
	function exibirComunidades(){
		let comunidades = 'sim';
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
	
	function exibirTop4Topicos(){
		let top4TopicoIndex = 'sim';
		$.ajax({
			type: 'POST',
			url: comuH,
			data: {top4TopicoIndex: top4TopicoIndex},
			cache: false,
			success: function(data){
				$('.top4TopicosIndex').html(data);
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

	// criar comunidade
	if(_('inputCriarComunidade')){
		_('inputCriarComunidade').addEventListener('click', function(){
			let form = _('criarComunidadeForm');
			let fd = new FormData(form);
			let arquivo;
			if(_('fotoCriacaoComunidade').files && _('fotoCriacaoComunidade').files[0]){
				arquivo = _('fotoCriacaoComunidade').files[0];
				if(arquivo.length > 0)
					fd.append('fotoComunidade', arquivo);
			}
			let ajax = new XMLHttpRequest();
			ajax.onreadystatechange = function(evt){
				if(ajax.readyState === 4 && ajax.status === 200){
					_('fotoCriacaoComunidade').value = '';
					_('nomeComunidade').value = '';
					_('descricaoComunidade').value = '';
					_q('.contadorNomeComunidade').innerHTML = '';
					_q('.contadorDescricaoComunidade').innerHTML = '';
					_q('.previsualisacaoImgCom').innerHTML = '';
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
			let nomTamanho = $('#nomeComunidade').val();
			$('.contadorNomeComunidade').html('<small>Caracteres: '+(nomTamanho.length)+'</small>');
		});

		$('#descricaoComunidade').on('change paste keyup', function(){
			let desTamanho = $('#descricaoComunidade').val();
			$('.contadorDescricaoComunidade').html('<small>Caracteres: '+(desTamanho.length)+'</small>');
		});
	}
	contadorTamanhoComunidadeTituloEDescricao();

	function excluirComunidade(){
		_a('.comunidadeId').forEach(function(valores){
			let id = valores.value;
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
	excluirComunidade();

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