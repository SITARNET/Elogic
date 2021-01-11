define([
    'jquery',
    'underscore',
    'mage/template',
    'matchMedia',
    'jquery-ui-modules/widget',
    'jquery-ui-modules/core',
    'mage/translate'
], function ($, _, mageTemplate, mediaCheck) {
    'use strict';

    var activeStateMixin = {
        setActiveState: function (isActive) {
            var searchValue;

            this.searchForm.toggleClass('active', isActive);
            this.searchLabel.toggleClass('active', isActive);

            if (this.isExpandable) {
                this.element.attr('aria-expanded', isActive);
                searchValue = this.element.val();
                this.element.val('');
                this.element.val(searchValue);
            }
        }
    };

    return function (targetWidget) {
        $.widget('mage.quickSearch', targetWidget, activeStateMixin);
        return $.mage.quickSearch;
    };
});
