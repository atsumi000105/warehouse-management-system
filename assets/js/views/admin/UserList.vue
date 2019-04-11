<template>
    <section class="content">
        <router-link to="/admin/users/new" class="btn btn-success btn-flat pull-right"><i class="fa fa-plus-circle fa-fw"></i>Create User</router-link>
        <h3 class="box-title">Users List</h3>

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
                                <th>User ID</th>
                                <th>User Email</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Roles</th>
                                <th>Last Updated</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users.data">
                                <td><router-link :to="'/admin/users/' + user.id"><i class="fa fa-edit"></i>{{ user.id }}</router-link></td>
                                <td v-text="user.email"></td>
                                <td v-text="user.name.firstName"></td>
                                <td v-text="user.name.lastName"></td>
                                <td>
                                    <ul class="bulletless-list">
                                        <li v-for="role in user.roles">
                                            {{ role.name }}
                                        </li>
                                    </ul>
                                </td>
                                <td>{{ user.updatedAt | dateTimeFormat }}</td>
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
                users: {
                    roles: []
                },
                roles: []
            };
        },
        created() {
            axios.get('/api/users', {params: {include: ['roles']}})
                .then(response => {
                    this.users = response.data;
                });
        }
    }
</script>

<style scoped>
    .bulletless-list {
        display: inline;
        list-style: none;
        margin: 0;
        padding: 0;
    }
</style>
