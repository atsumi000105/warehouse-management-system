<template>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <table-paged
                        ref="hbtable"
                        :columns="columns"
                        :sort-order="[{ field: 'p.id', direction: 'asc' }]"
                        :params="requestParams()"
                        :per-page="50"
                        api-url="/api/reports/clients-served"
                    />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import TablePaged from "../../components/TablePaged";

export default {
    name: "ClientsServedReport",

    components: {
        TablePaged,
    },

    data() {
        let columns = [
            { name: "id", title: "Partner ID", sortField: "p.id" },
            { name: "title", title: "Partner Name", sortField: "p.title" },
            { name: "children", title: "Children" },
            { name: "families", title: "Families" },
        ];

        return {
            columns: columns,
            partners: {},
            filters: {
                title: null,
            },
        };
    },

    methods: {
        requestParams: function() {
            return {
                title: this.filters.title || null,
            };
        },

        doFilter () {
            console.log("doFilter:", this.requestParams());
            this.$events.fire('filter-set', this.requestParams());
        },
    },
}
</script>

<style scoped>

</style>