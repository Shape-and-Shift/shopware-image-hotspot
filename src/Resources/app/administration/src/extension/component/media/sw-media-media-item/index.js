import template from './sw-media-media-item.html.twig';
const { Component } = Shopware;

Component.override('sw-media-media-item', {
    template,

    data() {
        return {
            showHotspotModal: false
        }
    },

    methods: {
        onShowHotspotModal() {
            this.showHotspotModal = true;
        },
        onCloseHotspotModal() {
            this.showHotspotModal = false;
        }
    }
});
