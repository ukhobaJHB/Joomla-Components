jQuery(function() {
    document.formvalidator.setHandler('greeting', function (value) {
        regex=/^[^0-9]+$/;
        return regex.test(value);
    });

    document.formvalidator.setHandler('pdate', function (value) {
        regex=/^[^0-9]+$/;
        return regex.test(value);
    });
});