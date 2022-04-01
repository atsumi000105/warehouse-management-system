<template>
    <div>
        <OptionListEntity
            v-if="!multiple"
            ref="zipCountySelect"
            v-model="value"
            :api-path="'zip-county'"
            :display-property="'label'"
            :empty-string="'-- Select Zip Code --'"
            :label="label"
            :is-required="isRequired"
            @input="onSelectionChange"
        />
        <MultiOptionListEntity
            v-else
            ref="zipCountySelect"
            v-model="value"
            :api-path="'zip-county'"
            :display-property="'label'"
            :empty-string="'-- Select Zip Code --'"
            :label="label"
            :is-required="isRequired"
            @input="onSelectionChange"
        />
    </div>
</template>

<script>
    import OptionListEntity from './OptionListEntity.vue';
    import MultiOptionListEntity from "./MultiOptionListEntity";

    export default {
        name: 'ZipCountyField',

        components:{
            MultiOptionListEntity,
            OptionListEntity,
        },

        props: {
            value: {
                required: false,
                type: [
                    Object,
                    Array,
                    Number,
                ],
            },
            label: {
                type: String,
                default: "Zip Code"
            },
            multiple: {
                type: Boolean,
                default: false
            },
            helpText: {
                type: String,
                required: false,
                default: ""
            },
            isRequired: {
                type: Boolean,
                required: false,
                default: false,
            },
        },

        mounted: function () {
            this.$refs.zipCountySelect.$on('change', eventData => this.onSelectionChange(eventData))
        },

        methods: {
            onSelectionChange: function (eventData) {
                this.$emit('change', eventData.currentTarget.value);
            },

            getFieldClass: function(v) {
                if (v.value.$error) {
                    return 'form-group has-error';
                }

                return 'form-group';
            },
        },
    };
</script>
