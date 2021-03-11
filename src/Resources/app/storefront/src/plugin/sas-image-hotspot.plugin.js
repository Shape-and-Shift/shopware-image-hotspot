import Plugin from 'src/plugin-system/plugin.class';
import DomAccess from 'src/helper/dom-access.helper';

export default class SasImageHotspotPlugin extends Plugin {
    init() {
        this._registerEvents();
    }

    _registerEvents() {
        this.el.addEventListener('mouseover', e => {
            const tooltip = DomAccess.querySelector(document, '.sas-image-hotspot__desc', false);
            if (tooltip) {
                $(tooltip).on('mouseover', () => {
                    $(this.el).tooltip('show');

                    $(document).on('mouseleave', '.sas-image-hotspot__desc', () => {
                        $(this.el).tooltip('hide');
                    });
                });
            }
        })
    }
}
