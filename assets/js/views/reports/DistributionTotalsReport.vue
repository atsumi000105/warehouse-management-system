<template>
    <section class="content">
        <div class="row">
            <h3 class="box-title col-lg-10">
                Distribution Totals Report
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
                            <a @click="downloadExcel"><i class="fa fa-fw fa-file-excel" />Excel</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2 col-sm-4">
                <div class="form-group">
                    <label>Type</label>
                    <select
                        v-model="filters.partnerType"
                        v-chosen
                        class="form-control"
                    >
                        <option value="">
                            --All Partner Types--
                        </option>
                        <option value="AGENCY">
                            Agency
                        </option>
                        <option value="HOSPITAL">
                            Hospital
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <partnerselectionform
                    v-model="filters.partner"
                    label="Partner"
                    :options="allPartners"
                    @partner-change="updatePartner"
                />
            </div>

            <div class="form-group col-lg-3 col-sm-6">
                <datefield
                    v-model="filters.startingAt"
                    label="Start Distribution Month"
                    format="YYYY-MM-01"
                    timezone="Etc/UTC"
                />
            </div>
            <div class="form-group col-lg-3 col-sm-6">
                <datefield
                    v-model="filters.endingAt"
                    label="End Distribution Month"
                    format="YYYY-MM-01"
                    timezone="Etc/UTC"
                />
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
                    <tablepaged
                        ref="hbtable"
                        :columns="columns"
                        :sort-order="[{ field: 'p.id', direction: 'asc' }]"
                        :params="requestParams()"
                        :per-page="50"
                        api-url="/api/reports/distribution-totals"
                    />
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</template>

<script>
import DateField from "../../components/DateField";
import PartnerSelectionForm from "../../components/PartnerSelectionForm.vue";
import TablePaged from "../../components/TablePaged.vue";
import { mapGetters } from "vuex";
import products from "../../store/modules/products";
import moment from "moment";
export default {
    components: {
        datefield: DateField,
        partnerselectionform: PartnerSelectionForm,
        tablepaged: TablePaged
    },

    props: [],

    watch: {
        productColumns(val) {
            this.productColumns = _.cloneDeep(val);
            Vue.nextTick( () => this.$refs.vuetable.normalizeFields() );
        },
    },


    data() {
        return {
            transactions: {},
            locations: [],
            columns: [],
            productColumns: [],
            filters: {
                partner: {},
                partnerId: null,
                partnerType: null,
                endingAt: null,
                startingAt: null
            }
        };
    },

    computed: {
        ...mapGetters([
            'allPartners'
        ])
    },

    mounted() {
        let me = this;

        this.getColumns();

        this.$store.dispatch("loadProducts").then(response => {
            let newColumns = [];
            me.$store.getters.allOrderableProducts.forEach(function(product) {
                newColumns.push({
                    name: product.sku,
                    title: product.name,
                    sortField: "total" + product.id,
                    dataClass: "text-right",
                    titleClass: "text-right"
                });
            });
            me.columns.splice(-1, 0, ...newColumns);
        });

        console.log("Component mounted.");
    },

    methods: {
        updatePartner(partner) {
            this.filters.partnerId = null;

            if (partner) {
                this.filters.partnerId = partner.id;
            }
        },
        getColumns() {
            const me = this;

            let columns = [
                { name: "id", title: "Partner ID", sortField: "p.id" },
                { name: "name", title: "Partner", sortField: "p.title" },
                { name: "type", title: "Partner Type", sortField: "p.partnerType" },
                {
                    name: "totals",
                    title: "Total Distributed",
                    sortField: "total",
                    dataClass: "text-right",
                    titleClass: "text-right"
                }
            ];

            if (this.filters && this.filters.startingAt && this.filters.endingAt) {
                let startDate = moment(this.filters.startingAt, 'YYYY-MM');
                let endDate = moment(this.filters.endingAt, 'YYYY-MM');

                let monthsDiff = endDate.diff(startDate, 'months');

                for (var i = 0; i <= monthsDiff; i++) {
                    if (startDate <= endDate) {

                        this.$store.dispatch("loadProducts").then(response => {
                            let newColumns = [];
                            me.$store.getters.allOrderableProducts.forEach(function(product) {
                                newColumns.push({
                                    name: product.sku + '-' + startDate.format('YYYY-MM'),
                                    title: product.name + '(' + startDate.format('YYYY-MM') + ')',
                                    sortField: "total" + product.id,
                                    dataClass: "text-right",
                                    titleClass: "text-right"
                                });
                            });
                            me.columns.splice(-1, 0, ...newColumns);
                            startDate.add(1, 'M').format('YYYY-MM');
                        });
                    }
                }
            }

            me.columns = columns;
        },

        requestParams: function() {
            return {
                partner: this.filters.partnerId || null,
                partnerType: this.filters.partnerType || null,
                startingAt: this.filters.startingAt
                    ? moment
                          .tz(this.filters.startingAt, "Etc/UTC")
                          .startOf("day")
                          .toISOString()
                    : null,
                endingAt: this.filters.endingAt
                    ? moment
                          .tz(this.filters.endingAt, "Etc/UTC")
                          .endOf("day")
                          .toISOString()
                    : null
            };
        },

        doFilter() {
            this.getColumns();
            this.$events.fire("filter-set", this.requestParams());
        },

        downloadExcel() {
            let params = this.requestParams();
            params.download = "xlsx";
            axios.get("/api/reports/distribution-totals", { params: params, responseType: "blob" }).then(response => {
                let filename = response.headers["content-disposition"].match(/filename="(.*)"/)[1];
                fileDownload(response.data, filename, response.headers["content-type"]);
            });
        },
    },
};
</script>
