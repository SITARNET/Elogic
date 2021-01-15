define([
    "jquery",
    "jqueryHighlight"
], function ($) {
    'use strict';

    $.widget('mage.searchscript', {
        options: {
            searchTermCount: 1,
            selectors: {
                searchInput: 'input#filter',
                productsList: 'ol.products.list.items.product-items',
                products: 'li.item.product.product-item',
                productLinkName: 'a.product-item-link'
            }
        },

        /**
         * @inheritDoc
         */
        _create: function () {
            var selectors = this.options.selectors;
            this._on($(selectors.searchInput), { 'keyup': this.onInputKeyUp });
        },

        /**
         * Subscribe on keyup event to process filtering and highlighting
         *
         * @param event
         */
        onInputKeyUp: function (event) {
            var selectors = this.options.selectors;
            var target = $(event.target);
            var value = target.val().toLowerCase();
            var productsList = $(document).find(selectors.productsList);
            var allProducts = productsList.find(selectors.products);
            if (value.length > this.options.searchTermCount) {
                this.removeHighlightsInProducts();
                productsList.highlight(value);
                console.log('String has: ' + value.length);
                allProducts.filter(function () {
                    let productLinkName = $(this).find(selectors.productLinkName);
                    let result = productLinkName.text().toLowerCase().indexOf(value) > -1;
                    $(this).toggle(result);
                });
            } else {
                allProducts.show();
                this.removeHighlightsInProducts();
                console.log('String has less than tree symbols: ' + value.length);
            }
        },

        /**
         * Remove all highlights
         */
        removeHighlightsInProducts: function () {
            $(document).find(this.options.selectors.productsList).removeHighlight();
        }
    });

    return $.mage.searchscript;
});
