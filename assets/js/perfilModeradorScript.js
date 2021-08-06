$(document).ready(function(){
	const perfH = 'includes/handlers/perfilHandler.php';
    const modH = 'includes/handlers/moderadorHandler.php';

    function criarTipoUsuarioHiddenInput(){
		if(_('paginaUsuarioId')){	
			var tipoUsuarioIH = _('paginaUsuarioId').value;
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
    criarTipoUsuarioHiddenInput();
    
    function exibirTipoUsuario(){
		var tipoUs = _('tipoUsuarioH').value;
		$.ajax({
			type: 'POST',
			url: perfH,
			data: {tipoUs: tipoUs},
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
			var logUsuario = _('logUsuario').value;
			var usuario = _('paginaUsuario').value;
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
	exibirModRequerimentoForm();

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

	function exibirModRequisicaoEnviada(){
		var envMod = _('logUsuario').value;
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
		var mod = _('logUsuario').value;
		var reqUs = _('paginaUsuario').value;
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
				var id = values.value;
				_('carcelarReqModForm'+id).addEventListener('click', function(){
					var form = _('carcelarReqModForm'+id);
					var fd = new FormData(form);
					var ajax = new XMLHttpRequest();
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
});