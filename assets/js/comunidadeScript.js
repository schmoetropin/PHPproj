$(document).ready(function(){
	const comH = 'includes/handlers/comunidadeHandler.php';
	const topH = 'includes/handlers/topicoHandler.php';
	const inscH = 'includes/handlers/inscreverHandler.php';
	const pesH = 'includes/handlers/pesquisaHandler.php';
	if(_('comunidade')){
		var comunidade = _('comunidade').value;
		// checa se usuario esta logado anted de criar topico
		function botaoCriarTopico(){
			if(_('botaoCriarTopicoDe')){
				_('botaoCriarTopicoDe').addEventListener('click',function(){
					_q('.fundoOpacoPadrao').style.display = 'block';
					_('criarTopicoCaixa').style.display = 'block';
					_q('body').style.overflow = 'hidden';
				});
				_('botaoCriarTopicoSm').addEventListener('click',function(){
					_q('.fundoOpacoPadrao').style.display = 'block';
					_('criarTopicoCaixa').style.display = 'block';
					_q('body').style.overflow = 'hidden';
				});
			}
		}
		botaoCriarTopico();

		// fechar criacao topico
		function fecharCaixaTopico(){
			if(_('fecharCriarTopicoCaixa')){
				_('fecharCriarTopicoCaixa').addEventListener('click', function(){
					_q('.fundoOpacoPadrao').style.display = 'none';
					_('criarTopicoCaixa').style.display = 'none';
					_q('body').style.overflow = 'auto';
				});
			}
		}
		fecharCaixaTopico();
	
		function fecharCriarTopMes(){
			if(_('fecharCriarTopMes')){
				_('fecharCriarTopMes').addEventListener('click',function(){
					_q('.mensagemErro').style.display = 'none';
					_q('.fundoOpacoMensagemErro').style.display = 'none';
				});
			}
		}
		fecharCriarTopMes();
		
		// criar topico
		function criarTopico(){
			if(_('postarTopico')){	
				_('postarTopico').addEventListener('click', function(){
<<<<<<< HEAD
					let form = _('postarTopicoForm');
					let fd = new FormData(form);
					let arquivo;
					if(_('topicoUpload').files && _('topicoUpload').files[0]){
						arquivo = _('topicoUpload').files[0];
						if(arquivo.length > 0)
							fd.append('topicoUpload', arquivo);
					}
					let ajax = new XMLHttpRequest();
					ajax.upload.addEventListener('progress', function(e){
						let porcentagem = Math.floor((e.loaded / e.total) * 100);
=======
					var form = _('postarTopicoForm');
					var fd = new FormData(form);
					var arquivo;
					if(_('topicoUpload').files && _('topicoUpload').files[0]){
						arquivo = _('topicoUpload').files;
						if(arquivo.length > 0)
							fd.append('topicoUpload', arquivo);
					}
					var ajax = new XMLHttpRequest();
					ajax.upload.addEventListener('progress', function(e){
						var porcentagem = Math.floor((e.loaded / e.total) * 100);
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
						_('detalhesUpload').style.display = 'block';
						_('uploadProgressoTexto').innerHTML = porcentagem+'%: '+e.loaded+' bytes de '+e.total;
						_('uploadBarraDeProgresso').style.width = porcentagem+'%';
					}, false);
					ajax.onreadystatechange = function(evnt){
						if(ajax.readyState === 4 && ajax.status === 200){
							exibitTodosOsTopicos();
							_('mensagemErroDivCriarTopico').style.display = 'block';
							_('fundoOpacoMensagemErroCriarTopico').style.display = 'block';
							_('tituloTopico').value = '';
							_('tituloTopico').style.borderColor = '#DCDCDC';
							_('conteudoTopico').value = '';
							_('conteudoTopico').style.borderColor = '#DCDCDC';
							_q('.semMidiaForm').checked = 'true';
							_('topicoUpload').value = '';
							_('topicoUpload').style.display = 'none';
							_('topicoLink').value = '';
							_('topicoLink').style.display = 'none';
							_('detalhesUpload').style.display = 'none';
							_q('.previsualizacaoMidia').innerHTML = '';
							_q('.contadorTituloTopico').innerHTML = '';
							_q('.contadorConteudoTopico').innerHTML = '';
							_('mensagemPostarTopicoDiv').innerHTML = this.responseText;
						}
					}
					ajax.open('POST', topH);
					ajax.send(fd);
				});
			}
		}
		criarTopico();

		function fecharCriarTopMes(){
			if(_('fecharCriarTopMes')){
				_('fecharCriarTopMes').addEventListener('click',function(){
					_('mensagemErroDivCriarTopico').style.display = 'none';
					_('fundoOpacoMensagemErroCriarTopico').style.display = 'none';
					_q('body').style.overflow = 'auto';
				});
			}
		}

		function contadorTamanhoComunidadeTituloEDescricao(){
			$('#tituloTopico').on('change paste keyup', function(){
<<<<<<< HEAD
				let nomTamanho = $('#tituloTopico').val();
=======
				var nomTamanho = $('#tituloTopico').val();
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
				$('.contadorTituloTopico').html("<small style='margin-left: 40%;'>Caracteres: "+(nomTamanho.length)+'</small>');
			});
	
			$('#conteudoTopico').on('change paste keyup', function(){
<<<<<<< HEAD
				let desTamanho = $('#conteudoTopico').val();
=======
				var desTamanho = $('#conteudoTopico').val();
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
				$('.contadorConteudoTopico').html("<small style='margin-left: 40%;'>Caracteres: "+(desTamanho.length)+'</small>');
			});
		}
		contadorTamanhoComunidadeTituloEDescricao();

		// deletar topico
		function deletarTopico(){
			_a('.topicoId').forEach(function(valores){
<<<<<<< HEAD
				let id = valores.value;
=======
				var id = valores.value;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
				$('#deletarTopico'+id).click(function(){
					_q('.fundoOpacoPadrao').style.display = 'block';
					_('delTopicoCaixa'+id).style.display = 'block';
					_q('body').style.overflow = 'hidden';
				});
				$('#fecharDelTopicoCaixa'+id).click(function(){
					_q('.fundoOpacoPadrao').style.display = 'none';
					_('delTopicoCaixa'+id).style.display = 'none';
					_q('body').style.overflow = 'auto';
				});
				confirmarDeleterTopico(id);
			});
		}
<<<<<<< HEAD
		deletarTopico();
=======
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36

		function confirmarDeleterTopico(id){
			$('#botaoDeletarTopico'+id).click(function(){
				$.ajax({
					type: 'POST',
					url: topH,
					data: $('#deletarTopicoForm'+id).serialize(),
					cache: false,
					success: function(data){
						$('.fundoOpacoPadrao').hide();
						_q('body').style.overflow = 'auto';
						exibirTop4Topicos();
						exibitTodosOsTopicos();
						exibirPesquisaTopico();
					}
				});
			});
		}
		
		// EXIBIR BOTAO INSCREVER
		function exibirBotaoInscrever(){
			$.ajax({
				type: 'POST',
				url: inscH,
				data: { comunidade: comunidade},
				cache: false,
				success: function(data){
					$('.areaInscricao').each(function(){
						$(this).html(data);
						inscreverDesinscreverComunidade();
					});
				}
			});
		}
<<<<<<< HEAD
=======
		exibirBotaoInscrever()
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
		
		// INSCREVER DESISCREVER
		function inscreverDesinscreverComunidade(){
			$('.inscreverComunidadeBotao').each(function(){
				$(this).click(function(){
					$.ajax({
						type: 'POST',
						url: inscH,
						data: $('#inscreverForm').serialize(),
						cache: false,
						success: function(data){
							$('#areaInscricao').html(data);
							exibirBotaoInscrever();
						}
					});
				}); 
			});
		}
<<<<<<< HEAD
		inscreverDesinscreverComunidade();

		// exibe top4 topicos da comunidade
		function exibirTop4Topicos(){
			let top4Topicos = 'top';
=======

		// exibe top4 topicos da comunidade
		function exibirTop4Topicos(){
			var top4Topicos = 'top';
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			$.ajax({
				type: 'POST',
				url: topH,
				data: {top4Topicos: top4Topicos, comunidade: comunidade},
				cache: false,
				success: function(data){
					$('.top4Topicos').html(data);
				}
			});
		}
<<<<<<< HEAD
		
		// EXIBIR TODOS TOPICOS
		function exibitTodosOsTopicos(){
			let topicos = 'sim';
=======
		exibirTop4Topicos();
		
		// EXIBIR TODOS TOPICOS
		function exibitTodosOsTopicos(){
			var topicos = 'sim';
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			$.ajax({
				type: 'POST',
				url: topH,
				data: {topicos: topicos, comunidade: comunidade},
				cache: false,
				success: function(data){
					$('.areaTopicos').html(data);
					playVideoMouseoverTopico();
					deletarTopico();
				}
			});
		}
<<<<<<< HEAD
=======
		exibitTodosOsTopicos();
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
		
		// autoplay video quando mouse esta encima do topico
		function playVideoMouseoverTopico(){
			_a('.topicoId').forEach(function(valores){
<<<<<<< HEAD
				let id = valores.value;
=======
				var id = valores.value;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
				_('topico'+id).addEventListener('mouseover', function(){
					if(_('topicoVideo'+id))
						_('topicoVideo'+id).play();
				});
				_('topico'+id).addEventListener('mouseleave', function(){
					if(_('topicoVideo'+id))
						_('topicoVideo'+id).pause();
				});
			});
		}
<<<<<<< HEAD
		playVideoMouseoverTopico();
=======
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36

		const fundo = _q('.fundoOpacoPadrao');
		const caixEdit = _('editarComunidadeCaixa');
		const editFoto = _('editarFotoCaixa');
		const editNome = _('editarNomeCaixa');
		const body = _q('body');
		const editDesc = _('editarDescricaoCaixa');
		function exibirEditarComunidade(){
			if(_('trocarFotoComunidade')){
				_('trocarFotoComunidade').addEventListener('click', function(){
					fundo.style.display = 'block';
					caixEdit.style.display = 'block';
					editFoto.style.display = 'block';
					body.style.overflow = 'hidden';
				});
				_('trocarNomeComunidade').addEventListener('click', function(){
					fundo.style.display = 'block';
					caixEdit.style.display = 'block';
					editNome.style.display = 'block';
					body.style.overflow = 'hidden';
				});
				
				$('.trocarDescricaoComunidade').each(function(){
					$(this).click(function(){
						fundo.style.display = 'block';
						caixEdit.style.display = 'block';
						editDesc.style.display = 'block';
						body.style.overflow = 'hidden';
					});
				});

				_('fecharEditarComunidadeCaixa').addEventListener('click', function(){
					fundo.style.display = 'none';
					caixEdit.style.display = 'none';
					editFoto.style.display = 'none';
					editNome.style.display = 'none';
					editDesc.style.display = 'none';
					body.style.overflow = 'auto';
				});
			}
		}
		exibirEditarComunidade();

		function exibirPrevImagemCom(){
			$('#arquivoEditarFoto').change(function(){
				if(this.files && this.files[0]){
<<<<<<< HEAD
					let imagem = this.files[0];
					let exibImag = new FileReader();
=======
					var imagem = this.files[0];
					var exibImag = new FileReader();
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
					exibImag.onload = function(e){
						$('#editFotoComunNovaPrev').attr('src', e.target.result);
					}
					exibImag.readAsDataURL(imagem);
				}
			});
		}
		exibirPrevImagemCom();

		function trocarFotoComunidade(){
			if(_('trocarFotoComunidadeBotao')){
				_('trocarFotoComunidadeBotao').addEventListener('click', function(){
<<<<<<< HEAD
					let arquivo = _('arquivoEditarFoto').files;
					let form = _('trocarFotoComForm');
					let fd = new FormData(form);
					fd.append('arquivoEditarFoto', arquivo);
					if(arquivo.length > 0){
						let ajax = new XMLHttpRequest();
=======
					var arquivo = _('arquivoEditarFoto').files;
					var form = _('trocarFotoComForm');
					var fd = new FormData(form);
					fd.append('arquivoEditarFoto', arquivo);
					if(arquivo.length > 0){
						var ajax = new XMLHttpRequest();
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
						ajax.onreadystatechange = function(evt){
							if(ajax.readyState === 4 && ajax.status === 200){
								exibirFotoNomeDescricaoComunidade();
								_('editFotoComunNovaPrev').src = '';
								_('arquivoEditarFoto').value = '';
								_('mensagemEditarComunidadeDiv').innerHTML = this.responseText;
								_('mensagemErroEditarComunidadeDiv').style.display = 'block';
								_('fundoOpacoMensagemEditarComunidadeErro').style.display = 'block';
								_q('body').style.overflow = 'hidden';
							}
						}
						ajax.open('POST', comH);
						ajax.send(fd);
					}else
						console.log('sem arquivo');
				});
			}
		}
		trocarFotoComunidade();

		function trocarNomeComunidade(){
			$('#trocarNomeComunidadeBotao').click(function(){
				$.ajax({
					type: 'POST',
					url: comH,
					data: $('#trocarNomeComForm').serialize(),
					cache: false,
					success: function(data){
						exibirFotoNomeDescricaoComunidade();
						_('txtaEditarDescricao').value = '';
						_('mensagemEditarComunidadeDiv').innerHTML = data;
						_('mensagemErroEditarComunidadeDiv').style.display = 'block';
						_('fundoOpacoMensagemEditarComunidadeErro').style.display = 'block';
						_q('body').style.overflow = 'hidden';
					}
				});
			});
		}
		trocarNomeComunidade();

		function trocarDescricaoComunidade(){
			$('#trocarDescricaoComunidadeBotao').click(function(){
				$.ajax({
					type: 'POST',
					url: comH,
					data: $('#trocarDescricaoComForm').serialize(),
					cache: false,
					success: function(data){
						exibirFotoNomeDescricaoComunidade();
						_('inputEditarNome').value = '';
						_('mensagemEditarComunidadeDiv').innerHTML = data;
						_('mensagemErroEditarComunidadeDiv').style.display = 'block';
						_('fundoOpacoMensagemEditarComunidadeErro').style.display = 'block';
						_q('body').style.overflow = 'hidden';
					}
				});
			});
		}
		trocarDescricaoComunidade();

		function fecharEditarComunidadeMes(){
			if(_('fecharEditarComunidadeMes')){
				_('fecharEditarComunidadeMes').addEventListener('click',function(){
					_('mensagemErroEditarComunidadeDiv').style.display = 'none';
					_('fundoOpacoMensagemEditarComunidadeErro').style.display = 'none';
					_q('body').style.overflow = 'auto';
				});
			}
		}
		fecharEditarComunidadeMes();

		function contadorEditTamanhoComunidadeTituloEDescricao(){
			$('#inputEditarNome').on('change paste keyup', function(){
<<<<<<< HEAD
				let nomTamanho = $('#inputEditarNome').val();
=======
				var nomTamanho = $('#inputEditarNome').val();
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
				$('.editNomeComunidadeContador').html('<small>Caracteres: '+(nomTamanho.length)+'</small>');
			});
	
			$('#txtaEditarDescricao').on('change paste keyup', function(){
<<<<<<< HEAD
				let desTamanho = $('#txtaEditarDescricao').val();
=======
				var desTamanho = $('#txtaEditarDescricao').val();
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
				$('.editDescricaoComunidadeContador').html('<small>Caracteres: '+(desTamanho.length)+'</small>');
			});
		}
		contadorEditTamanhoComunidadeTituloEDescricao();

		function exibirFotoComunidade(){
<<<<<<< HEAD
			let exibirFoto = 'sim';
=======
			var exibirFoto = 'sim';
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			$.ajax({
				type: 'POST',
				url: comH,
				data: {exibirFoto: exibirFoto, comunidade: comunidade},
				cache: false,
				success: function(data){
					$('#imagemComunidade').html("<img src='"+data+"'>");
					$('.editFotoComunRecente').html("<img src='"+data+"'>");
				}
			});
		}
<<<<<<< HEAD

		function exibirNomeComunidade(){
			let exibirNome = 'sim';
=======
		exibirFotoComunidade();

		function exibirNomeComunidade(){
			var exibirNome = 'sim';
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			$.ajax({
				type: 'POST',
				url: comH,
				data: {exibirNome: exibirNome, comunidade: comunidade},
				cache: false,
				success: function(data){
					$('#nomeComunidade').html(data);
					$('#inputEditarNome').val(data);
				}
			});
		}
<<<<<<< HEAD

		function exibirDescricaoComunidade(){
			let exibirDescricao = 'sim';
=======
		exibirNomeComunidade();

		function exibirDescricaoComunidade(){
			var exibirDescricao = 'sim';
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
			$.ajax({
				type: 'POST',
				url: comH,
				data: {exibirDescricao: exibirDescricao, comunidade: comunidade},
				cache: false,
				success: function(data){
					$('#descricaoComunidadeP').html(data);
					$('#txtaEditarDescricao').val(data);
				}
			});
		}
<<<<<<< HEAD
=======
		exibirDescricaoComunidade();
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36

		function exibirFotoNomeDescricaoComunidade(){
			exibirFotoComunidade();
			exibirNomeComunidade();
			exibirDescricaoComunidade();
		}

		function exibirPesquisaTopico(){
			if(_('pesquisaTop')){
<<<<<<< HEAD
				let pesquisaTop = _('pesquisaTop').value;
=======
				var pesquisaTop = _('pesquisaTop').value;
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
				$.ajax({
					type: 'POST',
					url: pesH,
					data: {pesquisaTop: pesquisaTop, comunidade: comunidade},
					cache: false,
					success: function(data){
						$('.topicosPesquisa').html(data);
						playVideoMouseoverTopico();
						deletarTopico();
					}
				});
			}
		}
		exibirPesquisaTopico();
	}
});