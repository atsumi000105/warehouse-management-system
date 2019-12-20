<template>
    <section class="content">
        <router-link
            :to="{ name: 'client-new' }"
            class="btn btn-success btn-flat pull-right"
        >
            <i class="fa fa-plus-circle fa-fw" />
            Create Client
        </router-link>
        <h3 class="box-title">
            Client List
        </h3>
        <div class="row">
            <div class="col-xs-2">
                <div class="form-group">
                    <label>Keyword</label>
                    <input
                        v-model="filters.keyword"
                        type="text"
                        class="form-control"
                    >
                </div>
            </div>

            <div class="col-xs-3">
                <button
                    class="btn btn-success btn-flat"
                    @click="doFilter"
                >
                    <i class="fa fa-fw fa-filter" />Filter
                </button>
            </div>
        </div>

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
                        <div v-if="loading" class="loadingArea">
                            <pulse-loader :loading="loading" color="#3c8dbc" />
                        </div>
                        <hb-tablepaged
                            v-else
                            ref="hbtable"
                            :columns="columns"
                            api-url="/api/clients/"
                            edit-route="/clients/"
                            :sort-order="[{ field: 'id', direction: 'desc'}]"  
                            :params="requestParams()"                         
                            :per-page="50"
                        />
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</template>

<script>
    import TablePaged from '../../components/TablePaged.vue';
    import PulseLoader from "vue-spinner/src/PulseLoader";
    export default {
        components: {
            'hb-tablepaged' : TablePaged,
            PulseLoader,
        },
        props:[],
        data() {
            return {
                clients: [],
                loading: true,
                columns: [
                    { name: '__slot:link', title: "Client Id", sortField: 'id' },
                    //todo: find a better way to sort value objects #30
                    { name: 'name.firstName', title: "First Name", sortField: 'c.name.firstname' },
                    { name: 'name.lastName', title: "Last Name", sortField: 'c.name.lastname' },
                    { name: 'createdAt', title: "Created", callback: 'dateTimeFormat', sortField: 'createdAt' },
                    { name: 'updatedAt', title: "Last Updated", callback: 'dateTimeFormat', sortField: 'updatedAt' },
                ],
                filters: {
                    keyword: null
                },       
            }
        },
        created() {
            axios
                .get('/api/clients')
                .then(response => this.clients = response.data)
                .catch(error => {
                    console.log(error)
                })
                .finally(() => this.loading = false);
            console.log('Component mounted.');
        },
        methods: {

            doFilter () {
                console.log('doFilter:', this.requestParams());
                this.$events.fire('filter-set', this.requestParams());
            },
            requestParams: function () {
                return {
                    keyword: this.filters.keyword || null
                }
            },
        },
    }
</script>
