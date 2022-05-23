<template>
    <section class="content">
        <div class="row">
            <h3 class="box-title col-lg-10">
                Clients Served Report
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
                        label="Month & Year"
                        format="YYYY-MM"
                        timezone="Etc/UTC"
                    />
                </div>
            </div>

            <div class="col-xs-2">
                <div class="form-group">
                    <TextField
                        v-model="filters.zipcode"
                        label="Zip Code"
                    />
                </div>
            </div>

            <div class="col-xs-2">
                <div class="form-group">
                    <TextField
                        v-model="filters.county"
                        label="County"
                    />
                </div>
            </div>

            <div class="col-xs-2">
                <div class="form-group">
                    <TextField
                        v-model="filters.state"
                        label="State"
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
import TextField from "../../components/TextField";
import DateField from "../../components/DateField.vue";

export default {
    name: "ClientsServedReport",

    components: {
        TextField,
        TablePaged,
        datefield: DateField,
    },

    data() {
        let columns = [
            { name: "id", title: "Partner ID", sortField: "p.id" },
            { name: "title", title: "Partner Name", sortField: "p.title" },
            { name: "activeChildren", title: "Active Children (Client)" },
            { name: "children", title: "Children (All Statuses)" },
            { name: "activeFamilies", title: "Active Families" },
            { name: "families", title: "Families (all statuses)" },
        ];

        return {
            columns: columns,
            partners: {},
            filters: {
                title: null,
                zipcode: null,
                county: null,
                state: null,
                monthAndYear: null,
            },
        };
    },

    methods: {
        requestParams: function() {
            return {
                title: this.filters.title || null,
                zipcode: this.filters.zipcode || null,
                county: this.filters.county || null,
                state: this.filters.state || null,
                monthAndYear: this.filters.monthAndYear || null,
            };
        },

        doFilter () {
            console.log("doFilter:", this.requestParams());
            this.$events.fire('filter-set', this.requestParams());
        },

        downloadExcel: function () {
            let params = this.requestParams();
            params.download = 'xlsx';

            axios.get('/api/reports/clients-served', {
                params: params,
                responseType: 'blob'
            }).then(response => {
                let fileName = response.header['content-disposition'].match(/filename="(.*)"/)[1];
                fileDownload(response.data, fileName, response.headers['content-type'])
            })
        },
    },
}
</script>

<style scoped>

</style>