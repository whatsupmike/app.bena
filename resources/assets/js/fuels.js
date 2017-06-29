/**
 * Created by michaldrzewiecki on 26.06.2017.
 */

function calculateFuelValue(){
    var quantity = strToFloat($('#fuel-quantity').val());
    var price = strToFloat($('#fuel-price').val());

    if(quantity != 0 && price != 0){
        $('#fuel-value').html(floatToStr(quantity*price) + " zł");
    }

}

$(document).ready(function () {
    $('#fuel-quantity').on('change', function () {
        calculateFuelValue();
    });
    $('#fuel-price').on('change', function () {
        calculateFuelValue();
    });

    $('#fuel-create-form').on('submit', function (event) {
        event.preventDefault(); //this will prevent the default submit
        var quantity = strToFloat($('#fuel-quantity').val());
        var price = strToFloat($('#fuel-price').val());

        $('#fuel-quantity').val(quantity);
        $('#fuel-price').val(price);

        $(this).unbind('submit').submit(); // continue the submit unbind preventDefault
    });
});