<template>
    <div>
        <div class="form-group">
            <hb-optionlist
                v-if="editable"
                ref="storageLocationSelect"
                v-model="value"
                label="Storage Location:"
                :preloaded-options="allActiveStorageLocations"
                display-property="title"
                group-property="type"
                empty-string="-- Select Storage Location --"
                :alphabetize="false"
                @change="onSelectionChange"
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
            <hb-address v-model="value.address" />
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import Address from '../components/AddressView.vue';
    import OptionList from '../components/OptionList.vue';
    export default {
        components: {
            Address,
            OptionList
        },
        props: {
            value: { required: true, type: Object },
            editable: { type: Boolean, default: true },
            v: { type: Object }
        },
        computed: mapGetters([
            'allActiveStorageLocations'
        ]),
        mounted: function () {
            this.$store.dispatch('loadStorageLocations');
            this.$refs.storageLocationSelect.$on('change', eventData => this.onSelectionChange(eventData))
        },
        methods: {
            onSelectionChange: function (eventData) {
                let currentPartner = this.$store.getters.getStorageLocationById(eventData.currentTarget.value);
                this.$emit('change', eventData);
            }
        }
    }
</script>
