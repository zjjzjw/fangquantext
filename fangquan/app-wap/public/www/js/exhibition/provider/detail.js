define([
    'zepto'
], function ($) {
    'use strict';
    //企业介绍查看全部
    var $commDesc = $('.summary');
    var $openCommDesc = $('.open-comm-desc');
    var $closeCommDesc = $('.close-comm-desc');
    var $commDescStr = $commDesc.html();
    if ($commDescStr.length > 100) {
        $openCommDesc.show();
        $closeCommDesc.hide();
        $commDesc.html($commDescStr.substring(0, 100) + '...');
        $openCommDesc.show();
        $openCommDesc.click(function () {
            $commDesc.html($commDescStr);
            $openCommDesc.hide();
            $closeCommDesc.show();
        });
        $closeCommDesc.click(function () {
            $commDesc.html($commDescStr.substring(0, 100) + '...');
            $closeCommDesc.hide();
            $openCommDesc.show();
        });
    } else {
        $openCommDesc.hide();
        $closeCommDesc.hide();
    }
});

