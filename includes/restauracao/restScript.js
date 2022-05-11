$(document).ready(function(){
    $('.restauracaoVaziaBotao').click(function(){
        let restaurar = '0';
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
        let restaurar = '1';
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