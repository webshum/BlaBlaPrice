import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;
jQuery(document).ready(function ($) {
    $('#new-phone-number').change(function () {
        var newPhoneNumberChanged = $('#new-phone-number').val();
        $('#new-phone-number-changed').val(newPhoneNumberChanged);
    });

    $('#change-phone').on('beforeSubmit', function () {
        $.ajax({
            url: '/cabinet/change-phone',
            type: 'post',
            data: $(this).closest('form').serialize(),
            dataType: 'json'
        }).done(function (data) {
            if (data.result == true && data.smsSent == true) {
                $('#phone-number').removeClass('active').hide();
                $('#sms-code').addClass('active').show();
            } else if (data.result == false && data.message) {
                $('#phone-number-information').html('<strong>' + data.message + '</strong>');
            }
        });
        return false;
    });

    $('#check-sms').on('beforeSubmit', function () {
        $.ajax({
            url: '/cabinet/check-sms',
            type: 'post',
            data: $(this).closest('form').serialize(),
            dataType: 'json'
        }).done(function (data) {
            if (data.result) {
                $('.popup-wrapper').removeClass('active');
            } else {
                console.log('smth wrong' + data.result);
                $('.popup-wrapper').removeClass('active');
                $('#sms-code').removeClass('active').hide();
            }
            location.reload();
        });
        return false;
    });

    setInterval(function () {
        setTimer($('.time-entry[data-rel="17"]'), $('#datepicker').html());
    }, 1000);

    function setTimer(wrapper, finalTime) {
        var today = new Date().getTime();
        var interval = finalTime - today;
        if (interval < 0) interval = 0;
        var days = parseInt(interval / (1000 * 60 * 60 * 24));
        var daysLeft = interval % (1000 * 60 * 60 * 24);
        if (days == 0) days = '1<';
        var hours = parseInt(daysLeft / (1000 * 60 * 60));
        var hoursLeft = daysLeft % (1000 * 60 * 60);
        var minutes = parseInt(hoursLeft / (1000 * 60));
        var minutesLeft = hoursLeft % (1000 * 60);
        var seconds = parseInt(minutesLeft / (1000));
        wrapper.find('.days').text(days);
        wrapper.find('.hours').text(hours);
        wrapper.find('.minutes').text(minutes);
        wrapper.find('.seconds').text((seconds < 10) ? '0' + seconds : seconds);
    }
});