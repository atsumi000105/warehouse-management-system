<template>
    <section class="content">
        <div class="row">
            <h3 class="box-title col-lg-10">Transactions Report</h3>
            <div class="col-lg-2 text-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-fw fa-download"></i>Export
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a @click="downloadExcel"><i class="fa fa-fw fa-file-excel-o"></i>Excel</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <hb-storagelocationselectionform
                    v-model="filters.location"
                ></hb-storagelocationselectionform>
            </div>
            <div class="col-lg-2 col-sm-4">
                <hb-productselection
                    v-model="filters.product"
                ></hb-productselection>
            </div>
            <div class="col-lg-2 col-sm-4">
                <hb-optionlist
                    v-model="filters.orderType"
                    label="Order Type"
                    :preloadedOptions="[
                        { id: 'PartnerOrder', name: 'Partner Order' },
                        { id: 'TransferOrder', name: 'Transfer' },
                        { id: 'AdjustmentOrder', name: 'Stock Change' },
                        { id: 'BulkDistribution', name: 'Partner Distribution' },
                        { id: 'SupplyOrder', name: 'Supply Order' },
                    ]"
                ></hb-optionlist>
            </div>

            <div class="form-group col-lg-2 col-sm-4">
                <hb-date v-model="filters.startingAt" label="Start Date Created"></hb-date>
            </div>
            <div class="form-group col-lg-2 col-sm-4">
                <hb-date v-model="filters.endingAt" label="End Date Created"></hb-date>
            </div>

            <div class="col-xs-1">
                <button class="btn btn-success btn-flat" @click="doFilter"><i class="fa fa-fw fa-filter"></i>Filter</button>
            </div>

        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <hb-tablepaged
                        :columns="columns"
                        :sortOrder="[{ field: 'id', direction: 'desc'}]"
                        :params="requestParams()"
                        ref="hbtable"
                        :perPage="50"
                        apiUrl="/api/reports/transactions"
                    ></hb-tablepaged>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props:[],
        data() {
            return {
                transactions: {},
                locations: [],
                columns: [
                    { name: "id", title: "Transaction ID", sortField: "id" },
                    { name: "product", title: "Product", sortField: "p.name" },
                    { name: "storageLocation", title: "Storage Location", sortField: "s.title" },
                    { name: "delta", title: "Change", sortField: "delta" },
                    { name: "orderType", title: "Order Type"},
                    { name: "order", title: "Order #", sortField: "o.id" },
                    { name: "reason", title: "Reason" },
                    { name: "isCommitted", title: "Committed", sortField: "committed" },
                    { name: "committedAt", title: "Date Committed", sortField: "committedAt", callback: 'dateTimeFormat' },
                    { name: "createdAt", title: "Date Created", sortField: "createdAt", callback: 'dateTimeFormat' },
                ],
                filters: {
                    location: {},
                    product: {},
                    endingAt: null,
                    startingAt: null,
                    orderType: {},
                },
            };
        },
        methods: {
            requestParams: function () {
                return {
                    location: this.filters.location.id || null,
                    product: this.filters.product.id || null,
                    orderType: this.filters.orderType.id || null,
                    startingAt: this.filters.startingAt ? moment(this.filters.startingAt).startOf('day').toISOString() : null,
                    endingAt: this.filters.endingAt ? moment(this.filters.endingAt).endOf('day').toISOString() : null,
                }
            },
            doFilter () {
                this.$events.fire('filter-set', this.requestParams());
            },
            downloadExcel () {
                let params = this.requestParams();
                params.download = 'xlsx';
                axios.get('/api/reports/transactions', { params: params, responseType: 'blob' })
                    .then(response => {
                        let filename = response.headers['content-disposition'].match(/filename="(.*)"/)[1]
                        fileDownload(response.data, filename, response.headers['content-type'])
                    });
            }
        },
        created() {
            console.log('Component mounted.')
        }
    }
</script>