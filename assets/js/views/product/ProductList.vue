<template>
    <section class="content">
        <router-link
            :to="{ name: 'product-new' }"
            class="btn btn-success btn-flat pull-right"
        >
            <i class="fa fa-plus-circle fa-fw" />Create Product
        </router-link>
        <h3 class="box-title">
            Products List
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
                                    <th>Product ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Last Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="product in products.data"
                                    :key="product.id"
                                >
                                    <td>
                                        <router-link :to="{ name: 'product-edit', params: { id: product.id }}">
                                            <i class="fa fa-edit" />{{ product.id }}
                                        </router-link>
                                    </td>
                                    <td v-text="product.name" />
                                    <td v-text="product.productCategory.name" />
                                    <td v-text="product.status" />
                                    <td>{{ product.updatedAt | dateTimeFormat }}</td>
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
                products: {}
            };
        },
        created() {
            axios
                .get('/api/products')
                .then(response => this.products = response.data);
            console.log('Component mounted.')
        }
    }
</script>
