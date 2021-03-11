import template from './sw-media-preview-v2.html.twig';
import './sw-media-preview-v2.scss';
const { Criteria } = Shopware.Data;

Shopware.Component.override('sw-media-preview-v2', {
    template,

    data() {
        return {
            showHotspotModal: false
        }
    },

    computed: {
        mediaCriteria() {
            const criteria = new Criteria;
            criteria.addAssociation('hotspotMap');

            return criteria;
        }
    },

    methods: {
        async fetchSourceIfNecessary() {
            if (!this.source) {
                return;
            }

            if (typeof this.source === 'string') {
                this.trueSource = await this.mediaRepository.get(this.source, Shopware.Context.api, this.mediaCriteria);
            } else {
                this.trueSource = this.source;
            }
        },

        onShowHotspotModal() {
            this.showHotspotModal = true;
        },

        onCloseHotspotModal() {
            this.showHotspotModal = false;
        }
    }
});
