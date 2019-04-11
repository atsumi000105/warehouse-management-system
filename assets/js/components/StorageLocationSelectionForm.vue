<template>
    <div>
        <div class="form-group">
            <hb-optionlist
                    label="Storage Location:"
                    v-if="editable"
                    :preloadedOptions="allActiveStorageLocations"
                    v-model="value"
                    displayProperty="title"
                    groupProperty="type"
                    emptyString="-- Select Storage Location --"
                    ref="storageLocationSelect"
                    @change="onSelectionChange"
                    :alphabetize="false"
            ></hb-optionlist>
            <span v-else v-text="value.title"></span>
        </div>
        <div class="form-group" v-if="!editable">
            <hb-address v-model="value.address"></hb-address>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        props: {
            value: { required: true, type: Object },
            editable: { type: Boolean, default: true },
            v: { type: Object }
        },
        computed: mapGetters([
            'allActiveStorageLocations'
        ]),
        methods: {
            onSelectionChange: function (eventData) {
                let currentPartner = this.$store.getters.getStorageLocationById(eventData.currentTarget.value);
                this.$emit('change', eventData);
            }
        },
        mounted: function () {
            this.$store.dispatch('loadStorageLocations');
            this.$refs.storageLocationSelect.$on('change', eventData => this.onSelectionChange(eventData))
        }
    }
</script>