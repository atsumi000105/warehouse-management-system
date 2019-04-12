<template>
    <section class="content">
        <router-link to="/orders/distribution/new" class="btn btn-success btn-flat pull-right"><i class="fa fa-plus-circle fa-fw"></i>Create Partner Distribution</router-link>
        <h3 class="box-title">Partner Distributions List</h3>

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
                                    <li><a @click="bulkDelete()"><i class="fa fa-fw fa-trash"></i>Delete Distributions</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <hb-tablepaged
                                :columns="columns"
                                ref="hbtable"
                                apiUrl="/api/orders/distribution"
                                editRoute="/orders/distribution/"
                                :sortOrder="[{ field: 'id', direction: 'desc'}]"
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
                itemType="Distributions"
                :action="this.doBulkChange"
        ></hb-modalbulkchange>
        <hb-modalbulkdelete
                :items="selection"
                itemType="Distributions"
                :action="this.doBulkDelete"
                bulkChangeType="delete"
        ></hb-modalbulkdelete>
    </section>
</template>

<script>
    export default {
        props:[],
        data() {
            return {
                orders: {},
                columns: [
                    { name: '__checkbox', title: "#" },
                    { name: '__slot:link', title: "Order Id", sortField: 'id' },
                    { name: 'partner.title', title: "Partner", sortField: 'partner.title' },
                    { name: 'status', title: "Status", sortField: 'status' },
                    { name: 'createdAt', title: "Created", callback: 'dateTimeFormat', sortField: 'createdAt' },
                    { name: 'updatedAt', title: "Last Updated", callback: 'dateTimeFormat', sortField: 'updatedAt' },
                ],
                statuses: [
                    {id: "COMPLETED", name: "Completed"},
                ],
                selection: [],
            };
        },
        methods: {
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
                axios.patch('/api/orders/bulk-distribution/bulk-change', {
                    ids: self.selection,
                    changes: self.bulkChange,
                })
                    .then(response => self.$refs.hbtable.refresh())
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            bulkDelete (statusId) {
                $('#bulkDeleteModal').modal('show');
                this.bulkChange = {
                    status: statusId
                };
            },
            doBulkDelete () {
                let self = this;
                axios.patch('/api/orders/bulk-distribution/bulk-delete', {
                    ids: self.selection,
                })
                    .then(response => {
                        self.$refs.hbtable.refresh(),
                        self.$refs.hbtable.clearSelected()
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
        },
        mounted() {
            this.$events.$on('selection-change', eventData => this.onSelectionChange(eventData));
        },
    }
</script>