<template>
    <div>
        <div class="form-group">
            <label v-bind:class="{'col-xs-8': showCost || showPacks, 'col-xs-10': !showCost && !showPacks }" >
                <i class="fa fa-plus-circle text-gray fa-fw" @click="showTransactions = !showTransactions" title="Show/Hide Transactions"></i>
                {{ lineItem.product.name }}
                <small class="label bg-red" v-if="lineItem.product.status == 'OUTOFSTOCK'">Currently Out of Stock</small>
            </label>
            <div class="col-xs-2" v-if="showPacks">
                <strong v-text="packs"></strong> <small v-text="packs == 1 ? 'pack' : 'packs'"></small>
            </div>
            <div class="col-xs-2" v-bind:class="{'has-error': showPacks && lineItem.quantity % packSize != 0}">
                <input v-if="editable" type="text" class="form-control"  v-model="lineItem.quantity" />
                <span v-else v-text="lineItem.quantity"></span>
                <span class="help-block" v-show="showPacks && lineItem.quantity % packSize != 0">Must be a multiple of {{ packSize }}</span>
            </div>
            <div class="col-xs-2" v-if="showCost">
                <input v-if="editable" type="text" class="form-control" v-model="lineItem.cost" />
                <span v-else v-text="lineItem.cost"></span>
            </div>
        </div>
        <div class="form-group" v-show="showTransactions">
            <div class="col-xs-12">
                <hb-lineitemtransactions :transactions="lineItem.transactions"></hb-lineitemtransactions>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                showTransactions: false
            };
        },
        props: {
            lineItem: { type: Object, required: true },
            editable: { type: Boolean, default: true },
            showCost: { type: Boolean, default: false },
            showPacks: { type: Boolean, default: false },
            partnerType: { type: String, default: 'AGENCY' },
        },
        computed: {
            packSize: function () {
                if (this.partnerType === 'HOSPITAL' && this.lineItem.product.hospitalPackSize) {
                    return this.lineItem.product.hospitalPackSize;
                }

                return this.lineItem.product.agencyPackSize;
            },

            packs: function () {
                return this.lineItem.quantity / this.packSize;
            }
        }
    }
</script>