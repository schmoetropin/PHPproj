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
					ajax.addEventListener('load', function(e){
						_('fotoPerfilMensagem').innerHTML = this.responseText;
						exibirFoto();
						_('trocarFotoPerfil').value = '';
					}, false);

					ajax.addEventListener('abort', function(e){
						console.log('abort');
					}, false);

					ajax.addEventListener('error', function(e){
						console.log('error');
					}, false);

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
			$('#nomeMensagem').html(resultado).show();
			$('#trocarNome').val('');
			exibirNome();
		});
	});
	
	$('#trocarEmailBotao').click(function(){
		$.post(perfH, { trocarEmail: trocarEmailForm.trocarEmail.value, trocarEmail2: trocarEmailForm.trocarEmail2.value},
		function(resultado){
			$('#emailMensagem').html(resultado).show();
			$('#trocarEmail').val('');
			$('#trocarEmail2').val('');
			exibirEmail();
		});
	});
	
	$('#trocarSenhaBotao').click(function(){
		$.post(perfH, { trocarSenha: trocarSenhaForm.trocarSenha.value, trocarSenha2: trocarSenhaForm.trocarSenha2.value},
		function(resultado){
			$('#senhaMensagem').html(resultado).show();
			$('#trocarSenha').val('');
			$('#trocarSenha2').val('');
		});
	});
	
	$('#trocarDescricaoBotao').click(function(){
		$.post(perfH, { trocarDescricao: trocarDescricaoForm.trocarDescricao.value},
		function(resultado){
			$('#descricaoMensagem').html(resultado).show();
			exibirDescricao();
		});
	});

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