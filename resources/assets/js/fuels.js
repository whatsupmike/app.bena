/**
 * Created by michaldrzewiecki on 26.06.2017.
 */

function calculateFuelValue() {
    var quantity = strToFloat($('#fuel-quantity').val());
    var fuelValue = strToFloat($('#fuel-value').val());

    if (quantity != 0 && fuelValue != 0) {
        $('#fuel-price').html(floatToStr(fuelValue/quantity) + " zł / l");
    }

}

$(document).ready(function () {
    $('#fuel-quantity').on('change', function () {
        calculateFuelValue();
    });
    $('#fuel-value').on('change', function () {
        calculateFuelValue();
    });

    $('#fuel-create-form').on('submit', function (event) {
        event.preventDefault(); //this will prevent the default submit
        var quantity = strToFloat($('#fuel-quantity').val());
        var fuelValue = strToFloat($('#fuel-value').val());

        $('#fuel-quantity').val(quantity);
        $('#fuel-value').val(fuelValue);

        $(this).unbind('submit').submit(); // continue the submit unbind preventDefault
    });
});