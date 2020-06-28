<template>
    <section class="content">
        <router-link
            :to="{ name: 'warehouse-new' }"
            class="btn btn-success btn-flat pull-right"
        >
            <i class="fa fa-plus-circle fa-fw" />Create Warehouse
        </router-link>
        <h3 class="box-title">
            Warehouse List
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
                        <div
                            v-if="loading"
                            class="loadingArea"
                        >
                            <pulse-loader
                                :loading="loading"
                                color="#3c8dbc"
                            />
                        </div>
                        <table
                            v-else
                            class="table table-hover"
                        >
                            <thead>
                                <tr>
                                    <th>Warehouse ID</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Last Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="warehouse in warehouses.data"
                                    :key="warehouse.id"
                                >
                                    <td>
                                        <router-link :to="{ name: 'warehouse-edit', params: { id: warehouse.id }}">
                                            <i class="fa fa-edit" />{{ warehouse.id }}
                                        </router-link>
                                    </td>
                                    <td v-text="warehouse.title" />
                                    <td v-text="warehouse.status" />
                                    <td>{{ warehouse.updatedAt | dateTimeFormat }}</td>
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
import PulseLoader from "vue-spinner/src/PulseLoader";

export default {
        components: {
            PulseLoader,
        },
        props:[],
        data() {
            return {
                warehouses: {},
                loading: true,
            };
        },
        created() {
            axios
                .get('/api/warehouses')
                .then(response => this.warehouses = response.data)
                .catch(error => {
                    console.log(error)
                })
                .finally(() => this.loading = false);
            console.log('Component mounted.')
        }
    }
</script>
