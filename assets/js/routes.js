import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./views/Dashboard.vue')
    },

    { path: '/admin/groups', name: 'admin-groups', component: require('./views/admin/RoleList.vue').default },
    { path: '/admin/groups/new', name: 'admin-group-new', component: require('./views/admin/RoleEdit.vue').default, props: { new: true } },
    { path: '/admin/groups/:id', name: 'admin-group-edit', component: require('./views/admin/RoleEdit.vue').default },

    { path: '/admin/users', name: 'admin-users', component: require('./views/admin/UserList.vue').default },
    { path: '/admin/users/new', name: 'admin-user-new', component: require('./views/admin/UserEdit.vue').default, props: { new: true } },
    { path: '/admin/users/:id', name: 'admin-user-edit', component: require('./views/admin/UserEdit.vue').default },

    { path: '/admin/attributes/partner', name: 'admin-partner-attribute', component: require('./views/admin/attributes/PartnerAttributeDefinitionList.vue').default },
    { path: '/admin/attributes/partner/new', name: 'admin-partner-attribute-new', component: require('./views/admin/attributes/PartnerAttributeDefinitionEdit.vue').default, props: { newForm: true } },
    { path: '/admin/attributes/partner/:id', name: 'admin-partner-attribute-edit', component: require('./views/admin/attributes/PartnerAttributeDefinitionEdit.vue').default },

    { path: '/admin/attributes/client', name: 'admin-client-attribute', component: require('./views/admin/attributes/ClientAttributeDefinitionList.vue').default },
    { path: '/admin/attributes/client/new', name: 'admin-client-attribute-new', component: require('./views/admin/attributes/ClientAttributeDefinitionEdit.vue').default, props: { newForm: true } },
    { path: '/admin/attributes/client/:id', name: 'admin-client-attribute-edit', component: require('./views/admin/attributes/ClientAttributeDefinitionEdit.vue').default },

    { path: '/clients', name: 'clients', component: require('./views/client/ClientList').default },
    { path: '/clients/new', name: 'client-new', component: require('./views/client/ClientEdit').default, props: { new: true } },
    { path: '/clients/:id', name: 'client-edit', component: require('./views/client/ClientEdit').default },

    { path: '/partners/fulfillment-periods', name: 'partners-fulfillment', component: require('./views/core/ListOptionList.vue').default, props: { name: 'Fulfillment Period', apiPath: 'partners/fulfillment-periods' } },
    { path: '/partners/fulfillment-periods/new', name: 'partner-fulfillment-new', component: require('./views/core/ListOptionEdit.vue').default, props: { new: true, name: 'Fulfillment Period', apiPath: 'partners/fulfillment-periods' } },
    { path: '/partners/fulfillment-periods/:id', name: 'partner-fulfillment-edit', component: require('./views/core/ListOptionEdit.vue').default, props: { name: 'Fulfillment Period', apiPath: 'partners/fulfillment-periods' } },

    { path: '/partners/distribution-methods', name: 'partners-dist-methods', component: require('./views/core/ListOptionList.vue').default, props: { name: 'Distribution Method', apiPath: 'partners/distribution-methods' } },
    { path: '/partners/distribution-methods/new', name: 'partner-dist-methods-new', component: require('./views/core/ListOptionEdit.vue').default, props: { new: true, name: 'Distribution Method', apiPath: 'partners/distribution-methods' } },
    { path: '/partners/distribution-methods/:id', name: 'partner-dist-methods-edit', component: require('./views/core/ListOptionEdit.vue').default, props: { name: 'Distribution Method', apiPath: 'partners/distribution-methods' } },

    { path: '/warehouses', name: 'warehouses', component: require('./views/warehouse/WarehouseList.vue').default },
    { path: '/warehouses/new', name: 'warehouse-new', component: require('./views/warehouse/WarehouseEdit.vue').default, props: { new: true } },
    { path: '/warehouses/:id', name: 'warehouse-edit', component: require('./views/warehouse/WarehouseEdit.vue').default },

    { path: '/partners', name: 'partners', component: require('./views/partner/PartnerList.vue').default },
    { path: '/partners/new', name: 'partner-new', component: require('./views/partner/PartnerEdit.vue').default, props: { new: true } },
    { path: '/partners/:id', name: 'partner-edit', component: require('./views/partner/PartnerEdit.vue').default },

    { path: '/suppliers', name: 'suppliers', component: require('./views/supplier/SupplierList.vue').default },
    { path: '/suppliers/new', name: 'supplier-new', component: require('./views/supplier/SupplierEdit.vue').default, props: { new: true } },
    { path: '/suppliers/:id', name: 'supplier-edit', component: require('./views/supplier/SupplierEdit.vue').default },

    { path: '/products', name: 'products', component: require('./views/product/ProductList.vue').default },
    { path: '/products/new', name: 'product-new', component: require('./views/product/ProductEdit.vue').default, props: { create: true } },
    { path: '/products/:id', name: 'product-edit', component: require('./views/product/ProductEdit.vue').default },

    { path: '/product-categories', name: 'product-categories', component: require('./views/product/ProductCategoryView.vue').default, props: { name: 'Product Category', apiPath: 'product-categories' } },
    { path: '/product-categories/new', name: 'product-category-new', component: require('./views/product/ProductCategoryEdit.vue').default, props: { new: true, name: 'Product Category', apiPath: 'product-categories' } },
    { path: '/product-categories/:id', name: 'product-category-edit', component: require('./views/product/ProductCategoryEdit.vue').default, props: { name: 'Product Category', apiPath: 'product-categories' } },

    { path: '/orders/supply', name: 'orders-supply', component: require('./views/order/supply/SupplyOrderList.vue').default},
    { path: '/orders/supply/new', name: 'order-supply-new', component: require('./views/order/supply/SupplyOrderEdit.vue').default, props: { new: true }},
    { path: '/orders/supply/:id', name: 'order-supply-edit', component: require('./views/order/supply/SupplyOrderEdit.vue').default},

    { path: '/orders/partner', name: 'orders-partner', component: require('./views/order/partner/PartnerOrderList.vue').default},
    { path: '/orders/partner/new', name: 'order-partner-new', component: require('./views/order/partner/PartnerOrderEdit.vue').default, props: { new: true }},
    { path: '/orders/partner/:id', name: 'order-partner-edit', component: require('./views/order/partner/PartnerOrderEdit.vue').default},
    { path: '/orders/partner/bulk-fill-sheet/:ids', name: 'orders-partner-bulk-edit', component: require('./views/order/partner/BulkFillSheet.vue').default},
    { path: '/orders/partner/:id/fill-sheet', name: 'orders-partner-fill', component: require('./views/order/partner/SingleFillSheet.vue').default},

    { path: '/orders/distribution', name: 'orders-distribution', component: require('./views/order/distribution/BulkDistributionOrderList.vue').default},
    { path: '/orders/distribution/new', name: 'order-distribution-new', component: require('./views/order/distribution/BulkDistributionOrderEdit.vue').default, props: { new: true }},
    { path: '/orders/distribution/:id', name: 'order-distribution-edit', component: require('./views/order/distribution/BulkDistributionOrderEdit.vue').default},

    { path: '/orders/adjustment', name: 'orders-adjustment', component: require('./views/order/adjustment/AdjustmentOrderList.vue').default},
    { path: '/orders/adjustment/new', name: 'order-adjustment-new', component: require('./views/order/adjustment/AdjustmentOrderEdit.vue').default, props: { new: true }},
    { path: '/orders/adjustment/:id', name: 'order-adjustment-edit', component: require('./views/order/adjustment/AdjustmentOrderEdit.vue').default},

    { path: '/orders/transfer', name: 'orders-transfer', component: require('./views/order/transfer/TransferOrderList.vue').default},
    { path: '/orders/transfer/new', name: 'order-transfer-new', component: require('./views/order/transfer/TransferOrderEdit.vue').default, props: { new: true }},
    { path: '/orders/transfer/:id', name: 'order-transfer-edit', component: require('./views/order/transfer/TransferOrderEdit.vue').default},

    { path: '/orders/merchandise', name: 'orders-merchandise', component: require('./views/order/merchandise/MerchandiseOrderList.vue').default},
    { path: '/orders/merchandise/new', name: 'order-merchandise-new', component: require('./views/order/merchandise/MerchandiseOrderEdit.vue').default, props: { new: true }},
    { path: '/orders/merchandise/:id', name: 'order-merchandise-edit', component: require('./views/order/merchandise/MerchandiseOrderEdit.vue').default},

    { path: '/stock-levels', name: 'stock-levels', component: require('./views/stock/StockView.vue').default},
    { path: '/reports/transactions', name: 'reports-transactions', component: require('./views/reports/TransactionReport.vue').default},
    { path: '/reports/supply-totals', name: 'reports-supply-totals', component: require('./views/reports/SupplyTotalsReport.vue').default},
    { path: '/reports/distribution-totals', name: 'reports-distribution-totals', component: require('./views/reports/DistributionTotalsReport.vue').default},
    { path: '/reports/partner-order-totals', name: 'reports-partner-order-totals', component: require('./views/reports/PartnerOrderTotalsReport.vue').default},
    { path: '/reports/partner-inventory', name: 'reports-partner-inventory', component: require('./views/reports/PartnerInventoryReport.vue').default},
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
