<template>
    <section class="sidebar">
        <ul
            class="sidebar-menu tree"
            data-widget="tree"
        >
            <li
                v-for="menu in navigation"
                :key="menu.id"
                :class="{ treeview: menu.hasOwnProperty('links') }"
            >
                <router-link :to="menu.route || '#'">
                    <i
                        v-if="menu.icon"
                        class="fa"
                        :class="'fa-' + menu.icon"
                    />
                    <span>{{ menu.header }}</span>
                    <span
                        v-if="menu.hasOwnProperty('links')"
                        class="pull-right-container"
                    >
                        <i class="fa fa-angle-left pull-right" />
                    </span>
                </router-link>
                <ul
                    v-if="menu.hasOwnProperty('links')"
                    class="treeview-menu"
                >
                    <li
                        v-for="link in menu.links"
                        v-if="hasAccess(link.route)"
                        :key="link.id"
                    >
                        <router-link :to="link.route">
                            <i
                                class="fa"
                                :class="'fa-' + link.icon"
                            />
                            {{ link.title }}
                        </router-link>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</template>

<script>

export default {
        props:[],
        data() {
            return {
                navigation: [
                    {
                        header: "Dashboard",
                        icon: "dashboard",
                        route: "/"
                    },
                    {
                        header: "Incoming Supplies",
                        icon: "truck",
                        links: [
                            { title: "Supply Orders", route: { name: 'orders-supply' }, icon: "truck" },
                            { title: "Supplier Management", route: { name: 'suppliers' }, icon: "group" },
                            { title: "Supply Totals Report", route: { name: 'reports-supply-totals'}, icon: "print" },
                        ]
                    },
                    {
                        header: "Clients",
                        icon: "child",
                        links: [
                            { title: "Client Management", route: { name: 'clients' }, icon: "child" },
                        ]
                    },
                    {
                        header: "Partners",
                        icon: "shopping-cart",
                        links: [
                            { title: "Partner Orders", route: { name: 'orders-partner' }, icon: "child" },
                            { title: "Partner Distributions", route: { name: 'orders-distribution'}, icon: "check-square-o" },
                            { title: "Partner Management", route: { name: 'partners' }, icon: "sitemap" },
                            { title: "Partner Order Totals Report", route: { name: 'reports-partner-order-totals' }, icon: "print" },
                            { title: "Partner Inventory Report", route: { name: 'reports-partner-inventory' }, icon: "print" },
                            { title: "Distribution Totals Report", route: { name: 'reports-distribution-totals' }, icon: "print" },
                        ]
                    },
                    {
                        header: "Warehousing",
                        icon: "industry",
                        links: [
                            { title: "Merchandise Orders", route: { name: 'orders-merchandise' }, icon: "usd" },
                            { title: "Warehouse Management", route: { name: 'warehouses' }, icon: "industry" },
                            { title: "Stock Levels", route: { name: 'stock-levels' }, icon: "line-chart" },
                            { title: "Transaction Report", route: { name: 'reports-transactions'}, icon: "exchange" },
                        ]
                    },
                    {
                        header: "Adjustments",
                        icon: "wrench",
                        links: [
                            { title: "Stock Changes", route: { name: 'orders-adjustment' }, icon: "wrench" },
                            { title: "Transfer Orders", route: { name: 'orders-transfer' }, icon: "refresh" },
                        ]
                    },
                    {
                        header: "Products",
                        icon: "tags",
                        links: [
                            { title: "Product Management", route: { name: 'products' }, icon: "tags" },
                            { title: "Product Categories", route: { name: 'product-categories' }, icon: "folder-open" }
                        ]
                    },
                ]
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            hasAccess(linkRoute) {
                if (!linkRoute) return true;
                let self = this;
                let resolved = this.$router.resolve({name: linkRoute.name});
                let route = resolved.route;
                if (route?.meta?.roles) {
                    let hasRoles = route.meta.roles.filter((role) => self.$store.getters.userHasRole(role));
                    return hasRoles.length > 0;
                }
                return true;
            }
        }
    }
</script>
