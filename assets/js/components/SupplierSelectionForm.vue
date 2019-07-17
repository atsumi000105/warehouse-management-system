<template>
    <div>
        <div class="form-group">
            <hb-optionlist
                v-if="editable"
                ref="supplierSelect"
                v-model="value"
                :preloaded-options="allActiveSuppliers"
                display-property="title"
                empty-string="-- Select Supplier --"
                :label="label"
            />
            <span
                v-else
                v-text="value.title"
            />
        </div>
        <div
            v-if="address"
            class="form-group"
        >
            <hb-optionlist
                v-if="editable"
                v-model="addressValue"
                :preloaded-options="supplierAddresses"
                display-property="optionList"
                empty-string="-- Select Supplier Address --"
            />
            <!-- text input -->
            <hb-address
                v-else
                v-model="addressValue"
            />
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        props: {
            value: { required: true, type: Object },
            addressValue: { required: false, type: Object },
            editable: { type: Boolean, default: true },
            address: { type: Boolean, default: true },
            label: { type: String, default: "" },
        },
        data() {
            return {
                suppliers: [],
            }
        },
        computed: {
            supplierAddresses: function() {
                return this.value.addresses ? this.value.addresses : [];
            },
            ...mapGetters([
               'allActiveSuppliers'
            ])
        },
        mounted: function () {
            this.$store.dispatch('loadSuppliers');
            this.$refs.supplierSelect.$on('change', eventData => this.onSelectionChange(eventData));
        },
        methods: {
            onSelectionChange(event) {
                let found = this.$store.getters.getSupplierById(event.target.value);
                this.supplierAddresses.length = 0;
                if (found) {
                    this.supplierAddresses.push(...found.addresses);
                }
            },
        }
    }
</script>