<template>
    <section class="content">
        <div class="row">
            <h3 class="box-title col-lg-10">
                Multiple Client Orders per Month
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
                            <a @click.prevent="downloadExcel">
                                <i class="fa fa-fw fa-file-excel" />
                                Excel
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

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
import moment from "moment";

export default {
    name: "ClientsMultipleLinesPerMonth",

    components: {
        TablePaged,
        datefield: DateField,
    },

    data() {
        let columns = [
            { name: "firstname", title: "Client First Name" },
            { name: "lastname", title: "Client Last Name" },
            { name: "duplicatedDistributionCount", title: "Duplicated Count" },
            { name: "parentFirstName", title: "Parent First Name" },
            { name: "parentLastName", title: "Parent Last Name" },
            { name: "distributedAt", title: "Distributed At" },
        ];

        return {
            columns: columns,
            lineItem: {},
            filters: {
                monthAndYear: moment().format('YYYY-MM'),
            },
        };
    },

    methods: {
        requestParams: function () {
            return {
                monthAndYear: this.filters.monthAndYear || null,
                multipleDistributionReport: true,
            };
        },

        downloadExcel: function () {
            let params = this.requestParams();
            params.download = 'xlsx';

            axios.get('/api/reports/clients-multiple-lines', {
                params: params,
                responseType: 'blob'
            }).then(response => {
                let fileName = response.header['content-disposition'].match(/filename="(.*)"/)[1];
                fileDownload(response.data, fileName, response.headers['content-type'])
            })
        },

        doFilter () {
            console.log("doFilter:", this.requestParams());
            this.$events.fire('filter-set', this.requestParams());
        },
    },
};
</script>