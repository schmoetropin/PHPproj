const reLoH = 'includes/handlers/regLogHandler.php';
// limpar barra de pesquisa
if(_('limparBarraPesquisa')){
	_('limparBarraPesquisa').addEventListener('click', function(){
			_('barraDePerquisa').value = '';
			_('barraDePerquisa').focus();
	});
}

// esconder barra topo
if(_('botaoEsconderBarraTopo')){
	_('botaoEsconderBarraTopo').addEventListener('click', function(){
		function exibirBarraTopo(){
			_('barraTopo').style.display = 'none';
			_('botaoExibirBarraTopo').style.display = 'block';
			if(_q('.siteTopoInferirorLimite'))
				_q('.siteTopoInferirorLimite').style.marginTop = '45px';
			if(_q('.barraTopoPerfil')){
				_q('.barraTopoPerfil').style.top = '215px';
				_q('.conteudoPerfil').style.top = '215px';
			}
			
			if(_('trocarFotoComunidade'))
				_('trocarFotoComunidade').style.top = '51px';
			if(_('trocarNomeComunidade'))
				_('trocarNomeComunidade').style.top = '110px';

			if(_q('.inscreverCriarTopicoResBaixa'))
				_q('.inscreverCriarTopicoResBaixa').style.top = '18px';
			
			if(_q('.imagemComunidade'))
				_q('.imagemComunidade').style.top = '84px';
			if(_('nomeComunidade'))
				_('nomeComunidade').style.top = '135px';
			
			_('caixaLogin').style.display = 'none';
		}
		exibirBarraTopo();
		
		if(_('esconderBarraTopo')){
			var form = _('esconderBarraTopo');		
			var ajax = new XMLHttpRequest();
			var fd = new FormData(form);
		
			ajax.addEventListener('load', function(){
			}, false);
		
			ajax.addEventListener('abort', function(){
				console.log('abort');
			}, false);
		
			ajax.addEventListener('error', function(){
				console.log('error');
			}, false);
			ajax.open('POST', reLoH);
			ajax.send(fd);
		}
	});
}

// exibir barra topo
if(_('botaoExibirBarraTopo')){
	_('botaoExibirBarraTopo').addEventListener('click', function(){
		function exibirBarraTopo(){
			_('barraTopo').style.display = 'block';
			_('botaoExibirBarraTopo').style.display = 'none';
			if(_q('.siteTopoInferirorLimite'))
				_q('.siteTopoInferirorLimite').style.marginTop = '80px';
			
			if(_q('.barraTopoPerfil')){
				_q('.barraTopoPerfil').style.top = '250px';
				_q('.conteudoPerfil').style.top = '250px';
			}

			if(_('trocarFotoComunidade'))
				_('trocarFotoComunidade').style.top = '86px';
			if(_('trocarNomeComunidade'))
				_('trocarNomeComunidade').style.top = '145px';

			if(_q('.inscreverCriarTopicoResBaixa'))
				_q('.inscreverCriarTopicoResBaixa').style.top = '49px';

			if(_q('.imagemComunidade'))
				_q('.imagemComunidade').style.top = '120px';
			if(_('nomeComunidade'))
				_('nomeComunidade').style.top = '170px';
		}
		exibirBarraTopo();
		
		if(_('exibirBarraTopo')){	
			var form = _('exibirBarraTopo');		
			var ajax = new XMLHttpRequest();
			var fd = new FormData(form);
		
			ajax.addEventListener('load', function(){
			}, false);
		
			ajax.addEventListener('abort', function(){
				console.log('abort');
			}, false);
		
			ajax.addEventListener('error', function(){
				console.log('error');
			}, false);
			ajax.open('POST', reLoH);
			ajax.send(fd);
		}
	});
}

// exibe e esconde icones
_('botaoMenuUlBarraTopo').addEventListener('click', function(){
	if(_('baixaResolucaoUlBarraTopo').style.display == 'block')
		_('baixaResolucaoUlBarraTopo').style.display = 'none';
	else
		_('baixaResolucaoUlBarraTopo').style.display = 'block';
	_('caixaLogin').style.display = 'none'
});