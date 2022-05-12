$(document).ready(function(){
    $('.restauracaoVaziaBotao').click(function(){
<<<<<<< HEAD
        let restaurar = '0';
=======
        var restaurar = '0';
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
        $.ajax({
            type: 'POST',
            url: 'includes/restauracao/restHandler.php',
            data: {restaurar: restaurar},
            cache: false,
            success: function(data){
               window.location.href = 'index.php';
               console.log(data);
            }
        });
    });
    
    $('.restauracaoBotao1').click(function(){
<<<<<<< HEAD
        let restaurar = '1';
=======
        var restaurar = '1';
>>>>>>> aae9fa4188d917c0d2296f2cef7d8ff6d96d3f36
        $.ajax({
            type: 'POST',
            url: 'includes/restauracao/restHandler.php',
            data: {restaurar: restaurar},
            cache: false,
            success: function(data){
               window.location.href = 'index.php';
               console.log(data);
            }
        });
    });
});