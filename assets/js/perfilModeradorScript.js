$(document).ready(function(){
	const perfH = 'includes/handlers/perfilHandler.php';
    const modH = 'includes/handlers/moderadorHandler.php';

    function criarTipoUsuarioHiddenInput(){
		if(_('paginaUsuarioId')){	
<<<<<<< HEAD
			let tipoUsuarioIH = _('paginaUsuarioId').value;
=======
			var tipoUsuarioIH = _('paginaUsuarioId').value;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
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
<<<<<<< HEAD
    
    
    function exibirTipoUsuario(){
		let tipoUs = _('tipoUsuarioH').value;
		let usuario = _('paginaUsuarioId').value;
		$.ajax({
			type: 'POST',
			url: perfH,
			data: {usuario: usuario, tipoUs: tipoUs},
=======
    criarTipoUsuarioHiddenInput();
    
    function exibirTipoUsuario(){
		var tipoUs = _('tipoUsuarioH').value;
		$.ajax({
			type: 'POST',
			url: perfH,
			data: {tipoUs: tipoUs},
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
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
<<<<<<< HEAD
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
=======

    function exibirComunidadesModerador(){
		var comunMod = _('paginaUsuarioId').value;
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

    function aceitarRequisicaoMod(){
		_a('.requisicaoId').forEach(function(valores){
			var id = valores.value;
			_('aceitarModRequisicao'+id).addEventListener('click',function(){
				var form = _('aceitarModRequisicaoForm'+id);
				var fd = new FormData(form);
				var ajax = new XMLHttpRequest();
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

	function recusarRequisicaoMod(){
		_a('.requisicaoId').forEach(function(valores){
			var id = valores.value;
			$('#recusarModRequisicao').click(function(){
				$.ajax({
					type: 'POST',
					url: modH,
					data: $('#recusarModRequisicaoForm').serialize(),
					cache: false,
					success: function(data){
						$('#reqModRecebidaArea').html(data);
						exibirModRequisicaoRecebida();
					}
				});
			});
		});
    }

    function exibirModRequisicaoRecebida(){
		var recMod = _('logUsuario').value;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
		$.ajax({
			type: 'POST',
			url: modH,
			data: {recMod: recMod},
			cache: false,
			success: function(data){
				$('#reqModRecebidaArea').html(data);
		        aceitarRequisicaoMod();
<<<<<<< HEAD
				recusarRequisicaoMod();
=======
                recusarRequisicaoMod();
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			}
		});
    }
	
	function exibirModRequerimentoForm(){
		if(_('paginaUsuario')){	
<<<<<<< HEAD
			let logUsuario = _('logUsuario').value;
			let usuario = _('paginaUsuario').value;
=======
			var logUsuario = _('logUsuario').value;
			var usuario = _('paginaUsuario').value;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
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
<<<<<<< HEAD
=======
	exibirModRequerimentoForm();
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36

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
<<<<<<< HEAD
	enviarModRequerimentoForm();

	function exibirModRequisicaoEnviada(){
		let envMod = _('logUsuario').value;
=======

	function exibirModRequisicaoEnviada(){
		var envMod = _('logUsuario').value;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
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
<<<<<<< HEAD
		let mod = _('logUsuario').value;
		let reqUs = _('paginaUsuario').value;
=======
		var mod = _('logUsuario').value;
		var reqUs = _('paginaUsuario').value;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
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
<<<<<<< HEAD
				let id = values.value;
				_('carcelarReqModForm'+id).addEventListener('click', function(){
					let form = _('carcelarReqModForm'+id);
					let fd = new FormData(form);
					let ajax = new XMLHttpRequest();
=======
				var id = values.value;
				_('carcelarReqModForm'+id).addEventListener('click', function(){
					var form = _('carcelarReqModForm'+id);
					var fd = new FormData(form);
					var ajax = new XMLHttpRequest();
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
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
<<<<<<< HEAD
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
	
=======

	function sairModerador(ids){
		ids.forEach(function(valores){
			var id = valores.value;
			if(_('recusarCargModeradorBotao'+id)){
				_('recusarCargModeradorBotao'+id).addEventListener('click',function(){
					var form = _('recusarCargModeradorForm'+id);
					var fd = new FormData(form);
					var ajax = new XMLHttpRequest();
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
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
});