define([
    'jquery',
    'mage/translate'
], function ($, $t) {
    'use strict';

    $.widget('elogic.elogicFavorites', {
        options: {
            addUrl: '',
            removeUrl: '',
            addButtonSelector: ''
        },

        /**
         * Widget initialization
         * @private
         */
        _create: function () {
            var self = this;
            $(document).find(this.options.addButtonSelector).off('click')
                .on('click', function (event) {
                    var button = $(this);
                    var ajaxUrl = button.hasClass('selected') ? self.options.removeUrl : self.options.addUrl;
                    var sku = button.parents('li.item.product.product-item').find('form[data-role="tocart-form"]').data('product-sku');
                    $.ajax({
                        url: ajaxUrl,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            favorite_sku: sku
                        },
                        showLoader: true
                    }).success(function (response) {
                        if (response.result) {
                            console.log('success');
                            var favoritesBlock = $(document).find('.block-favorite-products');
                            var ulSkus = favoritesBlock.find('ul.skus-list');
                            var liSku = ulSkus.find('li.sku[data-sku="' + sku + '"]');
                            if (button.hasClass('selected')) {
                                button.removeClass('selected');
                                button.text($t('Add To Favorites'));
                                liSku.remove();
                                console.log('removed sku: ' + sku);
                            } else {
                                button.addClass('selected');
                                button.text($t('Added! Remove From Favorites'));
                                let newSku = $('<li></li>').addClass('sku').attr('data-sku', sku).text(sku);
                                ulSkus.append(newSku);
                                console.log('added sku: ' + sku);
                            }

                            var subtitle = favoritesBlock.find('.block-content .subtitle');
                            if (parseInt(response.count) > 0) {
                                subtitle.text($t('SKUs'));
                                ulSkus.removeClass('empty');
                            } else {
                                subtitle.text($t('You Have No Favorite Products :('));
                                ulSkus.addClass('empty');
                            }
                        } else {
                            console.log('failure');
                        }
                    });
            });
        }
    });

    return $.elogic.elogicFavorites;
});
