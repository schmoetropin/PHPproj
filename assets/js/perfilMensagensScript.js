$(document).ready(function(){
    const mensH = 'includes/handlers/mensagemHandler.php';
    if(_('botaoEnviarMensagem')){
		$('#botaoEnviarMensagem').click(function(){
			$.post(mensH, {usuarioMensagem: mensagemForm.usuarioMensagem.value, mensagemTextarea: mensagemForm.mensagemTextarea.value}, function(resultado){
				$('#mensagemTextarea').val('');
			});
		});
	}
	
	function exibirMenssagens(){
		if(_('logUsuario') && _('usuario')){
			var logUsuario = _('logUsuario').value
			var usuario = _('usuario').value;
			$.ajax({
				type: 'POST',
				url : mensH,
				data: { logUsuario: logUsuario, usuario: usuario},
				cache: false,
				success: function(data){
					if(_('perfilMensagemArea')){	
						var messages = _('perfilMensagemArea');
						shouldScroll = messages.scrollTop + messages.clientHeight === messages.scrollHeight;
						if(!shouldScroll)
							_('perfilMensagemArea').scrollTop = _('perfilMensagemArea').scrollHeight
											
						$('#perfilMensagemArea').html(data);
					}
				}
			});
		}
	};
	setInterval(exibirMenssagens, 200);
	
	function exibirMensagensComId(){
		_a('.usuarioConversa').forEach(function(valores){
			var id = valores.value;
			var logUsuario = _('logUsuario'+id).value;
			var usuario = _('usuario'+id).value;
			$.ajax({
				type: 'POST',
				url : mensH,
				data: { logUsuario: logUsuario, usuario: usuario},
				cache: false,
				success: function(data){
					var messages = _('perfilMensagem'+id);
					shouldScroll = messages.scrollTop + messages.clientHeight === messages.scrollHeight;
					if(!shouldScroll)
						messages.scrollTop = messages.scrollHeight;
					$('#perfilMensagem'+id).html(data);
				}
			});
		});
	};
	setInterval(exibirMensagensComId, 200);
	
	function exibirTodasConversasPorUsuario(){
		if(_q('.usuarioConversa')){
			_a('.usuarioConversa').forEach(function(valores){
				var id = valores.value;
				_('enviadoPorUsuario'+id).addEventListener('click', function(){
					if(_('caixaMensagemForm'+id).style.display == 'block')
						_('caixaMensagemForm'+id).style.display = 'none';
					else
						_('caixaMensagemForm'+id).style.display = 'block';
				});
			});
				
			_a('.usuarioConversa').forEach(function(valores){
				var id = valores.value;
				$('#enviarMensagem'+id).click(function(){
					$.ajax({
						type: 'POST',
						url: mensH,
						data: $('#mensagemForm'+id).serialize(),
						cache: false,
						success: function(data){
							$('.mensagemTextarea'+id).val('');
						}
					});
				});
			});
		}
	}
	exibirTodasConversasPorUsuario();
});