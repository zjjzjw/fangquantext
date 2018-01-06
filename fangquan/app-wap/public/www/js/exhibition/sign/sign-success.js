define([
    'zepto',
    'wx'
], function ($, wx) {
    'use strict';

    $('.btn-box').click(function () {
        WeixinJSBridge.call('closeWindow');
    });
});