<template>
    <section class="content">
        <div class="pull-right">
            <button class="btn btn-success btn-flat" v-on:click.prevent="save"><i class="fa fa-save fa-fw"></i>Save Group</button>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle dropdown btn-flat" data-toggle="dropdown">
                    <span class="fa fa-ellipsis-v"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" v-on:click.prevent="askDelete"><i class="fa fa-trash fa-fw"></i>Delete Group</a></li>
                </ul>
            </div>
        </div>
        <h3 class="box-title">Edit Group</h3>

        <div class="row">
            <form group="form">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="icon fa fa-group fa-fw"></i>Group Info</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Group Name</label>
                                <input type="text" class="form-control" placeholder="Enter group name" v-model="group.name">
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
                                <div v-for="role in roles">
                                    <input type="checkbox" name="role[]" :id="role" :value="role" v-model="group.roles"/>
                                    <label :for="role">{{ role }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <hb-modal :confirmAction="this.deleteGroup" classes="modal-danger" id="confirmModal">
            <template slot="header">Delete Group</template>
            <p>Are you sure you want to delete <strong>{{group.name}}</strong>?</p>
            <template slot="confirmButton">Delete Group</template>
        </hb-modal>
    </section>
</template>


<script>
    export default {
        props: ['new'],
        data() {
            return {
                group: {
                    roles: [],
                },
                roles: [],
            };
        },
        methods: {
            save: function () {
                var self = this;
                if(this.new) {
                    axios.post('/api/groups', this.group)
                        .then(response => self.$router.push('/admin/groups'))
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    axios.patch('/api/groups/' + this.$route.params.id, this.group)
                        .then(response => self.$router.push('/admin/groups'))
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
            askDelete: function() {
                $('#confirmModal').modal('show');
            },
            deleteGroup: function() {
                var self = this;
                axios.delete('/api/groups/' + this.$route.params.id).then(self.$router.push('/admin/groups'));
            }
        },
        created() {
            var self = this;

            if(!this.new) {
                axios.get('/api/groups/' + this.$route.params.id).then(response => self.group = response.data.data);
            }

            axios.get('/api/groups/list-roles').then(response => self.roles = response.data);

            console.log('Component mounted.')
        }
    }
</script>