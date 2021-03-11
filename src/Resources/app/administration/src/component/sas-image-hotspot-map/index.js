import './sas-image-hotspot-map.scss';
import template from './sas-image-hotspot-map.html.twig';
import $ from 'jquery';
const utils = Shopware.Utils;

const { Component } = Shopware;

Component.register('sas-image-hotspot-map', {
    template,

    props: {
        map: {
            required: true,
            type: Object
        }
    },

    inject: ['repositoryFactory'],

    computed: {
        hotspotRepository() {
            return this.repositoryFactory.create('sas_image_hotspot');
        },

        mediaRepository() {
            return this.repositoryFactory.create('media');
        },

        mapRepository() {
            return this.repositoryFactory.create('sas_image_hotspot_map');
        },

        uploadTag() {
            return `sas-image-hotspot-media`;
        },
    },

    data() {
        return {
            wrapper: null,
            el: null,
            isLoading: false,
            selectedPin: null,
            showHotspotModal: false,
        }
    },

    mounted() {
        this.wrapper = this.$refs.pinMapImageWrapper;
        this.el = this.$refs.pinMapImage;
    },

    methods: {
        onDeleteDot() {
            const id = this.selectedPin.id;
            this.showHotspotModal = false;
            this.selectedPin = null;

            this.map.hotspots.remove(id);
        },

        onSaveDot() {
            this.$emit('on-save-dot', this.map.hotspots.get(this.selectedPin.id));

            this.selectedPin = null;
            this.showHotspotModal = false;
        },

        onDotClick(pin) {
            this.selectedPin = pin;
            this.showHotspotModal = true;
        },

        onImageClick(e) {
            const topOffset = this.el.getBoundingClientRect().top - $(window).scrollTop();
            const leftOffset = this.el.getBoundingClientRect().left - $(window).scrollLeft();

            const topPx = Math.round( (e.clientY - topOffset - 6) );
            const leftPx = Math.round( (e.clientX - leftOffset - 6) );

            const top = topPx / this.el.clientHeight * 100;
            const left = leftPx / this.el.clientWidth * 100;

            const dotId = utils.createId();

            const pin = this.hotspotRepository.create(Shopware.Context.api);
            pin.top = top;
            pin.left = left;
            pin.id = dotId;
            pin.mapId = this.map.id;
            pin.mediaId = null;
            pin.productId = null;

            this.map.hotspots.add(pin);

            this.selectedPin = pin;
            this.showHotspotModal = true;
        },

        onDraggingEnd(e) {
            let pin = this.map.hotspots.get(e.id);

            pin.left = parseInt(e.left) / this.wrapper.clientWidth * 100;
            pin.top = parseInt(e.top) / this.wrapper.clientHeight * 100;
        },

        onPinModalClosed() {
            this.showHotspotModal = false;
        },

        onSetHotspotMedia([mediaItem]) {
            this.selectedPin.mediaId = mediaItem.id;
            this.selectedPin.media = mediaItem;
        },

        successfulUpload(media) {
            this.mediaRepository.get(media.targetId, Shopware.Context.api).then((mediaItem) => {
                this.selectedPin.mediaId = media.targetId;
                this.selectedPin.media = mediaItem;
            });
        },

        removeMedia() {
            this.selectedPin.mediaId = null;
            this.selectedPin.media = null;
        }
    }
});
