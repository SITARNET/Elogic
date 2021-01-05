var config = {
    map: {
        '*': {
            myCustomScript: 'Magento_Catalog/js/my-custom-script'
        }
    },
    config: {
        mixins: {
            'Magento_Swatches/js/swatch-renderer': {
                'Magento_Catalog/js/swatch-renderer-mixin': false
            },
            'Magento_Catalog/js/catalog-add-to-cart': {
                'Magento_Catalog/js/catalog-add-to-cart-mixin': true
            }
        }
    }
};
