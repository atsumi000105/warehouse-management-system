<template>
    <section class="content">
        <div class="pull-right">
            <button class="btn btn-success btn-flat" v-on:click.prevent="save"><i class="fa fa-save fa-fw"></i>Save {{ name }}</button>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle dropdown btn-flat" data-toggle="dropdown">
                    <span class="fa fa-ellipsis-v"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" v-on:click.prevent="askDelete"><i class="fa fa-trash fa-fw"></i>Delete {{ name }}</a></li>
                </ul>
            </div>
        </div>
        <h3 class="box-title">Edit {{ name }}</h3>

        <div class="row">
            <form role="form">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="icon fa fa-folder-open-o fa-fw"></i>{{ listOption.name }}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
                            <div class="form-group">
                                <label>{{ name }} Name</label>
                                <input type="text" class="form-control" placeholder="Enter supplier name" v-model="listOption.name">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" v-model="listOption.status">
                                    <option value="ACTIVE">Active</option>
                                    <option value="INACTIVE">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input v-model="listOption.isPartnerOrderable" type="checkbox"> Can be ordered by a Partner
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
            </form>
        </div>
        <hb-modal :confirmAction="this.deleteListOption" classes="modal-danger" id="confirmModal">
            <template slot="header">Delete {{ name }}</template>
            <p>Are you sure you want to delete <strong>{{listOption.name}}</strong>?</p>
            <template slot="confirmButton">Delete {{ name }}</template>
        </hb-modal>
    </section>
</template>


<script>
    export default {
        props: ['new', 'name', 'apiPath'],
        data() {
            return {
                listOption: {
                    isPartnerOrderable: true,
                }
            };
        },
        methods: {
            save: function () {
                var self = this;
                if(this.new) {
                    axios.post('/api/' + this.apiPath, this.listOption)
                        .then(response => self.$router.push('/' + this.apiPath))
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    axios.patch('/api/' + this.apiPath + '/' + this.$route.params.id, this.listOption)
                        .then(response => self.$router.push('/' + this.apiPath))
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
            askDelete: function() {
                $('#confirmModal').modal('show');
            },
            deleteListOption: function() {
                var self = this;
                axios.delete('/api/' + this.apiPath + '/' + this.$route.params.id).then(self.$router.push('/' + this.apiPath));
            }
        },
        created() {
            var self = this;
            if(!this.new) {
                axios.get('/api/' + this.apiPath + '/' + this.$route.params.id).then(response => self.listOption = response.data.data);
            }
            console.log('Component mounted.')
        }
    }
</script>