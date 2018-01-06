$(function () {
    var Swiper = require('../../../component/swiper');
    //大图轮播
    var mySwiper = new Swiper('.swiper-container', {
        autoplay: 2000,
        speed: 5000,
        loop: true
    });
});