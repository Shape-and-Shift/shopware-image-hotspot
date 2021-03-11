import './sas-image-hotspot.scss';
import template from './sas-image-hotspot.html.twig';

const { Component } = Shopware;
import $ from 'jquery';
import 'jquery-ui/ui/widgets/draggable';

Component.register('sas-image-hotspot', {
    template,

    props: {
        hotspot: {
            required: true,
            type: Object,
        },
        isActive: {
            type: Boolean,
            default: false
        }
    },

    inject: ['repositoryFactory'],

    data() {
        return {
            styleObject:  {top: this.hotspot.top + '%', left: this.hotspot.left + '%', position: 'absolute'}
        }
    },

    mounted() {
        $(this.$refs['pin_' + this.hotspot.id]).draggable({
            containment: ".sas-image-hotspot-map-wrapper",
            stop: (e) => this.onDraggingEnd(e)
        });
    },

    methods: {
        onDotClick() {
            this.$emit('on-dot-click', this.hotspot);
        },

        onDraggingEnd(e) {
            const targetStyle = e.target.style;

            this.$emit('on-dragging-end', {
                top: targetStyle.top,
                left: targetStyle.left,
                id: this.hotspot.id
            });
        }
    }
});
