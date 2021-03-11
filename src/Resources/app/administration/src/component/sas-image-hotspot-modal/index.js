import template from './sas-image-hotspot-modal.html.twig';

const { Component } = Shopware;
const { Criteria } = Shopware.Data;

Component.register('sas-image-hotspot-modal', {
    inject: ['repositoryFactory'],

    template,

    props: {
        media: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            showHotspotModal: false,
            isLoading: false,
            isSaving: false,
            map: null,
        }
    },

    computed: {
        hotspotRepository() {
            return this.repositoryFactory.create('sas_image_hotspot');
        },
        mapRepository() {
            return this.repositoryFactory.create('sas_image_hotspot_map');
        },
    },

    async created() {
        await this.onCreatedComponent();
    },

    methods: {
        async onCreatedComponent() {
            this.showHotspotModal = true;
            await this.fetchMap();
        },

        async fetchMap() {
            this.isLoading = true;
            const criteria = new Criteria();
            criteria.addFilter(Criteria.equals('mediaId', this.media.id));
            criteria.setLimit(1);
            criteria.addAssociation('media');
            criteria.addAssociation('hotspots.media');
            criteria.addAssociation('hotspots.product');

            const maps = await this.mapRepository.search(criteria, Shopware.Context.api);
            if (!maps || maps.length === 0) {
                this.map = this.mapRepository.create(Shopware.Context.api);
                this.map.mediaId = this.media.id;
                this.map.media = this.media;
            } else {
                this.map = maps.first();
            }

            this.isLoading = false;
        },

        async onClickSave() {
            this.isSaving = true;

            await this.mapRepository.save(this.map, Shopware.Context.api);

            this.isSaving = false;
            this.showHotspotModal = false;
            this.$emit('on-close-hotspot-modal');
        },

        onCloseHotspotModal() {
            this.map = null;
            this.showHotspotModal = false;
            this.$emit('on-close-hotspot-modal');
        }
    }
});
