import SasImageHotspotPlugin from './plugin/sas-image-hotspot.plugin';
import SasMagnifierOverridePlugin from './plugin/sas-magnifier-override.plugin';

const PluginManager = window.PluginManager;

PluginManager.register('SasImageHotspot', SasImageHotspotPlugin, '[data-sas-image-hotspot]');
PluginManager.override('Magnifier', SasMagnifierOverridePlugin, '[data-magnifier]');
