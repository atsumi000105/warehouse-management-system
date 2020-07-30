<template>
    <div>
        <form role="form">
            <div
                v-for="attribute in attributes"
                :key="attribute.definition_id"
            >
                <BooleanField
                    v-if="attribute.displayInterface === 'TOGGLE'"
                    v-model="attribute.value"
                    :label="attribute.label"
                    :helpText="attribute.helpText"
                />
                <YesNoRadioField
                    v-else-if="attribute.displayInterface === 'YES_NO_RADIO'"
                    v-model="attribute.value"
                    :label="attribute.label"
                    :helpText="attribute.helpText"
                />
                <DateField
                    v-else-if="attribute.displayInterface === 'DATETIME'"
                    v-model="attribute.value"
                    :label="attribute.label"
                    :helpText="attribute.helpText"
                />
                <NumberField
                    v-else-if="attribute.displayInterface === 'NUMBER'"
                    v-model="attribute.value"
                    :label="attribute.label"
                    :helpText="attribute.helpText"
                />
                <OptionListApi
                    v-else-if="attribute.displayInterface === 'SELECT_SINGLE'"
                    v-model="attribute.value"
                    :label="attribute.label"
                    :helpText="attribute.helpText"
                    :preloaded-options="attribute.options"
                />
                <RadioField
                    v-else-if="attribute.displayInterface === 'RADIO'"
                    v-model="attribute.value"
                    :label="attribute.label"
                    :helpText="attribute.helpText"
                    :preloaded-options="attribute.options"
                />
                <TextareaField
                    v-else-if="attribute.displayInterface === 'TEXTAREA'"
                    v-model="attribute.value"
                    :label="attribute.label"
                    :helpText="attribute.helpText"
                />
                <TextField
                    v-else
                    v-model="attribute.value"
                    :label="attribute.label"
                    :helpText="attribute.helpText"
                />
            </div>
        </form>
    </div>
</template>


<script>
    import DateField from "./DateField";
    import TextField from "./TextField";
    import NumberField from "./NumberField";
    import OptionListApi from "./OptionListApi";
    import TextareaField from "./TextareaField";
    import RadioField from "./RadioField";
    import BooleanField from "./ToggleField";
    import YesNoRadioField from "./YesNoRadioField";
    export default {
        name: 'AttributesEditForm',
        components: {
            YesNoRadioField,
            BooleanField, RadioField, TextareaField, OptionListApi, NumberField, TextField, DateField},
        props: {
            new: { type: Boolean },
            value: { type: Array, required: true }
        },
        computed: {
            attributes: function () {
                if (this.value) {
                    let attributes = this.value;
                    return attributes.sort((a, b) => a.orderIndex - b.orderIndex)
                }

                return []
            }
        },
    }
</script>