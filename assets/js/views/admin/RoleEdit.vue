<template>
    <section class="content">
        <div class="pull-right">
            <button class="btn btn-success btn-flat" v-on:click.prevent="save"><i class="fa fa-save fa-fw"></i>Save Role</button>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle dropdown btn-flat" data-toggle="dropdown">
                    <span class="fa fa-ellipsis-v"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" v-on:click.prevent="askDelete"><i class="fa fa-trash fa-fw"></i>Delete Role</a></li>
                </ul>
            </div>
        </div>
        <h3 class="box-title">Edit Role</h3>

        <div class="row">
            <form role="form">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="icon fa fa-group fa-fw"></i>Role Info</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Role Name</label>
                                <input type="text" class="form-control" placeholder="Enter role name" v-model="role.name">
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="icon fa fa-lock fa-fw"></i>Permissions</h3>
                            <div class="box-body">
                                <div v-for="permission in permissions">
                                    <input type="checkbox" name="permission[]" :id="permission" :value="permission" v-model="role.permissions"/>
                                    <label :for="permission">{{ permission }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <hb-modal :confirmAction="this.deleteRole" classes="modal-danger" id="confirmModal">
            <template slot="header">Delete Role</template>
            <p>Are you sure you want to delete <strong>{{role.name}}</strong>?</p>
            <template slot="confirmButton">Delete Role</template>
        </hb-modal>
    </section>
</template>


<script>
    export default {
        props: ['new'],
        data() {
            return {
                role: {
                    permissions: [],
                },
                permissions: [],
            };
        },
        methods: {
            save: function () {
                var self = this;
                if(this.new) {
                    axios.post('/api/roles', this.role)
                        .then(response => self.$router.push('/admin/roles'))
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    axios.patch('/api/roles/' + this.$route.params.id, this.role)
                        .then(response => self.$router.push('/admin/roles'))
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
            askDelete: function() {
                $('#confirmModal').modal('show');
            },
            deleteRole: function() {
                var self = this;
                axios.delete('/api/roles/' + this.$route.params.id).then(self.$router.push('/admin/roles'));
            }
        },
        created() {
            var self = this;

            if(!this.new) {
                axios.get('/api/roles/' + this.$route.params.id).then(response => self.role = response.data.data);
            }

            axios.get('/api/roles/list-permissions').then(response => self.permissions = response.data);

            console.log('Component mounted.')
        }
    }
</script>