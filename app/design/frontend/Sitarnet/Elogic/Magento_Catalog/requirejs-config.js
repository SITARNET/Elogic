var config = {
    config: {
        map: {
            '*': {
                myCustomScript: 'Magento_Catalog/js/my-custom-script'
            }
        },
        mixins: {
            'Magento_Swatches/js/swatch-renderer': {
                'Magento_Catalog/js/swatch-renderer-mixin': true
            }
        }
    }
};
