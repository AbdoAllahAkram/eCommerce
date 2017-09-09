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

});