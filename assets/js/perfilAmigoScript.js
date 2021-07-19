$(document).ready(function(){
    const reqAH = 'includes/handlers/reqAmizadeHandler.php';
    function exibirAmigos(){
		if(_('paginaUsuarioId')){
			var amigos = _('paginaUsuarioId').value;
			$.ajax({
				type: 'POST',
				url: reqAH,
				data: {amigos: amigos},
				cache: false,
				success(data){
					$('#listaAmigos').html(data);
				}			
			});
		}
	}
	exibirAmigos();

	// requisicao ignorar aceitar remover amigo
	function exibirReqAmizadeAba(){
		if(_('paginaUsuario')){	
			var logUsuario = _('logUsuario').value;
			var pagUsuario = _('paginaUsuario').value;
			$.ajax({
				type: 'POST',
				url: reqAH,
				data: {logUsuario: logUsuario, pagUsuario: pagUsuario},
				cache: false,
				success(data){
					$('#requerimentoAmigoAbaArea').html(data);
					enviarRecAmiz();
					checarRequerimentoAmizadeRecebidoEnviado();
					removerAmigo();
				}
			});
		}
	}
	exibirReqAmizadeAba();
	
	function enviarRecAmiz(){
		if(_('enviarRequerimentoAmizade')){
			$('#enviarRequerimentoAmizade').click(function(){
				$.post(
					reqAH,
					{rLogUsuario: requizicaoAmizadeForm.rLogUsuario.value, rUsuario: requizicaoAmizadeForm.rUsuario.value},
					function(resultado){
						$('.requizicaoAmizadeFormArea').html(resultado);
					}
				);
			});
		}
	}

	function checarRequerimentoAmizadeRecebidoEnviado(){
		var checReq = _('paginaUsuarioId').value;
		$.ajax({
			type: 'POST',
			url: reqAH,
			data: {checReq: checReq},
			cache: false,
			success: function(data){
				$('#checarReqAmRecEnv').html(data);
				aceitarIgnorarRequisicao();
				cancelarReqAmizadeEnviado()
			}
		});
	}

	function cancelarReqAmizadeEnviado(){
		$('.reqAmizadeEnviadoId').each(function(){
			var id = this.value;
			$('#cancelarReqAmizade'+id).click(function(){
				$.ajax({
					type: 'POST',
					url: reqAH,
					data: $('#carcelarReqAmizadeForm'+id).serialize(),
					cache: false,
					success: function(data){
						console.log(data);
						exibirReqAmizadeAba();
						checarRequerimentoAmizadeRecebidoEnviado();
					}
				});
			});
		});
	}

	function aceitarIgnorarRequisicao(){
		if(_q('.reqAmId')){
			_a('.reqAmId').forEach(function(valores){
				var id = valores.value;
				$('#aceitarRequisicao'+id).click(function(){
					$.ajax({
						type: 'POST',
						url: reqAH,
						data: $('#aceitarRequisicaoForm'+id).serialize(),
						cache: false,
						success: function(data){
							$('.requisicaoAmizade'+id).html("<p class='successMessage'>Pedido de amizade aceita!</p>");
							exibirAmigos();
							checarRequerimentoAmizadeRecebidoEnviado();
						}
					});
				});

				$('#ignorarRequisicao'+id).click(function(){
					$.ajax({
						type: 'POST',
						url: reqAH,
						data: $('#ignorarRequisicaoForm'+id).serialize(),
						cache: false,
						success: function(data){
							$('.requisicaoAmizade'+id).html("<p class='errorMessage'>Pedido de amizade ignorado!</p>");
							exibirAmigos();
							checarRequerimentoAmizadeRecebidoEnviado();
						}
					});
				});
			});
		}
	}
	
	function removerAmigo(){
		if(_('removerAmigo')){
			$('#removerAmigo').click(function(){
				$.post(reqAH, { paginaUsuario: removerAmigoForm.paginaUsuario.value},
				function(resultado){
					exibirAmigos();
					exibirReqAmizadeAba();
				});
			});
		}
	}
});