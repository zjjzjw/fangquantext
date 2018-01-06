$(function () {
    require('../../../component/exhibition-header');

    //企业介绍查看全部
    var $commDesc = $('.summary');
    var $openCommDesc = $('.open-comm-desc');
    var $commDescStr = $commDesc.html();
    if ($commDescStr.length > 255) {
        $openCommDesc.show();
        $commDesc.html($commDescStr.substring(0, 255) + '...');
        $openCommDesc.show();
        $openCommDesc.click(function () {
            $commDesc.html($commDescStr);
            $openCommDesc.hide();
            $('.pack-up').show();
        });
    } else {
        $openCommDesc.hide();
    }

    //收起
    $('.pack-up').click(function () {
        $openCommDesc.show();
        $commDesc.html($commDescStr.substring(0, 255) + '...');
        $openCommDesc.show();
        $('.pack-up').hide();
    })
});