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
            Edit Transfer Order
        </h3>

        <form role="form">
            <div class="row">
                <div class="col-md-4">
                    <hb-ordermetadatabox
                        :order="order"
                        order-type="Transfer Order"
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
                                :class="{ 'has-error': $v.order.sourceLocation.$error }"
                            >
                                <h3 class="box-title">
                                    <i class="icon fa fa-industry fa-fw" />Source Location
                                </h3>
                                <hb-storagelocationselectionform
                                    v-model="order.sourceLocation"
                                    :editable="order.isEditable"
                                />
                                <hb-fielderror v-if="$v.order.sourceLocation.$error">
                                    Field is required
                                </hb-fielderror>
                            </div>

                            <div
                                class="col-md-6"
                                :class="{ 'has-error': $v.order.targetLocation.$error }"
                            >
                                <h3 class="box-title">
                                    <i class="icon fa fa-industry fa-fw" />Destination Location
                                </h3>
                                <hb-storagelocationselectionform
                                    v-model="order.targetLocation"
                                    :editable="order.isEditable"
                                />
                                <hb-fielderror v-if="$v.order.targetLocation.$error">
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
    import ModalOrderConfirmComplete from '../../../components/ModalOrderConfirmComplete.vue';
    import ModalOrderConfirmDelete from '../../../components/ModalOrderConfirmDelete.vue';
    import ModalOrderInvalid from '../../../components/ModalOrderInvalid.vue';
    export default {
        components: { ModalOrderConfirmComplete, ModalOrderConfirmDelete, ModalOrderInvalid },
        props: ['new'],
        data() {
            return {
                order: {
                    lineItems: [],
                    sourceLocation: { id: null },
                    targetLocation: { id: null },
                    isEditable: true,
                    isDeletable: false,
                    status: 'COMPLETED',
                },
                products: [],
                statuses: [
                    {id: "COMPLETED", name: "Completed", commit: true },
                ]
            };
        },
        validations: {
            order: {
                sourceLocation: {
                    id: {
                        required
                    }
                },
                targetLocation: {
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
                    .get('/api/orders/transfer/' + this.$route.params.id, {
                        params: { include: ['lineItems', 'lineItems.product', 'lineItems.transactions', ]}
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
                        .post('/api/orders/transfer', this.order)
                        .then(response => self.$router.push('/orders/transfer'))
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    axios
                        .patch('/api/orders/transfer/' + this.$route.params.id, this.order)
                        .then(response => self.$router.push('/orders/transfer'))
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
                    .delete('/api/orders/transfer/' + this.$route.params.id)
                    .then(self.$router.push('/orders/transfer'));
            }
        }
    }
</script>
