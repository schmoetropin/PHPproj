function perfilMenuTopoAltRes(){
    if(_('btSobre')){
        _('btSobre').addEventListener('click', function(){
            _q('.cSobre').style.display = 'block';
            _q('.cPosts').style.display = 'none';
            _q('.cTopicos').style.display = 'none';	
            _q('.cAmigos').style.display = 'none';
            _q('.cMensagens').style.display = 'none';
            _q('.cRequerimento').style.display = 'none';

            _('btSobre').style.backgroundColor = '#1A237E';
            _('btTopicos').style.backgroundColor = '';
            _('btPosts').style.backgroundColor = '';
            _('btAmigos').style.backgroundColor = '';
            _('btMensagens').style.backgroundColor = '';
            _('btRequerimento').style.backgroundColor = '';
        });

        _('btTopicos').addEventListener('click', function(){
            _q('.cSobre').style.display = 'none';
            _q('.cPosts').style.display = 'none';
            _q('.cTopicos').style.display = 'block';	
            _q('.cAmigos').style.display = 'none';
            _q('.cMensagens').style.display = 'none';
            _q('.cRequerimento').style.display = 'none';

            _('btSobre').style.backgroundColor = '';
            _('btTopicos').style.backgroundColor = '#1A237E';
            _('btPosts').style.backgroundColor = '';
            _('btAmigos').style.backgroundColor = '';
            _('btMensagens').style.backgroundColor = '';
            _('btRequerimento').style.backgroundColor = '';
        });
        _('btPosts').addEventListener('click', function(){
            _q('.cSobre').style.display = 'none';
            _q('.cPosts').style.display = 'block';
            _q('.cTopicos').style.display = 'none';	
            _q('.cAmigos').style.display = 'none';
            _q('.cMensagens').style.display = 'none';
            _q('.cRequerimento').style.display = 'none';

            _('btSobre').style.backgroundColor = '';
            _('btTopicos').style.backgroundColor = '';
            _('btPosts').style.backgroundColor = '#1A237E';
            _('btAmigos').style.backgroundColor = '';
            _('btMensagens').style.backgroundColor = '';
            _('btRequerimento').style.backgroundColor = '';
        });
        _('btAmigos').addEventListener('click', function(){
            _q('.cSobre').style.display = 'none';
            _q('.cPosts').style.display = 'none';
            _q('.cTopicos').style.display = 'none';	
            _q('.cAmigos').style.display = 'block';
            _q('.cMensagens').style.display = 'none';
            _q('.cRequerimento').style.display = 'none';

            _('btSobre').style.backgroundColor = '';
            _('btTopicos').style.backgroundColor = '';
            _('btPosts').style.backgroundColor = '';
            _('btAmigos').style.backgroundColor = '#1A237E';
            _('btMensagens').style.backgroundColor = '';
            _('btRequerimento').style.backgroundColor = '';
        });
        _('btMensagens').addEventListener('click', function(){
            _q('.cSobre').style.display = 'none';
            _q('.cPosts').style.display = 'none';
            _q('.cTopicos').style.display = 'none';	
            _q('.cAmigos').style.display = 'none';
            _q('.cMensagens').style.display = 'block';
            _q('.cRequerimento').style.display = 'none';

            _('btSobre').style.backgroundColor = '';
            _('btTopicos').style.backgroundColor = '';
            _('btPosts').style.backgroundColor = '';
            _('btAmigos').style.backgroundColor = '';
            _('btMensagens').style.backgroundColor = '#1A237E';
            _('btRequerimento').style.backgroundColor = '';
        });
        _('btRequerimento').addEventListener('click', function(){
            _q('.cSobre').style.display = 'none';
            _q('.cPosts').style.display = 'none';
            _q('.cTopicos').style.display = 'none';	
            _q('.cAmigos').style.display = 'none';
            _q('.cMensagens').style.display = 'none';
            _q('.cRequerimento').style.display = 'block';

            _('btSobre').style.backgroundColor = '';
            _('btTopicos').style.backgroundColor = '';
            _('btPosts').style.backgroundColor = '';
            _('btAmigos').style.backgroundColor = '';
            _('btMensagens').style.backgroundColor = '';
            _('btRequerimento').style.backgroundColor = '#1A237E';
        });
    }
}
perfilMenuTopoAltRes();

