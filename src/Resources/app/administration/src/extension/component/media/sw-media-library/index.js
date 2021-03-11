const { Component, Context } = Shopware;
const { Criteria } = Shopware.Data;

Component.override('sw-media-library', {
    methods: {
        async loadItems() {
            this.isLoading = true;
            await this.nextFolders();

            if (this.folderLoaderDone) {
                this.pageItem += 1;

                const criteria = new Criteria(this.pageItem, this.limit);
                criteria
                    .addFilter(Criteria.equals('mediaFolderId', this.folderId))
                    .addAssociation('tags')
                    .addAssociation('productMedia.product')
                    .addAssociation('categories')
                    .addAssociation('productManufacturers.products')
                    .addAssociation('mailTemplateMedia.mailTemplate')
                    .addAssociation('documentBaseConfigs')
                    .addAssociation('avatarUser')
                    .addAssociation('paymentMethods')
                    .addAssociation('shippingMethods')
                    .addAssociation('hotspotMap')
                    .addSorting(Criteria.sort(this.sorting.sortBy, this.sorting.sortDirection))
                    .setTerm(this.term);

                const items = await this.mediaRepository.search(criteria, Context.api);

                this.items.push(...items);
                this.itemLoaderDone = this.isLoaderDone(criteria, items);
            }

            this.isLoading = false;
        },
    }
});
