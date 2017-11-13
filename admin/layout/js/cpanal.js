$(function() {
   'use strict';

   // Add Red Star To Required Failed
    $('input').each(function() {

       if($(this).attr('required') === 'required') {

           $(this).after('<span class="red-star">*</span>');

       }
    });

    // Convert Password Failed To Text Failed On Hover

    var passFailed = $('.password');

    $('.show-pass').hover(function() {
        passFailed.attr('type', 'text');
    }, function () {
        passFailed.attr('type', 'password');
    });

    // toggle display or hidden the details in categories section
    $('.cat h3').click( function() {
        $(this).next('.full-view').fadeToggle(200);
    });

    $('.categories .option span').click(function() {

        $(this).addClass('active').siblings('span').removeClass('active');

        if($(this).data('view') === 'full') {

            $('.cat .full-view').slideDown(200);
        } else {

            $('.cat .full-view').slideUp(200);
        }

    });

});