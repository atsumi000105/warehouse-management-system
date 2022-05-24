<template>
    <section class="content">
        <div class="row">
            <div class="col-xs-2">
                <div class="form-group">
                    <datefield
                        v-model="filters.monthAndYear"
                        label="Age Expiration Date"
                        format="YYYY-MM"
                        timezone="Etc/UTC"
                    />
                </div>
            </div>
            <div class="col-xs-1 text-right">
                <button
                    class="btn btn-success btn-flat"
                    @click="doFilter"
                >
                    <i class="fa fa-fw fa-filter" />Filter
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <table-paged
                        ref="hbtable"
                        :columns="columns"
                        :sort-order="[{ field: 'c.id', direction: 'asc' }]"
                        :params="requestParams()"
                        :per-page="50"
                        api-url="/api/reports/clients-multiple-lines"
                    />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import TablePaged from "../../components/TablePaged";
import DateField from "../../components/DateField.vue";

export default {
    name: "ClientsMultipleLinesPerMonth",

    components: {
        TablePaged,
        datefield: DateField,
    },

    data() {
        let columns = [
            { name: "id", title: "Line Item ID", sortField: "li.id" },
            { name: "clientId", title: "Client ID", sortField: "li.id" },
            { name: "childFirstName", title: "Children First Name", sortField: "li.id" },
            { name: "childLastName", title: "Children Last Name", sortField: "li.id" },
            { name: "parentFirstName", title: "Parent First Name", sortField: "li.id" },
            { name: "parentLastName", title: "Parent Last Name", sortField: "li.id" },
            { name: "distributedAt", title: "Distributed At", sortField: "li.id" },
        ];

        return {
            columns: columns,
            lineItem: {},
            filters: {
                monthAndYear: null,
            },
        };
    },

    methods: {
        requestParams: function () {
            return {
                monthAndYear: this.filters.monthAndYear || null,
            };
        },

        doFilter () {
            console.log("doFilter:", this.requestParams());
            this.$events.fire('filter-set', this.requestParams());
        },
    },
};
</script>