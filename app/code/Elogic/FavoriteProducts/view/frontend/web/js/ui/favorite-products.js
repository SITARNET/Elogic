define([
    'jquery',
    'mage/translate',
    'uiComponent',
    'Magento_Customer/js/customer-data'
], function ($, $t, Component, customerData) {
    'use strict';
    return Component.extend({
        defaults: {
            template: 'Elogic_FavoriteProducts/favorites',
            updateUrl: ''
        },

        favorites: customerData.get('favorite_products'),

        /**
         * @inheritDoc
         */
        initObservable: function () {
            this._super();
            return this;
        },

        /**
         * @inheritDoc
         */
        initialize: function () {
            this._super();
            return this;
        },

        /**
         * Fetch favorite skus if there are
         *
         * @return {{}}
         */
        favoriteSkus: function () {
            return this.favorites().skus || {};
        },

        /**
         * Check if current sku is among favorite ones
         *
         * @param sku
         * @return {boolean}
         */
        isFavorite: function (sku) {
            var favorites = this.favoriteSkus();
            var result = false;
            for (var key in favorites) {
                if (favorites[key] === sku) {
                    result = true;
                    break;
                }
            }

            console.log('sku: ' + sku);
            return result;
        },

        /**
         * Method to make an action on select the favorite product
         *
         * @param sku
         * @return {function(): void}
         */
        select: function (sku) {
            var self = this;
            return function () {
                const url = self.updateUrl + sku;
                if (self.isFavorite(sku)) {
                    console.log('SKU: ' + sku + ', isFavorite: YES, method - DELETE');
                    $.ajax(url, {method: 'DELETE'});
                } else {
                    console.log('SKU: ' + sku + ', isFavorite: NO!, method - POST');
                    $.ajax(url, {method: 'POST'});
                }
            }
        }
    });
});
