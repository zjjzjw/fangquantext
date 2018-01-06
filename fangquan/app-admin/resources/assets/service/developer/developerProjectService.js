module.exports = (function () {

    var _store = function store(opts) {
        $.http({
            type: 'POST',
            url: '/api/developer/developer-project/store/' + opts.params.id,
            data: opts.data,
            dataType: 'json',
            beforeSend: opts.beforeSend,
            success: opts.sucFn,
            error: opts.errFn
        });
    };

    var _update = function update(opts) {
        $.http({
            type: 'POST',
            url: '/api/developer/developer-project/update/' + opts.params.id,
            data: opts.data,
            dataType: 'json',
            beforeSend: opts.beforeSend,
            success: opts.sucFn,
            error: opts.errFn
        });
    };

    var _delete = function (opts) {
        $.http({
            type: 'POST',
            dataType: 'json',
            url: '/api/developer/developer-project/delete/' + opts.data.id,
            data: opts.data,
            success: opts.sucFn,
            error: opts.errFn
        });
    };

    var _getKeyword = function (oData) {

        $.http({
            type: 'POST',
            dataType: 'json',
            url: '/api/centrally-purchases/centrally-purchases/keyword',
            data: oData.data,
            success: oData.success,
            error: oData.error
        });
    };

    return {
        store: _store,
        update: _update,
        delete: _delete,
        getKeyword: _getKeyword
    };
})();