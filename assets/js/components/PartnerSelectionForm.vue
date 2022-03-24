<template>
    <div>
        <div
            v-if="editable"
            class="form-group"
        >
            <optionlist
                ref="partnerSelect"
                v-model="value"
                :preloaded-options="options"
                display-property="title"
                empty-string="-- Select Partner --"
                :label="label"
                :is-required="isRequired"
            />
        </div>
        <div
            v-else
            class="form-group"
        >
            <b>{{ label }}</b>
            <p>{{ value.title }}</p>

            <address-view
                v-model="value.address"
                v="v.address"
            />
        </div>
    </div>
</template>

<script>
import Address from "../components/AddressView.vue";
import OptionListEntity from "./OptionListEntity.vue";

export default {
    components: {
        "address-view": Address,
        optionlist: OptionListEntity
    },
    props: {
        value: {
            type: Object
        },
        editable: {
            type: Boolean,
            default: true
        },
        label: {
            type: String,
            default: "Partner"
        },
        options: {
            type: Array,
            default: () => []
        },
        isRequired: {
            type: Boolean,
            required: false,
            default: false,
        },
    },

    mounted: function() {
        this.$store.dispatch("loadStorageLocations");

        if (this.$refs.partnerSelect) {
            this.$refs.partnerSelect.$on("change", eventData => this.onSelectionChange(eventData));
        }
    },

    methods: {
        onSelectionChange: function(eventData) {
            let currentPartner = this.$store.getters.getStorageLocationById(eventData.currentTarget.value);
            this.$emit("partner-change", currentPartner);
        }
    }
};
</script>
