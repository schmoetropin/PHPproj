$(document).ready(function(){
	const comuH = 'includes/handlers/comunidadeHandler.php';
	const pesH = 'includes/handlers/pesquisaHandler.php';
	function exibirComunidades(){
		var comunidades = 'sim';
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
	exibirComunidades();
	
	function exibirTop4Topicos(){
		var top4TopicoIndex = 'sim';
		$.ajax({
			type: 'POST',
			url: comuH,
			data: {top4TopicoIndex: top4TopicoIndex},
			cache: false,
			success: function(data){
				$('.top4TopicosIndex').html(data);
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

	// criar comunidade
	if(_('inputCriarComunidade')){
		_('inputCriarComunidade').addEventListener('click', function(){
			var form = _('criarComunidadeForm');
			var fd = new FormData(form);
			var arquivo;
			if(_('fotoCriacaoComunidade').files && _('fotoCriacaoComunidade').files[0]){
				arquivo = _('fotoCriacaoComunidade').files[0];
				if(arquivo.length > 0)
					fd.append('fotoComunidade', arquivo);
			}
			var ajax = new XMLHttpRequest();
			ajax.onreadystatechange = function(evt){
				if(ajax.readyState === 4 && ajax.status === 200){
					_('fotoCriacaoComunidade').value = '';
					_('nomeComunidade').value = '';
					_('descricaoComunidade').value = '';
					_q('.contadorNomeComunidade').innerHTML = '';
					_q('.contadorDescricaoComunidade').innerHTML = '';
					_('pevImagCom').src = '';
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
			var nomTamanho = $('#nomeComunidade').val();
			$('.contadorNomeComunidade').html('<small>Caracteres: '+(nomTamanho.length)+'</small>');
		});

		$('#descricaoComunidade').on('change paste keyup', function(){
			var desTamanho = $('#descricaoComunidade').val();
			$('.contadorDescricaoComunidade').html('<small>Caracteres: '+(desTamanho.length)+'</small>');
		});
	}
	contadorTamanhoComunidadeTituloEDescricao();

	function excluirComunidade(){
		_a('.comunidadeId').forEach(function(valores){
			var id = valores.value;
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