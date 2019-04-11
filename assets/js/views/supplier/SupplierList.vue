<template>
    <section class="content">
        <router-link to="/suppliers/new" class="btn btn-success btn-flat pull-right"><i class="fa fa-plus-circle fa-fw"></i>Create Supplier</router-link>
        <h3 class="box-title">Suppliers List</h3>

        <div class="row">
            <div class="col-xs-2">
                <div class="form-group">
                    <label>Keyword</label>
                    <input type="text" class="form-control" v-model="filters.keyword" />
                </div>
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <label>Type</label>
                    <select class="form-control" v-model="filters.supplierType" v-chosen>
                        <option value="">--All Supplier Types--</option>
                        <option value="DONOR">Donor</option>
                        <option value="VENDOR">Vendor</option>
                        <option value="DIAPERDRIVE">Diaper Drive</option>
                        <option value="DROPSITE">Dropsite</option>
                    </select>
                </div>
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
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="col-xs-12">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown" :disabled="selection.length == 0">
                                    <i class="fa fa-fw fa-wrench"></i>
                                    Bulk Operations ({{selection.length}})
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a @click="onClickMerge()">
                                            <i class="fa fa-compress-alt fa-fw"></i>Merge Suppliers
                                        </a>
                                    </li>
                                    <!--<li><a href="#">Separated link</a></li>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hb-tablepaged
                            :columns="columns"
                            apiUrl="/api/suppliers"
                            editRoute="/suppliers/"
                            ref="hbtable"
                            :sortOrder="[{ field: 'title', direction: 'asc'}]"
                            :params="requestParams()"
                            :perPage="50"
                    ></hb-tablepaged>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <SupplierMerge :selectedSupplierIds="selection" ref="supplierMerge"></SupplierMerge>
    </section>
</template>

<script>
    import SupplierMerge from './SupplierMerge.vue';

    export default {
        components: {SupplierMerge},
        props:[],
        data() {
            let columns = [
                { name: '__checkbox', title: "#" },
                { name: '__slot:link', title: "Supplier Id", sortField: 'id' },
                { name: "title", title: "Supplier", sortField: "title" },
                { name: "supplierType", title: "Supplier Type", sortField: "supplierType" },
                { name: "status", title: "Status", sortField: "status" },
                { name: 'updatedAt', title: "Last Updated", callback: 'dateTimeFormat', sortField: 'updatedAt' },
            ];

            return {
                columns: columns,
                suppliers: {},
                statuses: [
                    {id: "ACTIVE", name: "Active"},
                    {id: "INACTIVE", name: "Inactive"},
                ],
                filters: {
                    supplierType: null,
                    status: "ACTIVE",
                    keyword: null
                },
                selection: [],
            };
        },
        methods: {
            routerLink: function (id) {
                return "<router-link to=\"/suppliers/" + id + "\"><i class=\"fa fa-edit\"></i>" + id + "</router-link>";
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
            refreshTable()  {
                this.$refs.hbtable.refresh();
            },
            doBulkChange () {
                let self = this;
                axios.patch('/api/supplier/bulk-change', {
                    ids: self.selection,
                    changes: self.bulkChange,
                })
                    .then(response => self.refreshTable())
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            requestParams: function () {
                return {
                    status: this.filters.status || null,
                    supplierType: this.filters.supplierType || null,
                    keyword: this.filters.keyword || null
                }
            },
            onClickMerge: function () {
                this.$refs.supplierMerge.reset();
                $('#supplierMergeModal').modal('show');
            }
        },
        created() {
            axios.get('/api/suppliers').then(response => this.suppliers = response.data);
            console.log('Component mounted.')
        },
        mounted() {
            this.$events.$on('selection-change', eventData => this.onSelectionChange(eventData));
        }
    }
</script>