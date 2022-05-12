$(document).ready(function(){
    const reqAH = 'includes/handlers/reqAmizadeHandler.php';
    function exibirAmigos(){
		if(_('paginaUsuarioId')){
<<<<<<< HEAD
			let amigos = _('paginaUsuarioId').value;
=======
			var amigos = _('paginaUsuarioId').value;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
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
<<<<<<< HEAD
=======
	exibirAmigos();
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36

	// requisicao ignorar aceitar remover amigo
	function exibirReqAmizadeAba(){
		if(_('paginaUsuario')){	
<<<<<<< HEAD
			let logUsuario = _('logUsuario').value;
			let pagUsuario = _('paginaUsuario').value;
=======
			var logUsuario = _('logUsuario').value;
			var pagUsuario = _('paginaUsuario').value;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
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
<<<<<<< HEAD
=======
	exibirReqAmizadeAba();
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
	
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
<<<<<<< HEAD
	enviarRecAmiz();

	function checarRequerimentoAmizadeRecebidoEnviado(){
		let checReq = _('paginaUsuarioId').value;
=======

	function checarRequerimentoAmizadeRecebidoEnviado(){
		var checReq = _('paginaUsuarioId').value;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
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
<<<<<<< HEAD
			let id = this.value;
=======
			var id = this.value;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
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
<<<<<<< HEAD
	cancelarReqAmizadeEnviado();
=======
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36

	function aceitarIgnorarRequisicao(){
		if(_q('.reqAmId')){
			_a('.reqAmId').forEach(function(valores){
<<<<<<< HEAD
				let id = valores.value;
=======
				var id = valores.value;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
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
<<<<<<< HEAD
	aceitarIgnorarRequisicao();
=======
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
	
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
<<<<<<< HEAD
	removerAmigo();
=======
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
});