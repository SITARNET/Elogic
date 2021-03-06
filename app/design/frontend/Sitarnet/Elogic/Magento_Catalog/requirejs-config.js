var config = {
    map: {
        '*': {
            myCustomScript: 'Magento_Catalog/js/my-custom-script',
            searchScript: 'Magento_Catalog/js/search',
            jqueryHighlight: 'Magento_Catalog/js/jquery-highlight',
            searchScriptUi: 'Magento_Catalog/js/search-ui'
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
