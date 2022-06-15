$(function(){
    $("#pesquisa").keyup(function(){
        //recupera o valor do campo
        var pesquisa = $(this).val();

        //verifica se há algo digitado
        if(pesquisa !=''){
            var dados = {
                palavra : pesquisa
            }
            $.post('proc_cad_presenca_html.php', dados, function(retorna){
                //mostra dentro da ul os resultados obtidos
                $(".resultado").html(retorna);
            });
        }
    });

});