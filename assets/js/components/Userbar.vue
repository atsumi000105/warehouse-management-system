<template>
    <ul class="nav navbar-nav">
        <!-- Authentication Links -->
        <li class="dropdown user admin-menu">
            <a
                id="admin-dropdown"
                href="#"
                class="dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
            >
                <i class="fa fa-gear" /> Administration
            </a>

            <ul
                class="dropdown-menu dropdown-menu-right"
                role="menu"
                aria-labelledby="admin-dropdown"
            >
                <li
                    v-for="link in links"
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
</template>

<script>
    export default {
        props:[],
        data() {
            return {
                links: [
                    { title: "Manage Roles", route: "/admin/roles", icon: "list" },
                    { title: "Manage Users", route: "/admin/users", icon: "user" },
                    { title: "Manage Fulfillment Periods", route: "/partners/fulfillment-periods", icon: "calendar" },
                    { title: "Manage Distribution Methods", route: "/partners/distribution-methods", icon: "archive" },
                    { title: "Configuration", route: "/admin/configuration", icon: "wrench" },
                ]
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>