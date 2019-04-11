<template>
    <section class="sidebar">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li v-for="menu in navigation" :class="{treeview: menu.hasOwnProperty('links')}">
                <router-link :to="menu.route || '#'">
                    <i v-if="menu.icon" class="fa" :class="'fa-' + menu.icon"></i>
                    <span>{{ menu.header }}</span>
                    <span class="pull-right-container" v-if="menu.hasOwnProperty('links')">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </router-link>
                <ul class="treeview-menu" v-if="menu.hasOwnProperty('links')">
                    <li v-for="link in menu.links">
                        <router-link :to="link.route"><i class="fa" :class="'fa-' + link.icon"></i>{{ link.title }}</router-link>
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
                            { title: "Supply Orders", route: "/orders/supply", icon: "truck" },
                            { title: "Supplier Management", route: "/suppliers", icon: "group" },
                            { title: "Supply Totals Report", route: "/reports/supply-totals", icon: "print" },
                        ]
                    },
                    {
                        header: "Partners",
                        icon: "shopping-cart",
                        links: [
                            { title: "Partner Orders", route: "/orders/partner", icon: "child" },
                            { title: "Partner Distributions", route: "/orders/bulk-distribution", icon: "check-square-o" },
                            { title: "Partner Management", route: "/partners", icon: "sitemap" },
                            { title: "Partner Order Totals Report", route: "/reports/partner-order-totals", icon: "print" },
                            { title: "Partner Inventory Report", route: "/reports/partner-inventory", icon: "print" },
                            { title: "Distribution Totals Report", route: "/reports/distribution-totals", icon: "print" },
                        ]
                    },
                    {
                        header: "Warehousing",
                        icon: "industry",
                        links: [
                            { title: "Merchandise Orders", route: "/orders/merchandise", icon: "usd" },
                            { title: "Warehouse Management", route: "/warehouses", icon: "industry" },
                            { title: "Stock Levels", route: "/stock-levels", icon: "line-chart" },
                            { title: "Transaction Report", route: "/reports/transactions", icon: "exchange" },
                        ]
                    },
                    {
                        header: "Adjustments",
                        icon: "wrench",
                        links: [
                            { title: "Stock Changes", route: "/orders/adjustment", icon: "wrench" },
                            { title: "Transfer Orders", route: "/orders/transfer", icon: "refresh" },
                        ]
                    },
                    {
                        header: "Products",
                        icon: "tags",
                        links: [
                            { title: "Product Management", route: "/products", icon: "tags" },
                            { title: "Product Categories", route: "/product-categories", icon: "folder-open" }
                        ]
                    },
                ]
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>