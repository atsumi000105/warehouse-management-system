<template>
    <section class="content">
        <div class="pull-right">
            <button class="btn btn-success btn-flat" v-on:click.prevent="save"><i class="fa fa-save fa-fw"></i>Save Product
            </button>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle dropdown btn-flat" data-toggle="dropdown">
                    <span class="fa fa-ellipsis-v"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" v-on:click.prevent="askDelete"><i class="fa fa-trash fa-fw"></i>Delete Product</a>
                    </li>
                </ul>
            </div>
        </div>
        <h3 class="box-title">Edit Product</h3>

        <div class="row">
            <div role="form">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="icon fa fa-tag fa-fw"></i>Product Info</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control" placeholder="Enter product name"
                                       v-model="product.name">
                            </div>
                            <div class="form-group">
                                <hb-optionlist
                                        v-model="product.productCategory"
                                        label="Product Category"
                                        apiPath="product-categories"></hb-optionlist>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" v-model="product.status">
                                    <option value="ACTIVE">Active</option>
                                    <option value="INACTIVE">Inactive</option>
                                    <option value="OUTOFSTOCK">Out of Stock</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Product SKU</label>
                                <input type="text" class="form-control" placeholder="Enter product SKU"
                                       v-model="product.sku">
                                <p class="help-block">This should match the SKU from the portal.</p>
                            </div>
                            <div class="form-group">
                                <label>Label Color</label>

                                    <input type="text" class="form-control colorpicker-element" v-model="product.color" v-colorpicker>

                                <p class="help-block">Click the color swatch on the right for a color picker. </p>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="icon fa fa-money fa-fw"></i>Pricing Info</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Default Cost Each</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                    <input type="text" class="form-control" v-model="product.defaultCost">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Retail Price Each</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                    <input type="text" class="form-control" v-model="product.retailPrice">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="info-box" v-if="!create">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-industry"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Current Warehouse Inventory</span>
                            <span class="info-box-number">{{ inventory.warehouse | numberFormat }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box" v-if="!create">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-sitemap"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Current Partner Inventory</span>
                            <span class="info-box-number">{{ inventory.partner | numberFormat }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box" v-if="!create">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-globe"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Current Total Network Inventory</span>
                            <span class="info-box-number">{{ inventory.total | numberFormat }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="icon fa fa-th fa-fw"></i>Packing Info</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Agency Packs Per Bag</label>
                                <input type="text" class="form-control" v-model="product.agencyPacksPerBag">
                            </div>
                            <div class="form-group">
                                <label>Agency Pack Size</label>
                                <input type="text" class="form-control" v-model="product.agencyPackSize">
                            </div>
                            <div class="form-group">
                                <label>Hospital Packs Per Bag</label>
                                <input type="text" class="form-control" v-model="product.hospitalPacksPerBag">
                            </div>
                            <div class="form-group">
                                <label>Hospital Pack Size</label>
                                <input type="text" class="form-control" v-model="product.hospitalPackSize">
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>

            </div>
        </div>
            <hb-modal :confirmAction="this.deleteProduct" classes="modal-danger" id="confirmModal">
                <template slot="header">Delete Product</template>
                <p>Are you sure you want to delete <strong>{{product.title}}</strong>?</p>
                <template slot="confirmButton">Delete Product</template>
            </hb-modal>
    </section>
</template>


<script>
    export default {
        props: ['create'],
        data() {
            return {
                product: {
                    productCategory: {},
                },
                inventory: {}
            };
        },
        methods: {
            save: function () {
                var self = this;
                if (this.create) {
                    axios.post('/api/products', this.product)
                        .then(response => self.$router.push('/products'))
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    axios.patch('/api/products/' + this.$route.params.id, this.product)
                        .then(response => self.$router.push('/products'))
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
            askDelete: function () {
                $('#confirmModal').modal('show');
            },
            deleteProduct: function () {
                var self = this;
                axios.delete('/api/products/' + this.$route.params.id).then(self.$router.push('/products'));
            },
            updateCat: function (value) {
                debugger;
            }
        },
        created() {
            var self = this;

            if (this.create) {
                this.product.contacts.push({isDeleted: false});
                this.product.addresses.push({isDeleted: false});
            } else {
                axios.get('/api/products/' + this.$route.params.id).then(response => self.product = response.data.data);
                axios.get('/api/products/' + this.$route.params.id + '/inventory').then(response => self.inventory = response.data);
            }
            console.log('Component mounted.')
        }
    }
</script>