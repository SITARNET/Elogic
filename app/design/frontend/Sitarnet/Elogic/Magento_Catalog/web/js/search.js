define ([
    "jquery"
], function ($) {
    'use strict';

        $(document).ready(function () {
            $('#filter').keyup(function () {
                var value = $(this).val().toLowerCase();
                $('ol li').filter(function () {
                    $(this).toggle($(this).attr('class').toLowerCase().indexOf(value) > -1);
                });
            });
        });

    });
