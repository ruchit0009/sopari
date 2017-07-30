/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    var index = $('.delivery').find('.form-group').length;
    for (i = 0; i < index; i++) {
        $('.delivery').find('.form-group').find('.no' + i).attr('name', 'delivery_by[' + i + '][number]');
        $('.delivery').find('.form-group').find('.name' + i).attr('name', 'delivery_by[' + i + '][name]');
    }
    $('.delivery-clone').hide();
    $('body').on('click', '.plus', function () {
        var delivery = $('.delivery-clone').clone();
        delivery.find('#name').attr('name', 'delivery_by[' + index + '][name]');
        delivery.find('#number').attr('name', 'delivery_by[' + index + '][number]');
        $('.delivery').append(delivery);
        $('.delivery').find('.delivery-clone').css('display', 'block');
        $('.delivery').find('.delivery-clone').find('#number').addClass('no' + index);
        $('.delivery').find('.delivery-clone').find('#name').addClass('name' + index);

        $('.delivery').find('.delivery-clone').removeClass('delivery-clone');
        index += Number(1);
    });
    $('body').on('click', '.minus', function () {
        $(this).parents('.form-group').remove();
    });

    var timeIndex = $('.time-avail').find('.form-group').length;

    for (i = 0; i < timeIndex; i++) {
        $('.time-avail').find('.form-group').find('.day' + i).attr('name', 'availability[' + i + '][day]');
        $('.time-avail').find('.form-group').find('.s_time' + i).attr('name', 'availability[' + i + '][s_time]');
        $('.time-avail').find('.form-group').find('.e_time' + i).attr('name', 'availability[' + i + '][e_time]');
        $('.time-avail').find('.form-group').find('.status' + i).attr('name', 'availability[' + i + '][status]');



        $('.time-avail').find('.form-group').find('.s_time' + i).attr('id', 'st' + i).timepicker({
            'change': function () {
                $('#et' + $(this).data('index')).timepicker('option', 'minTime', $(this).val());
                $('#et' + $(this).data('index')).val('');
            }});
        if ($('.time-avail').find('.form-group').find('.s_time' + i).val() == '') {
            $('.time-avail').find('.form-group').find('.e_time' + i).attr('id', 'et' + i).timepicker();
        } else {

            $('.time-avail').find('.form-group').find('.e_time' + i).attr('id', 'et' + i).timepicker({
                'minTime': $('.time-avail').find('.form-group').find('.s_time' + i).val(),
            });
        }
        $('.time-avail').find('.form-group').find('.s_time' + i).data('index', i);
    }



    $('.avail-time').hide();


    $('body').on('click', '.avail_plus', function () {

        var timeClone = $('.avail-time').clone();
        timeClone.find('#day').attr('name', 'availability[' + timeIndex + '][day]');
        timeClone.find('#s_time').attr('name', 'availability[' + timeIndex + '][s_time]');
        timeClone.find('#e_time').attr('name', 'availability[' + timeIndex + '][e_time]');
        timeClone.find('#status').attr('name', 'availability[' + timeIndex + '][status]');

        timeClone.find('#s_time').attr('id', 'st' + timeIndex).timepicker({'change': function () {
                $('#et' + $(this).data('index')).timepicker('option', 'minTime', $(this).val());
                $('#et' + $(this).data('index')).val('');
            }});
        timeClone.find('#e_time').attr('id', 'et' + timeIndex).timepicker();
        timeClone.find('#st' + timeIndex).data('index', timeIndex);

        $('.time-avail').append(timeClone);
        $('.time-avail').find('.avail-time').css('display', 'block');
        $('.time-avail').find('.avail-time').find('#day').addClass('day' + timeIndex);
        $('.time-avail').find('.avail-time').find('#s_time').addClass('s_time' + timeIndex);
        $('.time-avail').find('.avail-time').find('#e_time').addClass('e_time' + timeIndex);
        $('.time-avail').find('.avail-time').find('#status').addClass('status' + timeIndex);
        $('.time-avail').find('.avail-time').removeClass('avail-time');
        timeIndex += Number(1);

    });
    $('body').on('click', '.avail_minus', function () {
        $(this).parents('.form-group').remove();
    });


});


 