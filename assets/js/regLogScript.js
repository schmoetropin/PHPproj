$(document).ready(function(){
	// exibe login
	function exibirCaixaLogin(){
<<<<<<< HEAD
		let log = _a('.botaoLogin');
		for(let i = 0; i < log.length; i++){
=======
		const log = _a('.botaoLogin');
		for(var i = 0; i < log.length; i++){
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			log[i].addEventListener('click', function(){
				if(_('caixaLogin').style.display == 'block')
					_('caixaLogin').style.display = 'none';
				else
					_('caixaLogin').style.display = 'block';
			});
		}
	}
	exibirCaixaLogin();

	// exibe e fechar registrar
	function exibirFecharCaixaRegistro(){
<<<<<<< HEAD
		let reg = _a('.botaoRegistro');

		for(let i = 0; i < reg.length; i++){
=======
		const reg = _a('.botaoRegistro');

		for(var i = 0; i < reg.length; i++){
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			reg[i].addEventListener('click', function(){
				_('caixaRegistro').style.display = 'block';
				_q('.fundoOpacoPadrao').style.display = 'block';
				_q('body').style.overflow = 'hidden';
			});
		}

		_('fecharCaixaRegistro').addEventListener('click', function(){
			_('caixaRegistro').style.display = 'none';
			_q('.fundoOpacoPadrao').style.display = 'none';
			_q('body').style.overflow = 'auto';
		});
	}
	exibirFecharCaixaRegistro()

	const regLogH = 'includes/handlers/regLogHandler.php';
	//LOGIN
	$('#inputLoginForm').click(function(){
		$.post(regLogH, {
			logEmail: loginForm.logEmail.value,
			logSenha: loginForm.logSenha.value
			}, function(result){
			$('#mensagemLogin').html(result).show();
		});
	});
	
	//REGISTRAR	
	$('#inputRegistroForm').click(function(){
		$.post(
			regLogH, {
			regNome: registroForm.regNome.value,
			regEmail: registroForm.regEmail.value,
			regEmail2: registroForm.regEmail2.value,
			regSenha: registroForm.regSenha.value,
			regSenha2: registroForm.regSenha2.value
			}, function(result){
				$('#mensagemRegistro').html(result).show();
				_('regNome').value = '';
				_('regEmail').value = '';
				_('regEmail2').value = '';
				_('regSenha').value = '';
				_('regSenha2').value = '';
				_('mensagemErroRegDiv').style.display = 'block';
				_('fundoOpacoMensagemRegErro').style.display = 'block';
				_q('body').style.overfow = 'hidden';
			}
		);
	});

	function fecharRegistroMes(){
		if(_('fecharRegistroMes')){
			_('fecharRegistroMes').addEventListener('click',function(){
				_('mensagemErroRegDiv').style.display = 'none';
				_('fundoOpacoMensagemRegErro').style.display = 'none';
				_q('body').style.overfow = 'auto';
			});
		}
	}
	fecharRegistroMes();

	// logout
	function logout(){
		$('.botaoLogout').each(function(){
			$(this).click(function(){
<<<<<<< HEAD
				let deslogarConta = 'sim';
=======
				var deslogarConta = 'sim';
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
				$.ajax({
					type: 'POST',
					url: regLogH,
					data: {deslogarConta: deslogarConta},
					cache: false,
					success: function(data){
						$('#logoutS').html(data);
					}
				});
			})
		});
		$('#botaoLogoutPerfil').each(function(){
			$(this).click(function(){
<<<<<<< HEAD
				let deslogarConta = 'sim';
=======
				var deslogarConta = 'sim';
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
				$.ajax({
					type: 'POST',
					url: regLogH,
					data: {deslogarConta: deslogarConta},
					cache: false,
					success: function(data){
						$('#logoutS').html(data);
					}
				});
			})
		});
	}
	logout();

	function fecharCaixaResolucaoIcones(){
		$('#fecharCaixaBaixRes').click(function(){
			$('#baixaResolucaoUlBarraTopo').hide();
		});
	}
	fecharCaixaResolucaoIcones();
});
