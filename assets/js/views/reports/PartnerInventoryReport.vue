<template>
    <section class="content">
        <div class="row">
            <h3 class="box-title col-lg-10">Partner Inventory Report</h3>
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
            <div class="form-group col-lg-3 col-sm-6">
                <hb-date v-model="filters.endingAt" label="Date" ></hb-date>
            </div>
            <div class="col-lg-2 col-sm-4">
                <div class="form-group">
                    <label>Type</label>
                    <select class="form-control" v-model="filters.partnerType" v-chosen>
                        <option value="">--All Partner Types--</option>
                        <option value="AGENCY">Agency</option>
                        <option value="HOSPITAL">Hospital</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-1 text-right">
                <button class="btn btn-success btn-flat" @click="doFilter"><i class="fa fa-fw fa-filter"></i>Filter</button>
            </div>

        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <hb-tablepaged
                        :columns="columns"
                        :sortOrder="[{ field: 'p.id', direction: 'asc' }]"
                        :params="requestParams()"
                        ref="hbtable"
                        :perPage="1000"
                        apiUrl="/api/reports/partner-inventory"
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
            let columns = [
                { name: "id", title: "Partner ID", sortField: "p.id" },
                { name: "name", title: "Partner", sortField: "p.title", dataClass: "text-nowrap" },
                { name: "type", title: "Partner Type", sortField: "p.partnerType" },
                { name: "total", title: "Total Inventory", sortField: "total", dataClass: "text-right", titleClass: "text-right text-nowrap" },
            ];

            return {
                transactions: {},
                locations: [],
                columns: columns,
                filters: {
                    partnerType: null,
                    endingAt: null,
                },
            };
        },
        methods: {
            requestParams: function () {
                return {
                    partnerType: this.filters.partnerType || null,
                    endingAt: this.filters.endingAt ? moment.tz(this.filters.endingAt, 'Etc/UTC').endOf('day').toISOString() : null,
                }
            },
            doFilter () {
                this.$events.fire('filter-set', this.requestParams());
            },
            downloadExcel () {
                let params = this.requestParams();
                params.download = 'xlsx';
                axios.get('/api/reports/partner-inventory', { params: params, responseType: 'blob' })
                    .then(response => {
                        let filename = response.headers['content-disposition'].match(/filename="(.*)"/)[1]
                        fileDownload(response.data, filename, response.headers['content-type'])
                    });
            },
            roundForecast (value) {
                debugger;
                return value.toFixed(2);
            },
        },
        mounted() {
            let me = this;
            this.$store.dispatch('loadProducts').then((response)=>{
                let newColumns = [];
                me.$store.getters.allOrderableProducts.forEach(function(product) {
                    newColumns.push(
                        { name: product.sku, title: product.name, sortField: "total" + product.id, dataClass: "text-right", titleClass: "text-right text-nowrap" }
                    );
                });
                me.columns.splice(-1, 0, ...newColumns);

                let forecastColumns = [];
                me.$store.getters.allOrderableProducts.forEach(function(product) {
                    forecastColumns.push(
                        {
                            name: "forecast-"+product.sku,
                            title: "Months left: " + product.name,
                            dataClass: "text-right",
                            titleClass: "text-right",
                            callback: (value) => value ? value.toFixed(2) : null
                        }
                    );
                });
                me.columns.push(...forecastColumns);

                me.$refs.hbtable.reinitializeFields();
            });
            console.log('Component mounted.')
        }
    }
</script>