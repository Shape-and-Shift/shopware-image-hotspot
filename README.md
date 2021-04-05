### Short video introduction

<a href="https://www.loom.com/share/905f5e551f6d4ea8a150b92294bf70cc" target="_blank"><img width="818" alt="Bildschirmfoto 2021-04-05 um 10 35 50" src="https://user-images.githubusercontent.com/8193345/113549820-bbcbf280-95fa-11eb-834b-1121f1df9be4.png"></a>

### How to show a custom media field with a Hotspot
It is also possible to show the image hotspots on a media type
which was generated through a custom field.

First you would need to create of course your custom media type.

> Because the media type in custom fields only supports the compact media uploader,
we need to set the hotspot directly within the media library.

Head over to your media library and go to the HotSpot image folder `Media > Hotspot Images`
and upload your image.

Open the context menu and click `Set image hotspot`.

![](https://res.cloudinary.com/dtgdh7noz/image/upload/v1614600120/Hotspot%20Plugin/Bildschirmfoto_2021-03-01_um_14.01.22_cxdpu4.png)
*Hotspot Image folder in media library*

Next a new modal will open where you can add your hotspots. Just left-click on a position somewhere on your image to
create a new hotspot. 

![](https://res.cloudinary.com/dtgdh7noz/image/upload/v1614600322/Hotspot%20Plugin/Bildschirmfoto_2021-03-01_um_14.04.49_q9xm4u.png)
*To save the hotspot click apply*

After you added all your hotspots click **save** to save your new image hotspot file,
which you can choose now for your custom field: for example within your product.

![](https://res.cloudinary.com/dtgdh7noz/image/upload/v1614600531/Hotspot%20Plugin/Bildschirmfoto_2021-03-01_um_14.08.07_zkkouu.png)
*Choose your hotspot image within your custom field media type*

##### Storefront integration

Finally you need some code to show the custom media field with its image hotspots within the Storefront.

To do so the following code would get the custom media field and show 
the hotspots

```
{# get the media ID of the custom field #}
{% set hotspotMediaId = page.product.customFields.your_media_custom_field %}

# fetch media as batch - optimized for performance #}
{% set mediaCollection = searchMedia([hotspotMediaId], context.context) %}

{# extract single media object #}
{% set hotspotMedia = mediaCollection.get(hotspotMediaId) %}

{# generate the thumbnail and passing the hotspotEnabled option  #}
{% sw_thumbnails 'hotspot-image' with {
    media: hotspotMedia,
    hotspotEnabled: true
} %}
```
