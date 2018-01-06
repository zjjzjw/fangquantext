/**
 * Created by maciej on 2017/11/23.
 */
define([
    'zepto',
    'page.params'
], function ($, params) {
    var width = window.innerWidth - 20;
    var height = parseInt(width / 16) * 9;

    $('.broadcast').css('width', width + 'px');
    $('#iframe').css('width', width + 'px');
    $('#iframe').css('height', height + 'px');

});