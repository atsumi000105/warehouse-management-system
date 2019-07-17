<template>
    <section class="content">
        <div class="pull-right">
            <button
                class="btn btn-success btn-flat"
                :disabled="!order.isEditable"
                @click.prevent="saveVerify"
            >
                <i class="fa fa-save fa-fw" />Save Order
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
                    <li v-if="order.isDeletable">
                        <a
                            href="#"
                            @click.prevent="askDelete"
                        >
                            <i class="fa fa-trash fa-fw" />Delete Order
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <h3 class="box-title">
            Edit Supply Order
        </h3>

        <form role="form">
            <div class="row">
                <div class="col-md-4">
                    <hb-ordermetadatabox
                        :order="order"
                        order-type="Supply Order"
                        :statuses="statuses"
                        :editable="order.isEditable"
                        :v="$v.order"
                    />
                </div>

                <div class="col-md-8">
                    <div class="box box-info">
                        <div class="box-body">
                            <div
                                class="col-md-6"
                                :class="{ 'has-error': $v.order.supplier.$error }"
                            >
                                <h3 class="box-title">
                                    <i class="icon fa fa-group fa-fw" />Supplier
                                </h3>
                                <hb-supplierselectionform
                                    v-model="order.supplier"
                                    :address-value="order.supplierAddress"
                                    :editable="order.isEditable"
                                />
                                <hb-fielderror v-if="$v.order.supplier.$error">
                                    Field is required
                                </hb-fielderror>
                            </div>

                            <div
                                class="col-md-6"
                                :class="{ 'has-error': $v.order.warehouse.$error}"
                            >
                                <h3 class="box-title">
                                    <i class="icon fa fa-industry fa-fw" />Destination Warehouse
                                </h3>
                                <hb-warehouseselectionform
                                    v-model="order.warehouse"
                                    :editable="order.isEditable"
                                />
                                <hb-fielderror v-if="$v.order.warehouse.$error">
                                    Field is required
                                </hb-fielderror>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div
                        class="box box-info"
                        :class="{ 'has-error': $v.order.lineItems.$error }"
                    >
                        <div class="box-header with-border">
                            <hb-fielderror
                                v-if="$v.order.lineItems.$error"
                                classes="pull-right"
                            >
                                At least one line item must have a quantity
                            </hb-fielderror>
                            <h3 class="box-title">
                                <i class="icon fa fa-list fa-fw" />Line Items
                            </h3>
                        </div>
                        <hb-lineitemform
                            :products="products"
                            :show-cost="true"
                            :line-items="order.lineItems"
                            :editable="order.isEditable"
                        />
                    </div>
                </div>
            </div>
        </form>
        <hb-modalinvalid />
        <hb-modaldelete
            :action="this.deleteOrder"
            :order-title="order.title"
        />
        <hb-modalcomplete
            :action="this.save"
            :order-title="order.title"
        />
    </section>
</template>


<script>
    import { required } from 'vuelidate/lib/validators';
    import { linesRequired, mod } from '../../../validators';

    export default {
        props: ['new'],
        data() {
            return {
                order: {
                    lineItems: [],
                    supplier: { id: null, addresses: [] },
                    supplierAddress: { id: null },
                    warehouse: { id: null },
                    isEditable: true,
                    isDeletable: false,
                    status: 'RECEIVED',
                    receivedAt: '',
                },
                products: [],
                statuses: [
                    {id: "ORDERED", name: "Ordered"},
                    {id: "RECEIVED", name: "Received", commit: true },
                ]
            };
        },
        validations: {
            order: {
                supplier: {
                    id: {
                        required
                    }
                },
                warehouse: {
                    id: {
                        required
                    }
                },
                status: {
                    required
                },
                lineItems: { linesRequired }
            }
        },
        computed: {
            statusIsCompleted: function () {
                var self = this;
                var status = this.statuses.filter(function(item) {
                    return self.order.status == item.id
                });
                return status[0].commit === true;
            }
        },
        created() {
            var self = this;
            axios
                .get('/api/products')
                .then(response => this.products = response.data.data);
            if (this.new) {
            } else {
                axios
                    .get('/api/orders/supply/' + this.$route.params.id, {
                        params: { include: ['lineItems', 'lineItems.product', 'lineItems.transactions', 'supplier.addresses', 'supplierAddress']}
                    })
                    .then(response => self.order = response.data.data);
            }
            console.log('Component mounted.')
        },
        methods: {
            saveVerify: function () {
                this.$v.$touch();
                if (this.$v.$invalid) {
                    $('#invalidModal').modal('show');
                    return false;
                }
                if (this.statusIsCompleted) {
                    $('#confirmCommitModal').modal('show');
                } else {
                    this.save();
                }
            },
            save: function () {
                var self = this;
                if (this.new) {
                    axios
                        .post('/api/orders/supply', this.order)
                        .then(response => self.$router.push('/orders/supply'))
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    axios
                        .patch('/api/orders/supply/' + this.$route.params.id, this.order)
                        .then(response => self.$router.push('/orders/supply'))
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
            askDelete: function() {
                $('#confirmModal').modal('show');
            },
            deleteOrder: function() {
                var self = this;
                axios
                    .delete('/api/orders/supply/' + this.$route.params.id)
                    .then(self.$router.push('/orders/supply'));
            }
        }
    }
</script>