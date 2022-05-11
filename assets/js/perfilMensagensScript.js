$(document).ready(function(){
	const mensH = 'includes/handlers/mensagemHandler.php';
    if(_('chatBotao')){
		_('chatBotao').addEventListener('click', function(e){
			e.preventDefault();
			let fd = new FormData(_('chatForm'));
			let xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function(){
				if(xhr.readyState == 4 && xhr.status == 200){
					_('mensagemTextarea').value = '';
				}
			}
			xhr.open('POST', mensH);
			xhr.send(fd);
		});
	}

	if(_('logUsChat')){
		setInterval(function(){
			let fd = new FormData();
			fd.append('logUsuario', _('logUsChat').value);
			fd.append('usuario', _('getUChat').value);
			let xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function(){
				if(xhr.readyState == 4 && xhr.status == 200)
					_('chatCaixaMens').innerHTML = this.responseText;
			}
			xhr.open('POST', mensH);
			xhr.send(fd);
		},1000);
	}
});