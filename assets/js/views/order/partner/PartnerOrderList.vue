<template>
    <section class="content">
        <router-link to="/orders/partner/new" class="btn btn-success btn-flat pull-right"><i class="fa fa-plus-circle fa-fw"></i>Create Partner Order</router-link>
        <h3 class="box-title">Partner Orders List</h3>

        <div class="row">
            <div class="col-xs-2">
                <hb-date v-model="filters.orderPeriod" label="Order Month" format="YYYY-MM-01" timezone="Etc/UTC"></hb-date>
            </div>
            <div class="col-xs-3">
                <hb-partnerselectionform
                        v-model="filters.partner"
                        label="Partner"
                ></hb-partnerselectionform>
            </div>
            <div class="col-xs-2">
                <hb-optionlist
                        label="Partner Fulfillment Period"
                        apiPath="partners/fulfillment-periods"
                        v-model="filters"
                        property="fulfillmentPeriod"
                        displayProperty="name"
                        emptyString="-- All Periods --"
                ></hb-optionlist>
            </div>

            <div class="col-xs-2">
                <hb-optionliststatic
                        label="Status"
                        v-model="filters"
                        property="status"
                        :preloadedOptions="statuses"
                        emptyString="-- All Statuses --"
                ></hb-optionliststatic>
                <!-- /.input group -->
            </div>
            <div class="col-xs-3">
                <button class="btn btn-success btn-flat" @click="doFilter"><i class="fa fa-fw fa-filter"></i>Filter</button>
            </div>
        </div>

        <div class="row">
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="col-xs-12">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown" :disabled="selection.length == 0">
                                    <i class="fa fa-fw fa-wrench"></i>
                                    Bulk Operations ({{selection.length}})
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li v-for="status in statuses"><a @click="bulkStatusChange(status.id)">Change Status to <strong>{{status.name}}</strong></a></li>
                                    <li class="divider"></li>
                                    <li>
                                        <router-link :to='"/orders/partner/bulk-fill-sheet/" + selection.join(",")'>
                                            <i class="fa fa-print fa-fw"></i>Print Fill Sheets
                                        </router-link>

                                    </li>
                                    <!--<li><a href="#">Separated link</a></li>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <hb-tablepaged
                                :columns="columns"
                                apiUrl="/api/orders/partner"
                                editRoute="/orders/partner/"
                                ref="hbtable"
                                :sortOrder="[{ field: 'id', direction: 'desc'}]"
                                :params="requestParams()"
                                :perPage="50"
                        ></hb-tablepaged>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <hb-modalbulkchange
            :items="selection"
            itemType="Orders"
            :action="this.doBulkChange"
        ></hb-modalbulkchange>
    </section>
</template>

<script>
    import moment from 'moment';
    import Vuetable from 'vuetable-2/src/components/Vuetable.vue'
    import VuetablePagination from 'vuetable-2/src/components/VuetablePagination.vue'

    export default {
        props:[],
        components: {
            Vuetable,
            VuetablePagination
        },
        data() {
            return {
                orders: {},
                columns: [
                    { name: '__checkbox', title: "#" },
                    { name: '__slot:link', title: "Order Id", sortField: 'id' },
                    { name: 'partner.title', title: "Partner", sortField: 'partner.title' },
                    { name: 'warehouse.title', title: "Warehouse", sortField: 'warehouse.title' },
                    { name: 'orderPeriod', title: "Order Period", callback: 'periodFormat', sortField: 'orderPeriod' },
                    { name: 'status', title: "Status", sortField: 'status' },
                    { name: 'createdAt', title: "Created", callback: 'dateTimeFormat', sortField: 'createdAt' },
                    { name: 'updatedAt', title: "Last Updated", callback: 'dateTimeFormat', sortField: 'updatedAt' },
                ],
                statuses: [
                    {id: "IN_PROCESS", name: "In Process"},
                    {id: "PENDING", name: "Pending"},
                    {id: "SHIPPED", name: "Shipped"},
                ],
                filters: {
                    status: null,
                    fulfillmentPeriod: null,
                    orderPeriod: null,
                    partner: {}
                },
                selection: [],
                bulkChange: {},
            };
        },
        methods: {
            routerLink: function (id) {
                return "<router-link to=\"/orders/partner/" + id + "\"><i class=\"fa fa-edit\"></i>" + id + "</router-link>";
            },
            onPaginationData (paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
            },
            onChangePage (page) {
                this.$refs.vuetable.changePage(page)
            },
            doFilter () {
                console.log('doFilter:', this.requestParams());
                this.$events.fire('filter-set', this.requestParams());
            },
            onSelectionChange (selection) {
                this.selection = selection;
            },
            bulkStatusChange (statusId) {
                $('#bulkChangeModal').modal('show');
                this.bulkChange = {
                    status: statusId
                };
            },
            doBulkChange () {
                let self = this;
                axios.patch('/api/orders/partner/bulk-change', {
                    ids: self.selection,
                    changes: self.bulkChange,
                })
                    .then(response => self.$refs.hbtable.refresh())
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            requestParams: function () {
                return {
                    status: this.filters.status || null,
                    fulfillmentPeriod: this.filters.fulfillmentPeriod || null,
                    orderPeriod: this.filters.orderPeriod || null,
                    partner: this.filters.partner.id || null,
                }
            },

        },
        mounted() {
            this.$events.$on('selection-change', eventData => this.onSelectionChange(eventData));
        }
    }
</script>