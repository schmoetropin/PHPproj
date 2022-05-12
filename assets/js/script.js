function _(e){
	return document.getElementById(e);
}

function _q(e){
	return document.querySelector(e);
}

function _a(e){
	return document.querySelectorAll(e);
}
<<<<<<< HEAD

if(_('enviarEmailIcone')){
	_('enviarEmailIcone').addEventListener('click', function(){
		if(_('enviarEmailDiv').style.display == 'block')
			_('enviarEmailDiv').style.display = 'none';
		else
			_('enviarEmailDiv').style.display = 'block';
	});
}

if(_('copiarEmailDeContato')){
	_('copiarEmailDeContato').addEventListener('click', function(){
		let email = _('emailDeContato');
		email.select();
		email.setSelectionRange(0,30);
		navigator.clipboard.writeText(email.value);
		_('copiarEmailMens').innerHTML = 'Email copiado!';
	});
	_('copiarEmailDeContato').addEventListener('mouseover', function(){
		_('copiarEmailMens').style.display = 'block';
	});
	_('copiarEmailDeContato').addEventListener('mouseleave', function(){
		_('copiarEmailMens').style.display = 'none';
		_('copiarEmailMens').innerHTML = 'Copiar email';
	});
}
=======
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
