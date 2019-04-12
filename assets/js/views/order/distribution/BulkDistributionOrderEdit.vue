<template>
    <section class="content">
        <div class="pull-right">
            <button class="btn btn-success btn-flat" v-on:click.prevent="saveVerify" :disabled="!order.isEditable"><i class="fa fa-save fa-fw"></i>Save Order</button>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle dropdown btn-flat" data-toggle="dropdown">
                    <span class="fa fa-ellipsis-v"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li v-if="order.isDeletable"><a href="#" v-on:click.prevent="askDelete"><i class="fa fa-trash fa-fw"></i>Delete Distribution</a></li>
                </ul>
            </div>
        </div>
        <h3 class="box-title">Edit Partner Distribution</h3>

        <form role="form">
            <div class="row">

                <div class="col-md-4">
                    <hb-ordermetadatabox :order="order" :statuses="statuses" :editable="order.isEditable" orderType="Partner Distribution Order" :v="$v.order"></hb-ordermetadatabox>
                </div>

                <div class="col-md-8">
                    <div class="box box-info">
                        <div class="box-body" v-bind:class="{ 'has-error': $v.order.partner.$error }">
                            <h3 class="box-title"><i class="icon fa fa-sitemap fa-fw"></i>Partner</h3>
                            <hb-partnerselectionform v-model="order.partner" :editable="order.isEditable" @change="$v.order.partner.$touch()" @loaded="$v.order.partner.$reset()"></hb-partnerselectionform>
                            <hb-fielderror v-if="$v.order.partner.$error">Field is required</hb-fielderror>
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
                        <hb-lineitemform :products="products" :line-items="order.lineItems" :editable="order.isEditable" :showPacks="true"></hb-lineitemform>
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
                    isEditable: true,
                    isDeletable: false,
                    status: 'COMPLETED',
                    reason: '',
                },
                products: [],
                statuses: [
                    {id: "PENDING", name: "Pending"},
                    {id: "COMPLETED", name: "Completed", commit: true },
                ]
            };
        },
        validations: {
            order: {
                partner: {
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
                    axios.post('/api/orders/distribution', this.order)
                        .then(response => self.$router.push('/orders/distribution'))
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    axios.patch('/api/orders/distribution/' + this.$route.params.id, this.order)
                        .then(response => self.$router.push('/orders/distribution'))
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
                axios.delete('/api/orders/distribution/' + this.$route.params.id).then(self.$router.push('/orders/distribution'));
            }
        },
        created() {
            var self = this;
            axios.get('/api/products', {params: { partnerOrderable: 1}}).then(response => this.products = response.data.data);
            if(this.new) {
            } else {
                axios.get('/api/orders/distribution/' + this.$route.params.id, {
                    params: { include: ['lineItems', 'lineItems.product', 'lineItems.transactions', 'partner.addresses']}
                }).then(response => self.order = response.data.data);

            }
            console.log('Component mounted.')
        }
    }
</script>