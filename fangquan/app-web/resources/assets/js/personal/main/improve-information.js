$(function () {
    var Area = require('../../../component/area');

    $.validate({
        form: '.form-horizontal',
        validateOnBlur: false,
        onSuccess: function ($form) {
            moreValidate();
            return false;
        }
    });

    function moreValidate() {

    }

    //地址
    var area = new Area({'idNames': ['province_id', 'city_id'], 'data': $.params.areas});
    area.selectedId($.params.province_id, $.params.city_id);


    function showError(data) {
        var info = '';
        var messages = [];
        var i = 0;
        for (var key in data) {
            messages.push(++i + "、" + data[key][0]);
        }
        info = messages.join('</br>');
        return info;
    }
});