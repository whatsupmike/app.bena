/**
 * Created by michaldrzewiecki on 26.06.2017.
 */

function disableTripSubmitButton(isDisabled) {
    if(isDisabled){
        $('#trip-create-form-submit').attr("disabled", "disabled");
    }
    else{
        $('#trip-create-form-submit').removeAttr("disabled");
    }
}

function calculateDistance() {
    var odometerBefore = $('#odometer-before').data('odometer');
    var odometerAfter = $('#odometer-after').val();
    if ((odometerAfter - odometerBefore) > 0) {
        $('#trip-distance').html((odometerAfter - odometerBefore) + " km");
        disableTripSubmitButton(false);
    }
    else if(odometerAfter != ""){
        disableTripSubmitButton(true);
        alert(Lang.get('trips.js.error.no-negative-trip'));
    }
    else{
        disableTripSubmitButton(true);
    }
}

$(document).ready(function () {

    calculateDistance();

    var odometer = $('#car_select option:selected').data('odometerbefore');

    $('#odometer-before').html(odometer+ " km");
    $('#odometer-before').data('odometer', $('#car_select option:selected').data('odometerbeforevalue'))

    $('#car_select').on('change', function () {
        var odometer = $(this).find(':selected').data('odometerbefore');

        $('#odometer-before').html(odometer + " km" )

        calculateDistance();
    });
    $('#odometer-after').on('change', function () {
        calculateDistance();
    });
});