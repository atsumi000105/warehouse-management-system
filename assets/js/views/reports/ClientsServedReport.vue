<template>
    <section class="content">
        <div class="row">
            <h3 class="box-title col-lg-10">
                Clients Served Report
            </h3>
        </div>

        <div class="row">
            <div class="col-xs-2">
                <div class="form-group">
                    <datefield
                        v-model="filters.dateFrom"
                        label="From Date"
                        format="YYYY-MM"
                        timezone="Etc/UTC"
                    />
                </div>
            </div>

            <div class="col-xs-2">
                <div class="form-group">
                   <datefield
                        v-model="filters.dateTo"
                        label="To Date"
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
import moment from "moment";

export default {
    name: "ClientsServedReport",

    components: {
        TextField,
        TablePaged,
        datefield: DateField,
    },

    data() {
        return {
            //columns: getColumns,
            partners: {},
            columns: [],
            filters: {
                title: null,
                zipcode: null,
                county: null,
                state: null,
                dateFrom: null,
                dateTo: null,
            },
        };
    },

    created() {
        this.columns = this.getColumns();
    },

    methods: {
        getColumns: function() {
            let columns = [
                { name: "id", title: "Partner ID", sortField: "p.id" },
                { name: "title", title: "Partner Name", sortField: "p.id" },
                { name: "clients", title: "Clients", sortField: "p.id" },
                { name: "families", title: "Families", sortField: "p.id" },
            ];

            if (this.filters && this.filters.dateFrom && this.filters.dateTo) {
                let startDate = moment(this.filters.dateFrom, 'YYYY-MM');
                let endDate = moment(this.filters.dateTo, 'YYYY-MM');

                let monthsDiff = endDate.diff(startDate, 'months');

                for (var i = 0; i <= monthsDiff; i++) {
                    if (startDate <= endDate) {
                        const localColumn = {
                            name: 'clientsMonth-' + startDate.format('YYYY-MM'),
                            title: 'Period ' + startDate.format('YYYY-MM'),
                            sortField: '',
                        };

                        columns.push(localColumn);

                        startDate.add(1, 'M').format('YYYY-MM');
                    }
                }
            }

            return columns;
        },

        requestParams: function() {
            return {
                title: this.filters.title || null,
                zipcode: this.filters.zipcode || null,
                county: this.filters.county || null,
                state: this.filters.state || null,
                dateFrom: this.filters.dateFrom || null,
                dateTo: this.filters.dateTo || null,
            };
        },

        doFilter () {
            this.columns = this.getColumns();
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