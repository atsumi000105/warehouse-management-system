<template>
    <section class="content">
        <h3 class="box-title">Stock Levels</h3>

        <div class="row">
            <div class="col-xs-4">
                <hb-storagelocationselectionform
                        v-model="filters.location"
                ></hb-storagelocationselectionform>
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <label>Location Type</label>
                    <select class="form-control" v-model="filters.locationType" v-chosen>
                        <option value="">--All Location Types--</option>
                        <option value="WAREHOUSE">Warehouses</option>
                        <option value="PARTNER">Partners</option>
                    </select>
                </div>
            </div>

            <div class="form-group col-xs-4">
                <hb-date v-model="filters.endingAt" label="Date" ></hb-date>
            </div>
            <div class="col-xs-1 text-right">
                <button class="btn btn-success btn-flat" @click="doFilter"><i class="fa fa-fw fa-filter"></i>Filter</button>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th class="text-right">All Stock
                                    <i class="fa fa-question-circle"
                                       title="This level represents all stock physically located on-site"
                                       v-tooltip="'bottom'"></i></th>
                                <th class="text-right">Stock (including pending orders)
                                    <i class="fa fa-question-circle"
                                       title="This level represents stock on-site including any pending partner orders where products are allocated but not shipped"
                                       v-tooltip="'bottom'"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="product in products">
                                <td><router-link :to="'/products/' + product.id"><i class="fa fa-edit"></i>{{ product.id }}</router-link></td>
                                <td v-text="product.name"></td>
                                <td v-text="product.category"></td>
                                <td v-text="product.balance.toLocaleString()" class="text-right"></td>
                                <td v-text="product.availableBalance.toLocaleString()" class="text-right"></td>
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
                products: {},
                locations: [],
                filters: {
                    locationType: '',
                    location: {},
                    endingAt: moment().format('YYYY-MM-DD')
                },
            };
        },
        methods: {
            doFilter: function(event) {
                this.products = {};
                this.getLevels();
            },
            getLevels: function() {
                axios.get('/api/stock-levels', { params: this.buildParams() }).then(response => this.products = response.data);
            },
            buildParams: function () {
                return {
                    locationType: this.filters.locationType,
                    location: this.filters.location.id || null,
                    endingAt: moment(this.filters.endingAt).endOf('day').toISOString()
                }
            }
        },
        created() {
            this.getLevels();
            console.log('Component mounted.')
        }
    }
</script>