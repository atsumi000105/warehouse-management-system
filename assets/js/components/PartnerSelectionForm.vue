<template>
    <div>
        <div class="form-group">
            <hb-optionlist
                    v-if="editable"
                    ref="partnerSelect"
                    v-model="value"
                    api-path="partners/list-options"
                    display-property="title"
                    empty-string="-- Select Partner --"
                    :label="label"
            />
            <span
                v-else
                v-text="value.title"
            />
        </div>
        <div
            v-if="!editable"
            class="form-group"
        >
            <hb-address
                v-model="value.address"
                v="v.address"
            />
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        props: {
            value: { required: true, type: Object },
            editable: { type: Boolean, default: true },
            label: { type: String },
        },
        computed: mapGetters([
            'allActiveStorageLocations'
        ]),
        mounted: function () {
            this.$store.dispatch('loadStorageLocations');
            this.$refs.partnerSelect.$on('change', eventData => this.onSelectionChange(eventData))
        },
        methods: {
            onSelectionChange: function (eventData) {
                let currentPartner = this.$store.getters.getStorageLocationById(eventData.currentTarget.value);
                this.$emit('partner-change', currentPartner);
            }
        }
    }
</script>