<template>
    <section class="content">
        <div class="pull-right">
            <button class="btn btn-success btn-flat" v-on:click.prevent="saveVerify" :disabled="!order.isEditable"><i class="fa fa-save fa-fw"></i>Save Order</button>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle dropdown btn-flat" data-toggle="dropdown">
                    <span class="fa fa-ellipsis-v"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li v-if="order.isDeletable"><a href="#" v-on:click.prevent="askDelete"><i class="fa fa-trash fa-fw"></i>Delete Order</a></li>
                    <li>
                        <router-link :to='"/orders/partner/" + order.id + "/fill-sheet"'>
                            <i class="fa fa-print fa-fw"></i>Print Fill Sheet
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
        <h3 class="box-title">Edit Partner Order</h3>

            <form role="form">
                <div class="row">

                    <div class="col-md-4">
                        <hb-ordermetadatabox :order="order" orderType="Partner Order" :statuses="statuses" :editable="order.isEditable" :v="$v.order"></hb-ordermetadatabox>
                    </div>

                    <div class="col-md-8">
                        <div class="box box-info">
                            <div class="box-body">
                            <div class="col-md-6" v-bind:class="{ 'has-error': $v.order.partner.$error }">
                                <h3 class="box-title"><i class="icon fa fa-sitemap fa-fw"></i>Partner</h3>
                                <hb-partnerselectionform ref="partnerSelection" v-model="order.partner" :editable="order.isEditable" @change="$v.order.partner.$touch()" @loaded="$v.order.partner.$reset()"></hb-partnerselectionform>
                                <hb-fielderror v-if="$v.order.partner.$error">Field is required</hb-fielderror>
                            </div>

                            <div class="col-md-6" v-bind:class="{ 'has-error': $v.order.warehouse.$error }">
                                <h3 class="box-title"><i class="icon fa fa-industry fa-fw"></i>Source Warehouse</h3>
                                <hb-warehouseselectionform v-model="order.warehouse"  :editable="order.isEditable" @change="$v.order.warehouse.$touch()"></hb-warehouseselectionform>
                                <hb-fielderror v-if="$v.order.warehouse.$error">Field is required</hb-fielderror>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-info" v-bind:class="{ 'has-error': $v.order.lineItems.$error }">
                            <div class="box-header with-border">
                                <hb-fielderror classes="pull-right" v-if="$v.order.lineItems.$error">At least one line item must have a quantity</hb-fielderror>
                                <h3 class="box-title"><i class="icon fa fa-list fa-fw"></i>Line Items</h3>
                            </div>
                            <hb-lineitemform :products="products" :line-items="order.lineItems" :editable="order.isEditable" :showPacks="true" :partnerType="partnerType"></hb-lineitemform>
                        </div>
                    </div>
                </div>
            </form>
        <hb-modalinvalid></hb-modalinvalid>
        <hb-modaldelete :action="this.deleteOrder" :orderTitle="order.title"></hb-modaldelete>
        <hb-modalcomplete :action="this.save" :orderTitle="order.title"></hb-modalcomplete>
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
                if(this.new) {
                    axios.post('/api/orders/partner', this.order)
                        .then(response => self.$router.push('/orders/partner'))
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    axios.patch('/api/orders/partner/' + this.$route.params.id, this.order)
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
                axios.delete('/api/orders/partner/' + this.$route.params.id).then(self.$router.push('/orders/partner'));
            },
            onPartnerChange: function(currentPartner) {
                this.partnerType = currentPartner.partnerType;
            }
        },
        created() {
            var self = this;
            axios.get('/api/products', {params: { partnerOrderable: 1}}).then(response => this.products = response.data.data);
            if(this.new) {
            } else {
                axios.get('/api/orders/partner/' + this.$route.params.id, {
                    params: { include: ['lineItems', 'lineItems.product', 'lineItems.transactions', 'partner.addresses', 'partnerAddress']}
                }).then(response => self.order = response.data.data);
            }
        },
        mounted() {
            this.$refs.partnerSelection.$on('partner-change', eventData => this.onPartnerChange(eventData));

            console.log('Component mounted.')
        }
    }
</script>