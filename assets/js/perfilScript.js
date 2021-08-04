$(document).ready(function(){
	const perfH = 'includes/handlers/perfilHandler.php';
	function exibirEditarPerfil(){
		$('#botaoEditarPerfilCaixa').click(function(){
			if(_q('.editarPerfilCaixa').style.display == 'block')
				_q('.editarPerfilCaixa').style.display = 'none';
			else
				_q('.editarPerfilCaixa').style.display = 'block'
		});
	}
	exibirEditarPerfil();
	// set
	if(_('trocarFotoPerfilBotao')){
		_('trocarFotoPerfilBotao').addEventListener('click', function(){
			var form = _('trocarFotoPerfilForm');
			var ajax = new XMLHttpRequest();
			var fd = new FormData(form);
			var arquivo; 
			if(_('trocarFotoPerfil').files && _('trocarFotoPerfil').files[0]){
				arquivo = _('trocarFotoPerfil').files;
				if(arquivo.length > 0){
					fd.append('trocarFotoPerfil', arquivo);
					ajax.onreadystatechange = function(evt){
						if(ajax.readyState === 4 && ajax.status === 4){
							exibirFoto();
							_('trocarFotoPerfil').value = '';
							_('mensagemPerfilDiv').innerHTML = this.responseText;
							_('mensagemErroPerfilDiv').style.display = 'block';
							_('fundoOpacoMensagemPerfilErro').style.display = 'block';
							_q('body').style.overflow = 'hiddden';
						}
					}
					ajax.open('POST', perfH);
					ajax.send(fd);
				}else
					console.log('length');
			}else
				console.log('.files');
		});
	}

	$('#trocarNomeBotao').click(function(){
		$.post(perfH, { trocarNome: trocarNomeForm.trocarNome.value},
		function(resultado){
			_('mensagemPerfilDiv').innerHTML = resultado;
			_('mensagemErroPerfilDiv').style.display = 'block';
			_('fundoOpacoMensagemPerfilErro').style.display = 'block';
			_q('body').style.overflow = 'hiddden';
			$('#trocarNome').val('');
			exibirNome();
		});
	});
	
	$('#trocarEmailBotao').click(function(){
		$.post(perfH, { trocarEmail: trocarEmailForm.trocarEmail.value, trocarEmail2: trocarEmailForm.trocarEmail2.value},
		function(resultado){
			_('mensagemPerfilDiv').innerHTML = resultado;
			_('mensagemErroPerfilDiv').style.display = 'block';
			_('fundoOpacoMensagemPerfilErro').style.display = 'block';
			_q('body').style.overflow = 'hiddden';
			$('#trocarEmail').val('');
			$('#trocarEmail2').val('');
			exibirEmail();
		});
	});
	
	$('#trocarSenhaBotao').click(function(){
		$.post(perfH, { trocarSenha: trocarSenhaForm.trocarSenha.value, trocarSenha2: trocarSenhaForm.trocarSenha2.value},
		function(resultado){
			_('mensagemPerfilDiv').innerHTML = resultado;
			_('mensagemErroPerfilDiv').style.display = 'block';
			_('fundoOpacoMensagemPerfilErro').style.display = 'block';
			_q('body').style.overflow = 'hiddden';
			$('#trocarSenha').val('');
			$('#trocarSenha2').val('');
		});
	});
	
	$('#trocarDescricaoBotao').click(function(){
		$.post(perfH, { trocarDescricao: trocarDescricaoForm.trocarDescricao.value},
		function(resultado){
			_('mensagemPerfilDiv').innerHTML = resultado;
			_('mensagemErroPerfilDiv').style.display = 'block';
			_('fundoOpacoMensagemPerfilErro').style.display = 'block';
			_q('body').style.overflow = 'hiddden';
			exibirDescricao();
		});
	});

	function fecharPerfilMes(){
		if(_('fecharPerfilMes')){
			_('fecharPerfilMes').addEventListener('click', function(){
				_('mensagemErroPerfilDiv').style.display = 'none';
				_('fundoOpacoMensagemPerfilErro').style.display = 'none';
				_q('body').style.overflow = 'auto';
			});
		}
	}
	fecharPerfilMes();

	// get
	if(_('paginaUsuarioId')){
		function exibirNome(){
			var nome = _('paginaUsuarioId').value;
			$.ajax({
				type: 'POST',
				url: perfH,
				data: {nome: nome},
				cache: false,
				success(data){
					$('#nomeUsuarioPagina').html(data);
				}			
			});
		}
		exibirNome();

		function exibirFoto(){
			var foto = _('paginaUsuarioId').value;
			$.ajax({
				type: 'POST',
				url: perfH,
				data: {foto: foto},
				cache: false,
				success(data){
					$('#fotoUsuarioPagina').html(data);
				}			
			});
		}
		exibirFoto();

		function exibirEmail(){
			var email = _('paginaUsuarioId').value;
			$.ajax({
				type: 'POST',
				url: perfH,
				data: {email: email},
				cache: false,
				success(data){
					$('#emailUsuarioPagina').html(data);
				}			
			});
		}
		exibirEmail();

		function exibirDescricao(){
			var descricao = _('paginaUsuarioId').value;
			$.ajax({
				type: 'POST',
				url: perfH,
				data: {descricao: descricao},
				cache: false,
				success(data){
					$('.exibirUsuarioDescricao').html(data);
					$('#trocarDescricao').html(data);
				}			
			});
		}
		exibirDescricao()
	}
});