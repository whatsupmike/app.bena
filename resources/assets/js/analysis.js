/**
 * Created by michaldrzewiecki on 26.06.2017.
 */

$(document).ready(function () {

    $('.to-pay'). on('change', function () {
        var toPay = $(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                url: '/analysis/paid',
                type: 'POST',
                traditional: true,
                data: {
                    'id': $(this).data('id'),
                    },
        success: function (result) {

            console.log(result);
            toPay.closest('tr').hide(500);
        }
    });
    });

});