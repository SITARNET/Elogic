var config = {
    map: {
        '*': {
            myCustomScript: 'Magento_Catalog/js/my-custom-script',
            searchScript: 'Magento_Catalog/js/search'
        }
    },
    config: {
        mixins: {
            'Magento_Swatches/js/swatch-renderer': {
                'Magento_Catalog/js/swatch-renderer-mixin': true
            },
            'Magento_Catalog/js/catalog-add-to-cart': {
                'Magento_Catalog/js/catalog-add-to-cart-mixin': true
            }
        }
    }
};
