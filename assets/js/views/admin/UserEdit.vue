<template>
    <section class="content">
        <div class="pull-right">
            <button class="btn btn-success btn-flat" v-on:click.prevent="save"><i class="fa fa-save fa-fw"></i>Save User</button>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle dropdown btn-flat" data-toggle="dropdown">
                    <span class="fa fa-ellipsis-v"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" v-on:click.prevent="askDelete"><i class="fa fa-trash fa-fw"></i>Delete User</a></li>
                </ul>
            </div>
        </div>
        <h3 class="box-title">Edit User</h3>

        <div class="row">
            <form role="form">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="icon fa fa-group fa-fw"></i>User Info</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
                            <div class="form-group">

                                <label>First Name</label>
                                <input type="text" class="form-control" placeholder="Enter first name" v-model="user.name.firstName"/>

                                <label>Last Name</label>
                                <input type="text" class="form-control" placeholder="Enter last name" v-model="user.name.lastName"/>

                                <label>Email Address</label>
                                <input type="email" class="form-control" placeholder="Enter email address" v-model="user.email"/>

                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Enter new password" v-model="user.password"/>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="icon fa fa-lock fa-fw"></i>Roles</h3>
                            <div class="box-body">
                                <div v-for="sysRole in sysRoles">
                                    <input type="checkbox" name="role[]" :id="sysRole.id" :value="sysRole" v-model="user.roles"/>
                                    <label :for="sysRole">{{ sysRole.name }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <hb-modal :confirmAction="this.deleteUser" classes="modal-danger" id="confirmModal">
            <template slot="header">Delete User</template>
            <p>Are you sure you want to delete <strong>{{user.name.firstName}} {{user.name.lastName}}</strong>?</p>
            <template slot="confirmButton">Delete User</template>
        </hb-modal>
    </section>
</template>


<script>
    export default {
        props: ['new'],
        data() {
            return {
                user: {
                    name: {},
                    roles: []
                },
                sysRoles: {},
            };
        },
        methods: {
            save: function () {
                let self = this;
                if(this.new) {
                    axios.post('/api/users', this.user)
                        .then(response => self.$router.push('/admin/users'))
                        .catch(function (error) {
                            console.log("Save this.user error %o", error);
                        });
                } else {
                    axios.patch('/api/users/' + this.$route.params.id, this.user)
                        .then(response => self.$router.push('/admin/users'))
                        .catch(function (error) {
                            console.log("Save this.user error with params id %o", error);
                        });
                }
            },
            askDelete: function() {
                $('#confirmModal').modal('show');
            },
            deleteUser: function() {
                let self = this;
                axios.delete('/api/users/' + this.$route.params.id).then(self.$router.push('/admin/users'));
            }
        },
        created() {
            let self = this;

            if(!this.new) {
                axios.get('/api/users/' + this.$route.params.id, {params: {include: ['roles']}})
                    .then(response => {
                        self.user = response.data.data;
                    })
                    .catch(error => console.log("Error receiving users %o", error));
            }

            axios.get('/api/roles')
                .then(response => {
                    self.sysRoles = response.data.data;
                })
                .catch(error => console.log("Error receiving roles %o", error));

            console.log('UserEdit Component mounted.');
        }
    }
</script>
