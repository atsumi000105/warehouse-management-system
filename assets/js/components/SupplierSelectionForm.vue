<template>
    <div>
        <div class="form-group">
            <hb-optionlist
                    v-if="editable"
                    v-model="value"
                    :preloadedOptions="allActiveSuppliers"
                    displayProperty="title"
                    emptyString="-- Select Supplier --"
                    ref="supplierSelect"
                    :label="label"
            ></hb-optionlist>
            <span v-else v-text="value.title"></span>
        </div>
        <div class="form-group" v-if="address">
            <hb-optionlist
                    v-if="editable"
                    :preloadedOptions="supplierAddresses"
                    v-model="addressValue"
                    displayProperty="optionList"
                    emptyString="-- Select Supplier Address --"
            ></hb-optionlist>
            <!-- text input -->
            <hb-address v-else v-model="addressValue"></hb-address>
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
        methods: {
            onSelectionChange(event) {
                let found = this.$store.getters.getSupplierById(event.target.value);
                this.supplierAddresses.length = 0;
                if(found){
                    this.supplierAddresses.push(...found.addresses);
                }
            },
        },
        mounted: function () {
            this.$store.dispatch('loadSuppliers');
            this.$refs.supplierSelect.$on('change', eventData => this.onSelectionChange(eventData));
        }
    }
</script>