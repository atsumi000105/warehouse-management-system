<template>
    <div>
        <div class="form-group">
            <option-list-entity
                :label="label"
                v-if="editable"
                ref="warehouseSelect"
                v-model="value"
                display-property="title"
                :preloaded-options="allActiveWarehouses"
                empty-string="-- Select Warehouse --"
            />
            <span
                v-else
                v-text="value.title"
            />
            <!-- text input -->
        </div>
        <div
            v-if="!editable"
            class="form-group"
        >
            <address-view v-model="value.address" />
        </div>
    </div>
</template>

<script>
    import Address from '../components/AddressView.vue';
    import OptionListEntity from './OptionListEntity.vue';
    import {mapGetters} from "vuex";

    export default {
        components: {
            'address-view' : Address,
            OptionListEntity
        },

        props: {
            value: {
                required: true,
                type: Object,
            },
            editable: {
                type: Boolean,
                default: true,
            },
            v: {
                type: Object,
            },
            label: String,
        },

        computed: mapGetters([
            'allActiveWarehouses',
        ]),

        mounted: function () {
            this.$store.dispatch('loadStorageLocations');
            this.$refs.warehouseSelect.$on('change', eventData => this.onSelectionChange(eventData))
        },

        methods: {
            onSelectionChange: function(eventData) {
                let currentWarehouse = this.$store.getters.getStorageLocationById(eventData.currentTarget.value);
                this.$emit("change", currentWarehouse);
            }
        },
    }
</script>
