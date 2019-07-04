<template>
    <section class="content">
        <router-link
            to="/admin/groups/new"
            class="btn btn-success btn-flat pull-right"
        >
            <i class="fa fa-plus-circle fa-fw" />
            Create Role
        </router-link>
        <h3 class="box-title">
            Groups List
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
                                    <th>Role ID</th>
                                    <th>Name</th>
                                    <th>Last Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="role in groups.data">
                                    <td>
                                        <router-link :to="'/admin/groups/' + role.id">
                                            <i class="fa fa-edit" />{{ role.id }}
                                        </router-link>
                                    </td>
                                    <td v-text="role.name" />
                                    <td>{{ role.updatedAt | dateTimeFormat }}</td>
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
                groups: {}
            };
        },
        created() {
            axios
                .get('/api/groups')
                .then(response => this.groups = response.data);
            console.log('Component mounted.')
        }
    }
</script>