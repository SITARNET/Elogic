define([
    'jquery',
    'mage/utils/wrapper'
], function ($, wrapper) {
    'use strict';

    // return function (openAlert) {
    //     openAlert.submitForm = wrapper.wrapSuper(openAlert.submitForm, function (form) {
    //         this._super(form);
    //         console.log('Hello!'); // add extended functionality here or modify method logic altogether
    //     });
    //
    //     return openAlert;
    // };


    var openAlertMixin = {
        submitForm: function(form) {

            this._super(form);
            alert('My mixin works!');
            console.log('Hello!');
            return this;

        }
    };

    return function (targetWidget) {
        // Example how to extend a widget by mixin object
        $.widget('mage.catalogAddToCart', targetWidget, openAlertMixin); // the widget alias should be like for the target widget

        return $.mage.catalogAddToCart; //  the widget by parent alias should be returned
    };
});

