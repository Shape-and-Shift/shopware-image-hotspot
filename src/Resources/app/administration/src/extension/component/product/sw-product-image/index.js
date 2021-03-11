import template from './sw-product-image.html.twig';
const { Criteria } = Shopware.Data;

Shopware.Component.override('sw-product-image', {
    template,

    inject: ['repositoryFactory'],

    computed: {
        mediaCriteria() {
            const criteria = new Criteria;
            criteria.addAssociation('hotspotMap');

            return criteria;
        },

        mediaRepository() {
            return this.repositoryFactory.create('media');
        },
    },

    data() {
        return {
            media: null,
            showHotspotModal: false
        }
    },

    async created() {
        await this.createdComponent();
    },

    methods: {
        async createdComponent() {
            if (!this.mediaId.match(/^[0-9a-f]{32}$/)) {
                return;
            }

            this.media = await this.mediaRepository.get(this.mediaId, Shopware.Context.api, this.mediaCriteria);
        },

        onShowHotspotModal() {
            this.showHotspotModal = true;
        },

        onCloseHotspotModal() {
            this.media = null;
            this.showHotspotModal = false;
        }
    }
});
