<template>
    <div>
        <div>
            <label :class="{'col-xs-6': showCost || showPacks, 'col-xs-8': !showCost && !showPacks }">
                <i
                    class="fa fa-plus-circle text-gray fa-fw"
                    title="Show/Hide Transactions"
                    @click="showTransactions = !showTransactions"
                />
                {{ lineItem.client.name.firstName }} {{ lineItem.client.name.lastName }}
            </label>
            <div
                class="col-xs-2"
            >
                <ProductSelectionField
                    v-model="lineItem.product"
                    :label="false"
                />
            </div>
            <div
                class="col-xs-2"
                :class="{'has-error': showPacks && lineItem.quantity % packSize != 0}"
            >
                <input
                    v-if="editable"
                    v-model="lineItem.quantity"
                    type="text"
                    class="form-control"
                >
                <span
                    v-else
                    v-text="lineItem.quantity"
                />
                <span
                    v-show="showPacks && lineItem.quantity % packSize != 0"
                    class="help-block"
                >
                    Must be a multiple of {{ packSize }}
                </span>
            </div>
            <div
                v-if="showCost"
                class="col-xs-2"
            >
                <input
                    v-if="editable"
                    v-model="lineItem.cost"
                    type="text"
                    class="form-control"
                >
                <span
                    v-else
                    v-text="lineItem.cost"
                />
            </div>
        </div>
        <div
            v-show="showTransactions"
            class="form-group"
        >
            <div class="col-xs-12">
                <lineitemtransactions :transactions="lineItem.transactions" />
            </div>
        </div>
    </div>
</template>

<script>
    import LineItemTransactionTable from "../../../components/LineItemTransactionTable";
    import OptionListStatic from "../../../components/OptionListStatic";
    import { mapGetters } from 'vuex'
    import ProductSelectionField from "../../../components/ProductSelectionField";

    export default {
        name: "BulkDistributionLineItemFormRow",
        components: {
            ProductSelectionField,
            'lineitemtransactions' : LineItemTransactionTable
        },
        props: {
            lineItem: { type: Object, required: true },
            editable: { type: Boolean, default: true },
            showCost: { type: Boolean, default: false },
            showPacks: { type: Boolean, default: false },
            partnerType: { type: String, default: 'AGENCY' },
        },
        data() {
            return {
                showTransactions: false
            };
        },
        computed: {
            ...mapGetters([
                'allActiveProducts',
            ]),
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
