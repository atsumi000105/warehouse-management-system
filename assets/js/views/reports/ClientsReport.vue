<template>
    <section class="content">
        <div class="row">
            <h3 class="box-title col-lg-10">
                Clients Report
            </h3>
            <div class="col-lg-2 text-right">
                <div class="btn-group">
                    <button
                        type="button"
                        class="btn btn-info btn-flat dropdown-toggle"
                        data-toggle="dropdown"
                    >
                        <i class="fa fa-fw fa-download" />Export
                        <span class="caret" />
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul
                        class="dropdown-menu"
                        role="menu"
                    >
                        <li>
                            <a><i class="fa fa-fw fa-file-excel" />Excel</a>
                        </li>
                    </ul>
                </div>
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
                        api-url="/api/reports/clients-report"
                    />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import TablePaged from "../../components/TablePaged";
export default {
    name: "ClientsReport",

    components: {
        TablePaged,
    },

    data() {
        let columns = [
            { name: "id", title: "Client ID", sortField: "c.id" },
        ];

        return {
            columns: columns,
            clients: {},
            statuses: [{ id: "ACTIVE", name: "Active" }, { id: "INACTIVE", name: "Inactive" }],
            filters: {
                keyword: null,
                partner: { id: null },
                status: null,
            },
        };
    },

    methods: {
        requestParams: function() {
            return {
                status: this.filters.status || null,
                keyword: this.filters.keyword || null,
                partner: this.filters.partner.id || null,
                include: ["partner"]
            };
        },
    },
};
</script>