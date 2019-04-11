<template>
    <div class="box-body form-horizontal">
        <div class="form-group">
            <h4 v-bind:class="{'col-xs-8': showCost || showPacks, 'col-xs-10': !showCost && !showPacks }">Product</h4>
            <h4 class="col-xs-2" v-if="showPacks">Packs</h4>
            <h4 class="col-xs-2">Quantity</h4>
            <h4 class="col-xs-2" v-if="showCost">Cost</h4>
        </div>
        <template  v-for="product in products" v-if="findLineItem(product)">
            <hr>
            <hb-lineitemformrow :lineItem="findLineItem(product)" :showCost="showCost" :editable="editable" :showPacks="showPacks" :partnerType="partnerType"></hb-lineitemformrow>
        </template>
    </div>


</template>

<script>
    export default {
        props: {
            products: { type: Array, required: true },
            lineItems: { type: Array, required: true },
            editable: { type: Boolean, default: true },
            showCost: { type: Boolean, default: false },
            showPacks: { type: Boolean, default: false },
            partnerType: { type: String, default: 'AGENCY' }
        },
        methods: {
            findLineItem: function(product) {
                let self = this;
                let lineItem = this.lineItems.filter(function(line) {
                    return line.product.id === product.id;
                }).pop();

                if (!lineItem) {
                    lineItem = self.lineItems.push({
                        product: product,
                        cost: product.defaultCost,
                        quantity: null,
                    });
                }

                return lineItem;
            }
        }
    }
</script>