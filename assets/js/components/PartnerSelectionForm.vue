<template>
    <div>
        <div class="form-group">
            <hb-optionlist
                    v-if="editable"
                    apiPath="partners/list-options"
                    v-model="value"
                    displayProperty="title"
                    emptyString="-- Select Partner --"
                    ref="partnerSelect"
                    :label="label"
            ></hb-optionlist>
            <span v-else v-text="value.title"></span>
        </div>
        <div class="form-group" v-if="!editable">
            <hb-address v-model="value.address" v="v.address"></hb-address>
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
        methods: {
            onSelectionChange: function (eventData) {
                let currentPartner = this.$store.getters.getStorageLocationById(eventData.currentTarget.value);
                this.$emit('partner-change', currentPartner);
            }
        },
        mounted: function () {
            this.$store.dispatch('loadStorageLocations');
            this.$refs.partnerSelect.$on('change', eventData => this.onSelectionChange(eventData))
        }
    }
</script>