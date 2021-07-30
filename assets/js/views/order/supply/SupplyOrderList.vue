<template>
    <section class="content">
        <router-link
            :to="{ name: 'order-supply-new' }"
            class="btn btn-success btn-flat pull-right"
        >
            <i class="fa fa-plus-circle fa-fw" />Create Supply Order
        </router-link>
        <h3 class="box-title">
            Supply Orders List
        </h3>
        <div class="row">
            <div class="col-xs-2">
                <supplier-selection-form v-model="filters.supplier" :address="false" label="Supplier" />
            </div>
            <div class="col-xs-2">
                <warehouse-selection-form v-model="filters.warehouse" label="Warehouse" />
            </div>
            <div class="col-xs-2">
                <option-list-static
                    v-model="filters.status"
                    label="Status"
                    :preloaded-options="statuses"
                    empty-string="-- All Statuses --"
                />
            </div>
            <div class="col-xs-2">
                <date-field
                    v-model="filters.startingAt"
                    label="Created Start"
                />
            </div>
            <div class="col-xs-2">
                <date-field
                    v-model="filters.endingAt"
                    label="Created End"
                />
            </div>
            <div class="col-xs-2">
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
                    <div class="box-header">
                        <!--
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table-paged
                            :columns="columns"
                            ref="hbtable"
                            api-url="/api/orders/supply"
                            edit-route="/orders/supply/"
                            :sort-order="[{ field: 'id', direction: 'desc'}]"
                            :params="requestParams()"
                            link-display-property="sequence"
                        />
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</template>

<script>
    import DateField from '../../../components/DateField.vue';
    import TablePaged from '../../../components/TablePaged.vue';
    import OptionListStatic from '../../../components/OptionListStatic.vue';
    import SupplierSelectionForm from '../../../components/SupplierSelectionForm';
    import WarehouseSelectionForm from '../../../components/WarehouseSelectionForm.vue'

    export default {
        components: {
            DateField,
            TablePaged,
            OptionListStatic,
            SupplierSelectionForm,
            WarehouseSelectionForm
        },
        data() {
            return {
                columns: [
                    { name: '__checkbox', title: "#" },
                    { name: '__slot:link', title: "Order Id", sortField: 'id' },
                    { name: 'supplier.title', title: "Supplier", sortField: 'supplier.title' },
                    { name: 'warehouse.title', title: "Warehouse", sortField: 'warehouse.title' },
                    { name: 'status', title: "Status", sortField: 'status' },
                    { name: 'createdAt', title: "Created", callback: 'dateTimeFormat', sortField: 'createdAt' },
                    { name: 'updatedAt', title: "Last Updated", callback: 'dateTimeFormat', sortField: 'updatedAt' },
                ],
                filters: {
                    status: null,
                    supplier: {},
                    warehouse: {},
                    startingAt: null,
                    endingAt: null
                },
                statuses: [
                    { id: "CREATING", name: "Creating" },
                    { id: "COMPLETED", name: "Completed" },
                    { id: "RECEIVED", name: "Received" },
                    { id: "ORDERED", name: "Ordered" },
                ],
            };
        },
        methods: {
            doFilter () {
                this.$events.fire('filter-set', this.requestParams());
            },
            requestParams: function () {
                return {
                status: this.filters.status || null,
                supplier: this.filters.supplier.id || null,
                warehouse: this.filters.warehouse.id || null,
                startingAt: this.filters.startingAt ? moment(this.filters.startingAt).startOf('day').toISOString() : null,
                endingAt: this.filters.endingAt ? moment(this.filters.endingAt).startOf('day').toISOString() : null,
                }
            },
        },
    }
</script>
