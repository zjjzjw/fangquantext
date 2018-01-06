$(function () {
    $(document).on('click', '.special-p', function () {
        if($(this).hasClass('checked')){
            $(this).removeClass('checked').addClass('unchecked');

        }else if($(this).hasClass('unchecked')){
            $(this).removeClass('unchecked').addClass('checked');
        }
    });
    var answer = [];
    $(document).on('click', '.export-btn', function (){
        var check_length = $('.checked').length;
        if(check_length > 0){
            $('.checked').each(function () {
                var ans = $(this).data('id');
                answer.push(ans);
            });

        }
        var result = answer.join();
        window.location.href = '/developer/centrally-purchase/export?ids='+result;
    })
});

