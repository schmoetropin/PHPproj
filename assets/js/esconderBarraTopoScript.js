function esconderBarraTopo(){
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
esconderBarraTopo();
