define ([
    'jquery'
], function ($) {
    'use strict';

    // $.widget('mage.myCustomScript', {
    //
    //     _create: function () {
    //         this._super();
    //         console.log('My custom script!');
    //         return this;
    //     }
    // });
    //
    // return $.mage.myCustomScript;

    // return function () {
    //     console.log('My custom script!');
    // }

    return function (config, element) {
        alert(config.message);
    }

});
