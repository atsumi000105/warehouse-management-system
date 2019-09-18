<template>
    <section class="content">
        <router-link
            to="/admin/groups/new"
            class="btn btn-success btn-flat pull-right"
        >
            <i class="fa fa-plus-circle fa-fw" />
            Create Attribute
        </router-link>
        <h3 class="box-title">
            Partner Profile Attribute List
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
                                    <th>Name</th>
                                    <th>Label</th>
                                    <th>Type</th>
                                    <th>Order</th>
                                    <th>Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="definition in definitions"
                                    :key="definition.id"
                                >
                                    <td>
                                        <router-link :to="'/admin/attributes/partner/' + definition.id">
                                            <i class="fa fa-edit" />{{ definition.label }}
                                        </router-link>
                                    </td>
                                    <td v-text="definition.name"></td>
                                    <td>{{ definition.type | orderStatusFormat }}</td>
                                    <td v-text="definition.indexOrder"></td>
                                    <td>{{ definition.updatedAt | dateTimeFormat }}</td>
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
                definitions: []
            };
        },
        created() {
            axios
                .get('/api/partner/attribute/definition')
                .then(response => this.definitions = response.data.data);
        }
    }
</script>