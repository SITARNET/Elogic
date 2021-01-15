define([
    'jquery',
    'underscore',
    'mage/translate'
], function ($, _, $t) {
    'use strict';

    $.widget('elogic.elogicFavoritesState', {
        options: {
            skus: '',
            skusListSelector: '',
            allProducts: 'li.item.product.product-item',
            favoriteBtnSelector: '.favorites button'
        },

        /**
         * Widget initialization
         * @private
         */
        _create: function () {
            var options = this.options;
            var skusList = options.skus;
            var skusListElement = $(document).find(options.skusListSelector);
            if (skusList && skusListElement.length) {
                var allProducts = $(options.allProducts);
                allProducts.find(options.favoriteBtnSelector).removeClass('selected');
                _.each(skusList, function (sku) {
                    var formWithSku = allProducts.find('form[data-product-sku="' + sku + '"]');
                    if (formWithSku.length) {
                        let button = formWithSku.parents(options.allProducts).find(options.favoriteBtnSelector);
                        button.addClass('selected');
                        button.text($t('Added! Remove From Favorites'));
                    }

                    console.log('sku: ' + sku);
                });
            }
        }
    });

    return $.elogic.elogicFavoritesState;
});
