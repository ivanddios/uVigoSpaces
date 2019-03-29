$(document).ready(function(){

    $('#date-es').bootstrapMaterialDatePicker
    ({
        format: 'DD/MM/YYYY',
        lang: 'es',
        time: false,
        weekStart: 1, 
        nowButton : true,
        switchOnClick : true,
        maxDate : new Date(),
    });

    $('#date-eng').bootstrapMaterialDatePicker
    ({
        format: 'DD/MM/YYYY',
        time: false,
        weekStart: 1, 
        nowButton : true,
        switchOnClick : true,
        maxDate : new Date()
    });

});