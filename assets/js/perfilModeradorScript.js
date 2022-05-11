$(document).ready(function(){
	const perfH = 'includes/handlers/perfilHandler.php';
    const modH = 'includes/handlers/moderadorHandler.php';

    function criarTipoUsuarioHiddenInput(){
		if(_('paginaUsuarioId')){	
			let tipoUsuarioIH = _('paginaUsuarioId').value;
			$.ajax({
				type: 'POST',
				url: perfH,
				data: {tipoUsuarioIH: tipoUsuarioIH},
				cache: false,
				success(data){
					$('#tipoUsuarioHiddenInput').html(data);
					exibirTipoUsuario();
				}			
			});
		}
	}
    
    
    function exibirTipoUsuario(){
		let tipoUs = _('tipoUsuarioH').value;
		let usuario = _('paginaUsuarioId').value;
		$.ajax({
			type: 'POST',
			url: perfH,
			data: {usuario: usuario, tipoUs: tipoUs},
			cache: false,
			success(data){
				$('#tipoUsuarioArea').html(data);
				exibirFecharComunidadeMod();
				exibirComunidadesModerador();
			}			
		});
    }

    function exibirFecharComunidadeMod(){
		if(_('modComunBot')){
			_('modComunBot').addEventListener('click', function(){
				if(_('modComunCaixa').style.display == 'block')
					_('modComunCaixa').style.display = 'none';
				else
					_('modComunCaixa').style.display = 'block';
			});
		}

		if(_('fecharModComunCaixa')){
			_('fecharModComunCaixa').addEventListener('click', function(){
				_('modComunCaixa').style.display = 'none';
			});
		}
	}
	exibirFecharComunidadeMod();

    function exibirComunidadesModerador(){
		if(_('paginaUsuarioId')){
			let comunMod = _('paginaUsuarioId').value;
			$.ajax({
				type: 'POST',
					url: modH,
					data: {comunMod: comunMod},
					cache: false,
					success: function(data){
						$('#modComunCaixaComunidades').html(data);
						var id = _a('.comunidadeModeradorNU');
						if(typeof sairModerador === 'function')
							sairModerador(id);
					}
			});
		}
	}

    function aceitarRequisicaoMod(){
		if(('.requisicaoId')){
			_a('.requisicaoId').forEach(function(valores){
				let id = valores.value;
				_('aceitarModRequisicao'+id).addEventListener('click',function(){
					let form = _('aceitarModRequisicaoForm'+id);
					let fd = new FormData(form);
					let ajax = new XMLHttpRequest();
					ajax.onreadystatechange = function(evt){
						if(ajax.readyState === 4 && ajax.status === 200){
							_('reqModRecebidaArea').innerHTML = this.responseText;
							exibirModRequisicaoRecebida();
							criarTipoUsuarioHiddenInput();
						}
					}
					ajax.open('POST',modH);
					ajax.send(fd);
				});
			});
		}
	}
	aceitarRequisicaoMod();

	function recusarRequisicaoMod(){
		if(_q('.requisicaoId')){
			_a('.requisicaoId').forEach(function(valores){
				let id = valores.value;
				_('recusarModRequisicao'+id).addEventListener('click', function(){
					console.log(id);
					let form = _('recusarModRequisicaoForm'+id);
					let fd = new FormData(form);
					let xhr = new XMLHttpRequest();
					xhr.onreadystatechange = function(){
						if(xhr.readyState === 4 && xhr.status === 200){
							_('reqModRecebidaArea').innerHTML = this.responseText;
							exibirModRequisicaoRecebida();
						}
					}
					xhr.open('POST', modH);
					xhr.send(fd);
				});
			});
		}
	}
	recusarRequisicaoMod();

	function exibirModRequisicaoRecebida(){
		let recMod = _('logUsuario').value;
		$.ajax({
			type: 'POST',
			url: modH,
			data: {recMod: recMod},
			cache: false,
			success: function(data){
				$('#reqModRecebidaArea').html(data);
		        aceitarRequisicaoMod();
				recusarRequisicaoMod();
			}
		});
    }
	
	function exibirModRequerimentoForm(){
		if(_('paginaUsuario')){	
			let logUsuario = _('logUsuario').value;
			let usuario = _('paginaUsuario').value;
			$.ajax({
				type: 'POST',
				url: modH,
				data: {logUsuario: logUsuario, usuario: usuario},
				cache: false,
				success: function(data){
					$('#modRequerimentoFormArea').html(data);
					enviarModRequerimentoForm();
					exibirModRequisicaoEnviada();
					exibirModRequisicaoRecebida();
					exibirModRequisicaoEnviadaUsuario();
				}
			});
		}
	}

	function enviarModRequerimentoForm(){
		$('#enviarAdicionarModerador').click(function(){
			$.ajax({
				type: 'POST',
				url: modH,
				data: $('#adicionarModeradorForm').serialize(),
				cache: false,
				success: function(data){
					exibirModRequerimentoForm();
					_('mensagemPerfilDiv').innerHTML = data;
					_('mensagemErroPerfilDiv').style.display = 'block';
					_('fundoOpacoMensagemPerfilErro').style.display = 'block';
					_q('body').style.overflow = 'hidden';
				}
			});
		});
	}
	enviarModRequerimentoForm();

	function exibirModRequisicaoEnviada(){
		let envMod = _('logUsuario').value;
		$.ajax({
			type: 'POST',
			url: modH,
			data: {envMod: envMod},
			cache: false,
			success: function(data){
				$('#reqModEnviadaArea').html(data);
				cancelarReqModEnviada();
			}
		});
	}

	function exibirModRequisicaoEnviadaUsuario(){
		let mod = _('logUsuario').value;
		let reqUs = _('paginaUsuario').value;
		$.ajax({
			type: 'POST',
			url: modH,
			data: {mod: mod, reqUs: reqUs},
			cache: false,
			success: function(data){
				$('#reqModUsuarioEnviadaArea').html(data);
				cancelarReqModEnviada();
			}
		});
	}

	function cancelarReqModEnviada(){
		if(_q('.reqModEnviadoId')){
			_a('.reqModEnviadoId').forEach(function(values){
				let id = values.value;
				_('carcelarReqModForm'+id).addEventListener('click', function(){
					let form = _('carcelarReqModForm'+id);
					let fd = new FormData(form);
					let ajax = new XMLHttpRequest();
					ajax.onreadystatechange = function(evt){
						if(ajax.readyState === 4 && ajax.status === 200){
							exibirModRequerimentoForm();
							exibirModRequisicaoEnviada();
							exibirModRequisicaoEnviadaUsuario();
						}else
							console.log('ERRO');
					}
					ajax.open('POST', modH);
					ajax.send(fd);
				});
			});
		}
	}
	cancelarReqModEnviada();

	function sairModerador(){
		if(_q('.comunidadeModeradorNU')){
			_a('.comunidadeModeradorNU').forEach(function(valores){
				let id = valores.value;
				if(_('recusarCargModeradorBotao'+id)){
					_('recusarCargModeradorBotao'+id).addEventListener('click',function(){
						let form = _('recusarCargModeradorForm'+id);
						let fd = new FormData(form);
						let ajax = new XMLHttpRequest();
						ajax.onreadystatechange = function(evt){
							if(ajax.readyState === 4 && ajax.status === 200){
								criarTipoUsuarioHiddenInput();
								_('modComunCaixa').style.display = 'block';
								_('mensagemPerfilDiv').innerHTML = this.responseText;
								_('mensagemErroPerfilDiv').style.display = 'block';
								_('fundoOpacoMensagemPerfilErro').style.display = 'block';
								_q('body').style.overflow = 'hidden';
							}else
								console.log('ERRO');
						}
						ajax.open('POST', modH);
						ajax.send(fd);
					});
				}
			});
		}
	}
	sairModerador();
	
});