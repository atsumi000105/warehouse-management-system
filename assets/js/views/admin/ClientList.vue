<template>
    <section class="content">
        <router-link
            to="/admin/clients/new"
            class="btn btn-success btn-flat pull-right"
        >
            <i class="fa fa-plus-circle fa-fw" />
            Create Client
        </router-link>
        <h3 class="box-title">
            Clients List
        </h3>

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
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Client ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Last Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="client in clients.data"
                                    :key="client.id"
                                >
                                    <td>
                                        <router-link :to="'/admin/clients/' + client.id">
                                            <i class="fa fa-edit" />{{ client.id }}
                                        </router-link>
                                    </td>
                                    <td v-text="client.name.firstName" />
                                    <td v-text="client.name.lastName" />
                                    <td>{{ client.updatedAt | dateTimeFormat }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props:[],
        data() {
            return {
                clients: []
            }
        },
        created() {
            axios
                .get('/api/clients')
                .then(response => this.clients = response.data);
            console.log('Component mounted.');
        }
    }
</script>