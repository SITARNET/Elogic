define([
    'jquery'
], function ($) {
    'use strict';

        var modalWidgetMixin = {
                _create: function() {

                    this._super();
                    alert('My mixin works!');
                    return this;

                },
        };

    return function (targetWidget) {
        // Example how to extend a widget by mixin object
        $.widget('mage.validation', targetWidget, modalWidgetMixin); // the widget alias should be like for the target widget

        return $.mage.validation; //  the widget by parent alias should be returned
    };
});