function perfilMenuTopoBaixRes(){
    if(_('brSobre')){
        _('brSobre').addEventListener('click', function(){
            _q('.cSobre').style.display = 'block';
            _q('.cPosts').style.display = 'none';
            _q('.cTopicos').style.display = 'none';	
            _q('.cAmigos').style.display = 'none';
            _q('.cMensagens').style.display = 'none';
            _q('.cRequerimento').style.display = 'none';

            _('brSobre').style.backgroundColor = '#DCDCDC';
            _('brTopicos').style.backgroundColor = 'transparent';
            _('brPosts').style.backgroundColor = 'transparent';
            _('brAmigos').style.backgroundColor = 'transparent';
            _('brMensagens').style.backgroundColor = 'transparent';
            _('brRequerimento').style.backgroundColor = 'transparent';
        });

        _('brTopicos').addEventListener('click', function(){
            _q('.cSobre').style.display = 'none';
            _q('.cPosts').style.display = 'none';
            _q('.cTopicos').style.display = 'block';	
            _q('.cAmigos').style.display = 'none';
            _q('.cMensagens').style.display = 'none';
            _q('.cRequerimento').style.display = 'none';

            _('brSobre').style.backgroundColor = 'transparent';
            _('brTopicos').style.backgroundColor = '#DCDCDC';
            _('brPosts').style.backgroundColor = 'transparent';
            _('brAmigos').style.backgroundColor = 'transparent';
            _('brMensagens').style.backgroundColor = 'transparent';
            _('brRequerimento').style.backgroundColor = 'transparent';
        });
        _('brPosts').addEventListener('click', function(){
            _q('.cSobre').style.display = 'none';
            _q('.cPosts').style.display = 'block';
            _q('.cTopicos').style.display = 'none';	
            _q('.cAmigos').style.display = 'none';
            _q('.cMensagens').style.display = 'none';
            _q('.cRequerimento').style.display = 'none';

            _('brSobre').style.backgroundColor = 'transparent';
            _('brTopicos').style.backgroundColor = 'transparent';
            _('brPosts').style.backgroundColor = '#DCDCDC';
            _('brAmigos').style.backgroundColor = 'transparent';
            _('brMensagens').style.backgroundColor = 'transparent';
            _('brRequerimento').style.backgroundColor = 'transparent';
        });
        _('brAmigos').addEventListener('click', function(){
            _q('.cSobre').style.display = 'none';
            _q('.cPosts').style.display = 'none';
            _q('.cTopicos').style.display = 'none';	
            _q('.cAmigos').style.display = 'block';
            _q('.cMensagens').style.display = 'none';
            _q('.cRequerimento').style.display = 'none';

            _('brSobre').style.backgroundColor = 'transparent';
            _('brTopicos').style.backgroundColor = 'transparent';
            _('brPosts').style.backgroundColor = 'transparent';
            _('brAmigos').style.backgroundColor = '#DCDCDC';
            _('brMensagens').style.backgroundColor = 'transparent';
            _('brRequerimento').style.backgroundColor = 'transparent';
        });
        _('brMensagens').addEventListener('click', function(){
            _q('.cSobre').style.display = 'none';
            _q('.cPosts').style.display = 'none';
            _q('.cTopicos').style.display = 'none';	
            _q('.cAmigos').style.display = 'none';
            _q('.cMensagens').style.display = 'block';
            _q('.cRequerimento').style.display = 'none';

            _('brSobre').style.backgroundColor = 'transparent';
            _('brTopicos').style.backgroundColor = 'transparent';
            _('brPosts').style.backgroundColor = 'transparent';
            _('brAmigos').style.backgroundColor = 'transparent';
            _('brMensagens').style.backgroundColor = '#DCDCDC';
            _('brRequerimento').style.backgroundColor = 'transparent';
        });
        _('brRequerimento').addEventListener('click', function(){
            _q('.cSobre').style.display = 'none';
            _q('.cPosts').style.display = 'none';
            _q('.cTopicos').style.display = 'none';	
            _q('.cAmigos').style.display = 'none';
            _q('.cMensagens').style.display = 'none';
            _q('.cRequerimento').style.display = 'block';

            _('brSobre').style.backgroundColor = 'transparent';
            _('brTopicos').style.backgroundColor = 'transparent';
            _('brPosts').style.backgroundColor = 'transparent';
            _('brAmigos').style.backgroundColor = 'transparent';
            _('brMensagens').style.backgroundColor = 'transparent';
            _('brRequerimento').style.backgroundColor = '#DCDCDC';
        });
    }
}
perfilMenuTopoBaixRes();

if(_q('.cPosts')){
    _q('.cPosts').style.display = 'block';
    _('btPosts').style.backgroundColor = '#1A237E';
}

if(_('baixResBotao')){
    _('baixResBotao').addEventListener('click', function(){
        if(_('baixResMenu').style.display == 'block')
            _('baixResMenu').style.display = 'none';
        else
        _('baixResMenu').style.display = 'block';
    });
}