import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./views/Dashboard.vue')
    },

    { path: '/admin/groups', component: require('./views/admin/RoleList.vue').default },
    { path: '/admin/groups/new', component: require('./views/admin/RoleEdit.vue').default, props: { new: true } },
    { path: '/admin/groups/:id', component: require('./views/admin/RoleEdit.vue').default },

    { path: '/admin/users', component: require('./views/admin/UserList.vue').default },
    { path: '/admin/users/new', component: require('./views/admin/UserEdit.vue').default, props: { new: true } },
    { path: '/admin/users/:id', component: require('./views/admin/UserEdit.vue').default },

    { path: '/admin/attributes/partner', component: require('./views/admin/PartnerAttributeDefinitionList.vue').default },

    { path: '/partners/fulfillment-periods', component: require('./views/core/ListOptionList.vue').default, props: { name: 'Fulfillment Period', apiPath: 'partners/fulfillment-periods' } },
    { path: '/partners/fulfillment-periods/new', component: require('./views/core/ListOptionEdit.vue').default, props: { new: true, name: 'Fulfillment Period', apiPath: 'partners/fulfillment-periods' } },
    { path: '/partners/fulfillment-periods/:id', component: require('./views/core/ListOptionEdit.vue').default, props: { name: 'Fulfillment Period', apiPath: 'partners/fulfillment-periods' } },

    { path: '/partners/distribution-methods', component: require('./views/core/ListOptionList.vue').default, props: { name: 'Distribution Method', apiPath: 'partners/distribution-methods' } },
    { path: '/partners/distribution-methods/new', component: require('./views/core/ListOptionEdit.vue').default, props: { new: true, name: 'Distribution Method', apiPath: 'partners/distribution-methods' } },
    { path: '/partners/distribution-methods/:id', component: require('./views/core/ListOptionEdit.vue').default, props: { name: 'Distribution Method', apiPath: 'partners/distribution-methods' } },

    { path: '/warehouses', component: require('./views/warehouse/WarehouseList.vue').default },
    { path: '/warehouses/new', component: require('./views/warehouse/WarehouseEdit.vue').default, props: { new: true } },
    { path: '/warehouses/:id', component: require('./views/warehouse/WarehouseEdit.vue').default },

    { path: '/partners', component: require('./views/partner/PartnerList.vue').default },
    { path: '/partners/new', component: require('./views/partner/PartnerEdit.vue').default, props: { new: true } },
    { path: '/partners/:id', component: require('./views/partner/PartnerEdit.vue').default },

    { path: '/suppliers', component: require('./views/supplier/SupplierList.vue').default },
    { path: '/suppliers/new', component: require('./views/supplier/SupplierEdit.vue').default, props: { new: true } },
    { path: '/suppliers/:id', component: require('./views/supplier/SupplierEdit.vue').default },

    { path: '/products', component: require('./views/product/ProductList.vue').default },
    { path: '/products/new', component: require('./views/product/ProductEdit.vue').default, props: { create: true } },
    { path: '/products/:id', component: require('./views/product/ProductEdit.vue').default },

    { path: '/product-categories', component: require('./views/product/ProductCategoryView.vue').default, props: { name: 'Product Category', apiPath: 'product-categories' } },
    { path: '/product-categories/new', component: require('./views/product/ProductCategoryEdit.vue').default, props: { new: true, name: 'Product Category', apiPath: 'product-categories' } },
    { path: '/product-categories/:id', component: require('./views/product/ProductCategoryEdit.vue').default, props: { name: 'Product Category', apiPath: 'product-categories' } },

    { path: '/orders/supply', component: require('./views/order/supply/SupplyOrderList.vue').default},
    { path: '/orders/supply/new', component: require('./views/order/supply/SupplyOrderEdit.vue').default, props: { new: true }},
    { path: '/orders/supply/:id', component: require('./views/order/supply/SupplyOrderEdit.vue').default},

    { path: '/orders/partner', component: require('./views/order/partner/PartnerOrderList.vue').default},
    { path: '/orders/partner/new', component: require('./views/order/partner/PartnerOrderEdit.vue').default, props: { new: true }},
    { path: '/orders/partner/bulk-fill-sheet/:ids', component: require('./views/order/partner/BulkFillSheet.vue').default},
    { path: '/orders/partner/:id', component: require('./views/order/partner/PartnerOrderEdit.vue').default},
    { path: '/orders/partner/:id/fill-sheet', component: require('./views/order/partner/SingleFillSheet.vue').default},

    { path: '/orders/distribution', component: require('./views/order/distribution/BulkDistributionOrderList.vue').default},
    { path: '/orders/distribution/new', component: require('./views/order/distribution/BulkDistributionOrderEdit.vue').default, props: { new: true }},
    { path: '/orders/distribution/:id', component: require('./views/order/distribution/BulkDistributionOrderEdit.vue').default},

    { path: '/orders/adjustment', component: require('./views/order/adjustment/AdjustmentOrderList.vue').default},
    { path: '/orders/adjustment/new', component: require('./views/order/adjustment/AdjustmentOrderEdit.vue').default, props: { new: true }},
    { path: '/orders/adjustment/:id', component: require('./views/order/adjustment/AdjustmentOrderEdit.vue').default},

    { path: '/orders/transfer', component: require('./views/order/transfer/TransferOrderList.vue').default},
    { path: '/orders/transfer/new', component: require('./views/order/transfer/TransferOrderEdit.vue').default, props: { new: true }},
    { path: '/orders/transfer/:id', component: require('./views/order/transfer/TransferOrderEdit.vue').default},

    { path: '/orders/merchandise', component: require('./views/order/merchandise/MerchandiseOrderList.vue').default},
    { path: '/orders/merchandise/new', component: require('./views/order/merchandise/MerchandiseOrderEdit.vue').default, props: { new: true }},
    { path: '/orders/merchandise/:id', component: require('./views/order/merchandise/MerchandiseOrderEdit.vue').default},

    { path: '/stock-levels', component: require('./views/stock/StockView.vue').default},
    { path: '/reports/transactions', component: require('./views/reports/TransactionReport.vue').default},
    { path: '/reports/supply-totals', component: require('./views/reports/SupplyTotalsReport.vue').default},
    { path: '/reports/distribution-totals', component: require('./views/reports/DistributionTotalsReport.vue').default},
    { path: '/reports/partner-order-totals', component: require('./views/reports/PartnerOrderTotalsReport.vue').default},
    { path: '/reports/partner-inventory', component: require('./views/reports/PartnerInventoryReport.vue').default},
];

export default new VueRouter({
    routes,
    linkActiveClass: 'active',
    linkExactActiveClass: 'active',
});

let router = new VueRouter({
    mode: 'history',
    base: __dirname,
    routes
});
