import MagnifierPlugin from 'src/plugin/magnifier/magnifier.plugin';
import Iterator from 'src/helper/iterator.helper';
import DomAccess from 'src/helper/dom-access.helper';

export default class SasMagnifierOverridePlugin extends MagnifierPlugin {
    _registerEvents() {
        Iterator.iterate(this._imageContainers, imageContainer => {
            const image = DomAccess.querySelector(imageContainer, this.options.imageSelector, false);

            if (image) {
                if (image.parentElement.classList.contains('sas-image-hotspot-map-wrapper')) {
                    return;
                }
                image.addEventListener('mousemove', (event) => this._onMouseMove(event, imageContainer, image), false);
                imageContainer.addEventListener('mouseout', (event) => this._stopMagnify(event), false);
            }
        });
    }
}
