define ([
    "jquery"
], function ($) {
    'use strict';

        $(document).ready(function () { // event надо знать события observer?
            $('#filter').keyup(function () {
                var value = $(this).val().toLowerCase();
                if (value.length > 2) {
                    console.log('String has: ' + value.length);
                    $('.products.list.items li').filter(function () {
                        let result = $(this).find('a.product-item-link').text().toLowerCase().indexOf(value) > -1;
                        $(this).toggle(result);
                    });
                } else {
                    console.log('String has less than tree symbols: ' + value.length);

                }
            });
        });

    });
