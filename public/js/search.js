
$(function(){

//Живой поиск
    $('.who').bind("change keyup input click", function() {
        if(this.value.length >= 2){
              $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

                $.ajax({
                    type: 'POST',
                    url: '/searchtag', //Путь к обработчику
                    data: {'referal':$(this).val()},
                    dataType:'text',
                    response: 'text',
                    success: function(data){
                          $(".search_result").html(data).fadeIn(); //Выводим полученые данные в списке
                    },
                error: function () {
                    $('#senderror').show();
                    $('#sendmessage').hide();
                }
            });

        }
    })

    $(".search_result").hover(function(){
        $(".who").blur(); //Убираем фокус с input
    })

})
