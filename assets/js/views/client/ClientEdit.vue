<template>
    <section class="content">
        <div class="pull-right">
            <button
                class="btn btn-success btn-flat"
                @click.prevent="save"
            >
                <i class="fa fa-save fa-fw" />
                Save Client
            </button>
            <div class="btn-group">
                <button
                    type="button"
                    class="btn btn-default dropdown-toggle dropdown btn-flat"
                    data-toggle="dropdown"
                >
                    <span class="fa fa-ellipsis-v" />
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a
                            href="#"
                            @click.prevent="askDelete"
                        >
                            <i class="fa fa-trash fa-fw" />Delete Client</a>
                    </li>
                </ul>
            </div>
        </div>
        <h3 class="box-title">
            Edit Client
        </h3>

        <div class="row">
            <form role="form">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="icon fa fa-group fa-fw" />Client Info
                            </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
                            <div class="form-group">
                                <label>First Name</label>
                                <input
                                    v-model="client.name.firstName"
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter first name"
                                >

                                <label>Last Name</label>
                                <input
                                    v-model="client.name.lastName"
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter last name"
                                >
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border" />
                    </div>
                </div>
            </form>
        </div>
        <hb-modal
            id="confirmModal"
            :confirm-action="deleteClient"
            classes="modal-danger"
        >
            <template slot="header">
                Delete Client
            </template>
            <p>Are you sure you want to delete <strong>{{ client.name.firstName }} {{ client.name.lastName }}</strong>?</p>
            <template slot="confirmButton">
                Delete Client
            </template>
        </hb-modal>
    </section>
</template>

<script>
    export default {
        name: 'ClientEdit',
        props: {
            new: {
                type: String,
                default: '',
                required: false
            }

        },
        data() {
            return {
                client: {
                    name: {}
                },
            };
        },
        created() {
            let self = this;

            if (!this.new) {
                axios
                    .get('/api/clients/' + this.$route.params.id, {params: {}})
                    .then(response => {
                        self.client = response.data.data;
                    })
                    .catch(error => console.log("Error receiving clients %o", error));
            }

            console.log('ClientEdit Component mounted.');
        },
        methods: {
            save: function () {
                let self = this;
                if (this.new) {
                    axios
                        .post('/api/clients', this.client)
                        .then(response => self.$router.push('/clients'))
                        .catch(function (error) {
                            console.log("Save this.client error %o", error);
                        });
                } else {
                    axios
                        .patch('/api/clients/' + this.$route.params.id, this.client)
                        .then(response => self.$router.push('/clients'))
                        .catch(function (error) {
                            console.log("Save this.client error with params id %o", error);
                        });
                }
            },
            askDelete: function() {
                $('#confirmModal').modal('show');
            },
            deleteClient: function() {
                let self = this;
                axios
                    .delete('/api/clients/' + this.$route.params.id)
                    .then(self.$router.push('/admin/clients'));
            }
        }
    }
</script>

<style scoped>

</style>