function ExibirBarraTopo(){
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
ExibirBarraTopo();
