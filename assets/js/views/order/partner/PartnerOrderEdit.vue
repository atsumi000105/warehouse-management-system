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
                    <li>
                        <router-link :to="'/orders/partner/' + order.id + '/fill-sheet'">
                            <i class="fa fa-print fa-fw" />Print Fill Sheet
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
        <h3 class="box-title">
            Edit Partner Order
        </h3>

        <form role="form">
            <div class="row">
                <div class="col-md-4">
                    <ordermetadatabox
                        :order="order"
                        order-type="Partner Order"
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
                                :class="{ 'has-error': $v.order.partner.$error }"
                            >
                                <h3 class="box-title">
                                    <i class="icon fa fa-sitemap fa-fw" />Partner
                                </h3>
                                <partnerselectionform
                                    ref="partnerSelection"
                                    v-model="order.partner"
                                    :editable="order.isEditable"
                                    @change="$v.order.partner.$touch()"
                                    @loaded="$v.order.partner.$reset()"
                                />
                                <fielderror v-if="$v.order.partner.$error">
                                    Field is required
                                </fielderror>
                            </div>

                            <div
                                class="col-md-6"
                                :class="{ 'has-error': $v.order.warehouse.$error }"
                            >
                                <h3 class="box-title">
                                    <i class="icon fa fa-industry fa-fw" />Source Warehouse
                                </h3>
                                <warehouseselectionform
                                    v-model="order.warehouse"
                                    :editable="order.isEditable"
                                    @change="$v.order.warehouse.$touch()"
                                />
                                <fielderror v-if="$v.order.warehouse.$error">
                                    Field is required
                                </fielderror>
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
                            <fielderror
                                v-if="$v.order.lineItems.$error"
                                classes="pull-right"
                            >
                                At least one line item must have a quantity
                            </fielderror>
                            <h3 class="box-title">
                                <i class="icon fa fa-list fa-fw" />Line Items
                            </h3>
                        </div>
                        <lineitemform
                            :products="products"
                            :line-items="order.lineItems"
                            :editable="order.isEditable"
                            :show-packs="true"
                            :partner-type="partnerType"
                        />
                    </div>
                </div>
            </div>
        </form>
        <modalinvalid />
        <modaldelete
            :action="this.deleteOrder"
            :order-title="order.title"
        />
        <modalcomplete
            :action="this.save"
            :order-title="order.title"
        />
    </section>
</template>


<script>
    import { required } from 'vuelidate/lib/validators';
    import { linesRequired, mod } from '../../../validators';
    import ModalOrderConfirmComplete from '../../../components/ModalOrderConfirmComplete';
    import ModalOrderConfirmDelete from '../../../components/ModalOrderConfirmDelete';
    import ModalOrderInvalid from '../../../components/ModalOrderInvalid';
    import FieldError from '../../../components/FieldError';
    import OrderMetadataBox from '../../../components/OrderMetadataBox.vue';
    import WarehouseSelectionForm from '../../../components/WarehouseSelectionForm.vue'
    import LineItemForm from '../../../components/LineItemForm.vue';
    import PartnerSelectionForm from '../../../components/PartnerSelectionForm.vue';
    export default {
        components: {
            'modalcomplete' : ModalOrderConfirmComplete,
            'modaldelete' : ModalOrderConfirmDelete,
            'modalinvalid' : ModalOrderInvalid,
            'fielderror' : FieldError,
            'ordermetadatabox' : OrderMetadataBox,
            'warehouseselectionform' : WarehouseSelectionForm,
            'lineitemform' : LineItemForm,
            'partnerselectionform' : PartnerSelectionForm
        },
        props: ['new'],
        data() {
            return {
                order: {
                    lineItems: [],
                    partner: { id: null },
                    warehouse: { id: null },
                    isEditable: true,
                    isDeletable: false,
                    status: "",
                    orderPeriod: "",
                },
                products: [],
                statuses: [
                    {id: "IN_PROCESS", name: "In Process"},
                    {id: "PENDING", name: "Pending"},
                    {id: "SHIPPED", name: "Shipped", commit: true },
                ],
                partnerType: 'AGENCY',
            };
        },
        validations: {
            order: {
                partner: {
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
                .get('/api/products', {params: { partnerOrderable: 1}})
                .then(response => this.products = response.data.data);
            if (this.new) {
            } else {
                axios
                    .get('/api/orders/partner/' + this.$route.params.id, {
                        params: { include: ['lineItems', 'lineItems.product', 'lineItems.transactions', 'partner.addresses', 'partnerAddress']}
                    })
                    .then(response => self.order = response.data.data);
            }
        },
        mounted() {
            this.$refs.partnerSelection.$on('partner-change', eventData => this.onPartnerChange(eventData));

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
                        .post('/api/orders/partner', this.order)
                        .then(response => self.$router.push('/orders/partner'))
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    axios
                        .patch('/api/orders/partner/' + this.$route.params.id, this.order)
                        .then(response => self.$router.push('/orders/partner'))
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
                    .delete('/api/orders/partner/' + this.$route.params.id)
                    .then(self.$router.push('/orders/partner'));
            },
            onPartnerChange: function(currentPartner) {
                this.partnerType = currentPartner.partnerType;
            }
        }
    }
</script>
