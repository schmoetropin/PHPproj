$(document).ready(function(){
	const topH = 'includes/handlers/topicoHandler.php';
	const inscH = 'includes/handlers/inscreverHandler.php';
	const postH = 'includes/handlers/postHandler.php';
	const likeH = 'includes/handlers/likeHandler.php';
	if(_('topicoPaginaId'))
		var topicoId = _('topicoPaginaId').value;
	// exibe topico principal
	function exibirTopico(){
		var exibirTopico = 'sim';
		$.ajax({
			type: 'POST',
			url: topH,
			data: {exibirTopico: exibirTopico, topicoId: topicoId},
			cache: false,
			success: function(data){
				$('.paginaTopicoPrincipal').html(data);
				exibirLikeTopico();
				exibirEditarTopico();
				fecharEditarTopico();
			}
		});
	}
	exibirTopico();

	// exibe caixa editar topico
	function exibirEditarTopico(){
		$('#editarTopico').click(function(){
			$('.fundoOpacoPadrao').show();
			$('.editarTopico').show();
			_q('body').style.overflow = 'hidden';
		});
	}

	// fecha caixa editar topico
	function fecharEditarTopico(){
		$('#fecharEditarTopico').click(function(){
			$('.fundoOpacoPadrao').hide();
			$('.editarTopico').hide();
			_q('body').style.overflow = 'auto';
		});
	}

	//exibe dados de edicao topico
	function exibirDadosEditarTopico(){
		if(_('topPagId')){
			var topico = _('topPagId').value;
			//titulo
			$.ajax({
				type: 'POST',
				url: topH,
				data: { tituloTopicoEdit: topico},
				cache: false,
				success: function(data){
					$('#editarTitulo').val(data);
					_q('.contadorEditarTopicoTitulo').innerHTML = '';
				}
			});

			// midia ou arquivo
			$.ajax({
				type: 'POST',
				url: topH,
				data: { arquivoTopicoEdit: topico},
				cache: false,
				success: function(data){
					$('.visualizacaoMidiaOrig').html(data);
				}
			});

			//conteudo
			$.ajax({
				type: 'POST',
				url: topH,
				data: { conteudoTopicoEdit: topico},
				cache: false,
				success: function(data){
					$('#editarConteudo').val(data);
				}
			});
		}
	}
	exibirDadosEditarTopico();

	// edita topico
	function editarTituloTopico(){
		$('#editarTituloTopicoBotao').click(function(){
			$.ajax({
				type: 'POST',
				url: topH,
				data: $('#editarTituloTopico').serialize(),
				cache: false,
				success: function(data){
					_('mensagemErroDivEditarTopico').style.display='block';
					_('fundoOpacoMensagemErroEditarTopico').style.display='block';
					_q('body').style.overflow='hidden';
					_('editarTopicoMensagem').innerHTML = data;
					exibirTopico();
				}
			});
		});
	}
	editarTituloTopico();

	function editarMidiaTopico(){
		if(_('editarMidiaTopicoBotao')){
			_('editarMidiaTopicoBotao').addEventListener('click', function(e){
				e.preventDefault();
				var fd = new FormData(_('editarMidiaTopico'));
				var arquivo;
				if(_('topicoUpload').files && _('topicoUpload').files[0]){
					arquivo = _('topicoUpload').files[0];
					if(arquivo.length > 0)
						fd.append('editarArquivo', arquivo);
				}
				var ajax = new XMLHttpRequest();
				ajax.onreadystatechange = function(evt){
					if(ajax.readyState === 4 && ajax.status === 200){
						exibirTopico();
						exibirDadosEditarTopico();
						_q('.previsualizacaoMidia').innerHTML = '';
						_q('.manterMidiaForm').checked = 'true';
						_('topicoUpload').value = '';
						_('mensagemErroDivEditarTopico').style.display='block';
						_('fundoOpacoMensagemErroEditarTopico').style.display='block';
						_q('body').style.overflow='hidden';
						_('editarTopicoMensagem').innerHTML = this.responseText;
					}
				}
				ajax.open('POST', topH);
				ajax.send(fd);
			});
		}
	}
	editarMidiaTopico();

	function editarConteudoTopico(){
		$('#editarConteudoTopicoBotao').click(function(){	
			$.ajax({
				type: 'POST',
				url: topH,
				data: $('#editarConteudoTopico').serialize(),
				cache: false,
				success: function(data){
					_('mensagemErroDivEditarTopico').style.display='block';
					_('fundoOpacoMensagemErroEditarTopico').style.display='block';
					_q('body').style.overflow='hidden';
					_('editarTopicoMensagem').innerHTML = data;
					_q('.contadorEditarTopicoConteudo').innerHTML = '';
					exibirTopico();
				}
			});
		});
	}
	editarConteudoTopico();

	function fecharEditarTopicoMes(){
		if(_('fecharEditarTopicoMes')){
			_('fecharEditarTopicoMes').addEventListener('click', function(){
				_('mensagemErroDivEditarTopico').style.display='none';
				_('fundoOpacoMensagemErroEditarTopico').style.display='none';
				_q('body').style.overflow='auto';
			});
		}
	}
	fecharEditarTopicoMes();
	
	function contadorEditarTopico(){
		$('#editarTitulo').on('paste change keyup', function(){
			var valor = $('#editarTitulo').val();
			$('.contadorEditarTopicoTitulo').html('<small>Caracteres: '+valor.length+'</small>');
		});
		$('#editarConteudo').on('paste change keyup', function(){
			var valor = $('#editarConteudo').val();
			$('.contadorEditarTopicoConteudo').html('<small>Caracteres: '+valor.length+'</small>');
		});
	}
	contadorEditarTopico();

	// exibir botao de inscricao
	function exibirInscreverBotao(){
		if(_('noTopico')){
			var topico = _('noTopico').value;
			$.ajax({
				type: 'POST',
				url: inscH,
				data: {topico: topico},
				cache: false,
				success: function(data){
					$('#inscreverComunidadeTopico').html(data);
					inscreverDesinscreverCom();
				}
			});
		}
	}
	exibirInscreverBotao();
	
	// inscrever desiscrever comunidade
	function inscreverDesinscreverCom(){
		$('#inscreverComunidadeBotao').click(function(){
			$.ajax({
				type: 'POST',
				url: inscH,
				data: $('#inscreverForm').serialize(),
				cache: false,
				success: function(data){
					$('#inscreverComunidadeTopico').html(data);
					exibirInscreverBotao();
				}
			});
		}); 
	}

	// posta no topico
	$('#postarComentario').click(function(){
		$.ajax({
			url: postH,
			type: 'POST',
			data: $('#postForm').serialize(),
			cache: false,
			success: function(data){
				$('.contadorConteudoPost').html('');
				_('postConteudo').value = '';
				_('mensagemErroPostDiv').style.display = 'block';
				_('fundoOpacoMensagemPost').style.display = 'block';
				_q('body').style.overflow = 'hidden';
				_('mensagemPostDiv').innerHTML = data;
				console.log(data);
				exibirPosts();
			}
		});
	});

	function fecharPostMes(){
		if(_('fecharPostMes')){
			_('fecharPostMes').addEventListener('click',function(){
				_('mensagemErroPostDiv').style.display = 'none';
				_('fundoOpacoMensagemPost').style.display = 'none';
				_q('body').style.overflow = 'auto';
			});
		}
	}
	fecharPostMes();

	function contadorPostPrincipal(){
		$('#postConteudo').on('paste change keyup', function(){
			var valor = $('#postConteudo').val();
			$('.contadorConteudoPost').html('<small>Caracteres: '+valor.length+'</small>');
		});
	}
	contadorPostPrincipal();
	
	// exibe todos posts
	function exibirPosts(){
		if(_('noTopico')){
			var topico = _('noTopico').value;
			var area = 'posts';
			$.ajax({
				url: postH,
				type: 'POST',
				data: {area: area, topico: topico},
				cache: false,
				success: function(data){
					$('.postArea').html(data);
					contadorComentarioPost();
					exibirPostComentarios();
					exibirPostComentarioForm();
					criarComentarioDePost();
					exibirTodosComentariosPost();
					exibirLikePost();
					exibirDelEditPostCaixa();
					fecharDelEditPostCaixa();
					delEditPost();
				}
			});
		}
	}
	exibirPosts();
	
	// exibe esconde comentario area de posts
	function exibirPostComentarios(){
		if(_q('.postId')){
			_a('.postId').forEach(function(valores){
				var id = valores.value;
				_('exibirComentariosPost'+id).addEventListener('click', function(){
					if(_('comentarioPost'+id).style.display == 'block')
						_('comentarioPost'+id).style.display = 'none';
					else
						_('comentarioPost'+id).style.display = 'block';
				});
			});
		}
	}
	
	// exibe esconde formulario para comentar post
	function exibirPostComentarioForm(){
		_a('.postId').forEach(function(valores){
			var id = valores.value;
			if(_('botaoExibirComentarioForm'+id)){
				_('botaoExibirComentarioForm'+id).addEventListener('click', function(){
					if(_('comentarPostArea'+id).style.display == 'block')
						_('comentarPostArea'+id).style.display = 'none';
					else
						_('comentarPostArea'+id).style.display = 'block';
				});
			}
		});
	}
	
	// comenta post
	function criarComentarioDePost(){ 
		_a('.postId').forEach(function(valores){
			var id = valores.value;
			$('#botaoComentarPost'+id).click(function(){
				$.ajax({
					type: 'POST',
					url: postH,
					data: $('#comentarPostForm'+id).serialize(),
					cache: false,
					success: function(data){
						var topico = _('noTopico').value;
						var area = 'posts';
						$.ajax({
							url: postH,
							type: 'POST',
							data: {area: area, topico: topico},
							cache: false,
							success: function(res){
								$('.postArea').html(res);
								contadorComentarioPost();
								exibirPostComentarios();
								exibirPostComentarioForm();
								criarComentarioDePost();
								exibirTodosComentariosPost();
								exibirLikePost();
								exibirDelEditPostCaixa();
								fecharDelEditPostCaixa();
								delEditPost();
								$('#comentarioPost'+id).show();
								_('mensagemErroPostDiv').style.display = 'block';
								_('fundoOpacoMensagemPost').style.display = 'block';
								_q('body').style.overflow = 'hidden';
								_('mensagemPostDiv').innerHTML = data;
							}
						});
					}
				});
			});
		});
	}

	function contadorComentarioPost(){
		$('.postId').each(function(){
			var id = this.value;
			$('#postConteudo'+id).on('change paste keyup', function(){
				var contador = $('#postConteudo'+id).val();
				$('.contadorComentarioPost'+id).html('<small>Caracteres: '+contador.length+'</small>');
			});
		});
	}

	// exibe todos os comentarios de post
	function exibirTodosComentariosPost(){
		_a('.postIdHidden').forEach(function(valores){
			var postComentario = valores.value;
			var topico = _('topicoIdHidden'+postComentario).value;
			$.ajax({
				type: 'POST',
				url: postH,
				data: {postComentario: postComentario, topico: topico},
				cache: false,
				success: function(data){
					$('#comentariosDoPost'+postComentario).html(data);
					exibirLikePost();
					exibirDelEditPostCaixa();
					fecharDelEditPostCaixa();
					delEditPost();
				}
			});
		});
	}
	
	// exibe botao like no topico
	function exibirLikeTopico(){
		if(_('topicoNome')){
			var topicoLike = _('topicoNome').value;
			$.ajax({
				url: likeH,
				type: 'POST',
				data: {topicoLike: topicoLike},
				cache: false,
				success: function(data){
					$('#topicoLikeArea').html(data);
					likeUnlikeTopico();
				}
			});
		}
	}
	
	
	// exibe botao like no post
	function exibirLikePost(){
		_a('.postId').forEach(function(valores){
			var postLike = valores.value;
			$.ajax({
				url: likeH,
				type: 'POST',
				data: {postLike: postLike},
				cache: false,
				success: function(data){
					$('#postLikeArea'+postLike).html(data);
					likeUnlikePost(postLike);
				}
			});
		});
	}
	
	// like unlike topico
	function likeUnlikeTopico(){
		if(_q('.likeTopicoId')){
			var id = _q('.likeTopicoId').value;
			$('#likeTopicoBotao'+id).click(function(){
				$.ajax({
					url: likeH,
					type: 'POST',
					data: $('#likeTopicoForm'+id).serialize(),
					cache: false,
					success: function(data){
						$('#topicoLikeArea').html(data);
						exibirLikeTopico();
					}
				});
			});
		}
	}
	
	// like unlike post
	function likeUnlikePost(id){
		$('#likePostBotao'+id).click(function(){
			$.ajax({
				url: likeH,
				type: 'POST',
				data: $('#likePostForm'+id).serialize(),
				cache: false,
				success: function(data){
					$('#postLikeArea'+id).html(data);
					exibirLikePost();
				}
			});
		});
	}
	
	// exibe deletar e editar post
	function exibirDelEditPostCaixa(){
		_a('.postId').forEach(function(valores){
			var id = valores.value;
			$('#delPostBotao'+id).click(function(){
				$('#delPost'+id).show();
				$('.fundoOpacoPadrao').show();
				_q('body').style.overflow = 'hidden';
			});
			$('#editPostBotao'+id).click(function(){
				$('#editPost'+id).show();
				$('.fundoOpacoPadrao').show();
				_q('body').style.overflow = 'hidden';
			});

		});
	}

	// fecha deletar e editar post
	function fecharDelEditPostCaixa(){
		_a('.postId').forEach(function(valores){
			var id = valores.value;
			$('#fecharDelPost'+id).click(function(){
				$('#delPost'+id).hide();
				$('.fundoOpacoPadrao').hide();
				_q('body').style.overflow = 'auto';
			});
			$('#fecharEditPost'+id).click(function(){
				$('#editPost'+id).hide();
				$('.fundoOpacoPadrao').hide();
				_q('body').style.overflow = 'auto';
			});
		});
	}

	// deleta e edita post
	function delEditPost(){
		_a('.postId').forEach(function(valores){
			var id = valores.value;
			$('#editPostFormBotao'+id).click(function(){
				$.ajax({
					type: 'POST',
					url: postH,
					data: $('#editarPostForm'+id).serialize(),
					cache: false,
					success: function(data){
						exibirPosts();
						$('.fundoOpacoPadrao').hide();
						_q('body').style.overflow = 'auto';
						_('mensagemErroPostDiv').style.display = 'block';
						_('fundoOpacoMensagemPost').style.display = 'block';
						_q('body').style.overflow = 'hidden';
						_('mensagemPostDiv').innerHTML = data;
					}
				});
			});

			$('#editarPostTextarea'+id).on('paste change keyup', function(){
				var contador = $('#editarPostTextarea'+id).val();
				$('.editarPostContador'+id).html('<small>Caracteres: '+contador.length+'</small>');
			});

			$('#delPostFormBotao'+id).click(function(){
				$.ajax({
					type: 'POST',
					url: postH,
					data: $('#deletarPostForm'+id).serialize(),
					cache: false,
					success: function(data){
						exibirPosts();
						$('.fundoOpacoPadrao').hide();
						_q('body').style.overflow = 'auto';
					}
				});
			});
		});
	}
});
