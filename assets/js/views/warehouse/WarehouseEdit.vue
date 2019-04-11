<template>
    <section class="content">
        <div class="pull-right">
            <button class="btn btn-success btn-flat" v-on:click.prevent="save"><i class="fa fa-save fa-fw"></i>Save Warehouse</button>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle dropdown btn-flat" data-toggle="dropdown">
                    <span class="fa fa-ellipsis-v"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" v-on:click.prevent="askDelete"><i class="fa fa-trash fa-fw"></i>Delete Warehouse</a></li>
                </ul>
            </div>
        </div>
        <h3 class="box-title">Edit Warehouse</h3>

        <div class="row">
            <form role="form">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="icon fa fa-industry fa-fw"></i>Warehouse Info</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Warehouse Name</label>
                                <input type="text" class="form-control" placeholder="Enter warehouse name" v-model="warehouse.title">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" v-model="warehouse.status">
                                    <option value="ACTIVE">Active</option>
                                    <option value="INACTIVE">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="icon fa fa-map-marker fa-fw"></i>Location</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
                            <hb-addressform :address="warehouse.address"></hb-addressform>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>


                <div class="col-md-6">
                    <template v-for="(contact, key) in warehouse.contacts">
                        <div v-if="!contact.isDeleted" class="box box-info">
                            <div class="box-header with-border">
                                <button class="btn btn-xs btn-danger btn-flat pull-right" v-on:click.prevent="contact.isDeleted = true" title="Remove Contact"><i class="fa fa-trash fa-fw"></i></button>
                                <h3 class="box-title"><i class="icon fa fa-user fa-fw"></i>{{ contact.firstName }} {{ contact.lastName }}</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <hb-contact :contact="contact"></hb-contact>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <div v-else="" class="box box-danger bg-gray">
                            <div class="box-header">
                                <button class="btn btn-xs btn-info btn-flat pull-right" v-on:click.prevent="contact.isDeleted = false" title="Undo Delete"><i class="fa fa-undo fa-fw"></i></button>
                                <h3 class="box-title"><i class="icon fa fa-trash fa-fw"></i>Marked for deletion: {{ contact.firstName }} {{ contact.lastName }}</h3>
                            </div>
                        </div>
                    </template>
                    <button class="btn btn-info btn-flat pull-right" v-on:click.prevent="warehouse.contacts.push({isDeleted: false})"><i class="fa fa-plus fa-fw"></i> Add another contact</button>
                </div>

            </form>
        </div>
        <hb-modal :confirmAction="this.deleteWarehouse" classes="modal-danger" id="confirmModal">
            <template slot="header">Delete Warehouse</template>
            <p>Are you sure you want to delete <strong>{{warehouse.title}}</strong>?</p>
            <template slot="confirmButton">Delete Warehouse</template>
        </hb-modal>
    </section>
</template>


<script>
    export default {
        props: ['new'],
        data() {
            return {
                warehouse: {
                    address: {},
                    contacts: []
                }
            };
        },
        methods: {
            save: function () {
                var self = this;
                if(this.new) {
                    axios.post('/api/warehouses', this.warehouse)
                        .then(response => self.$router.push('/warehouses'))
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    axios.patch('/api/warehouses/' + this.$route.params.id, this.warehouse)
                        .then(response => self.$router.push('/warehouses'))
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
            askDelete: function() {
                $('#confirmModal').modal('show');
            },
            deleteWarehouse: function() {
                var self = this;
                axios.delete('/api/warehouses/' + this.$route.params.id).then(self.$router.push('/warehouses'));
            }
        },
        created() {
            var self = this;
            if(this.new) {
                this.warehouse.contacts.push({ isDeleted: false });
            } else {
                axios.get('/api/warehouses/' + this.$route.params.id).then(response => self.warehouse = response.data.data);
            }
            console.log('Component mounted.')
        }
    }
</script>