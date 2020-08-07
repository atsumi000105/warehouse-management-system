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
                />
                <YesNoRadioField
                    v-else-if="attribute.displayInterface === 'YES_NO_RADIO'"
                    v-model="attribute.value"
                    :label="attribute.label"
                />
                <DateField
                    v-else-if="attribute.displayInterface === 'DATETIME'"
                    v-model="attribute.value"
                    :label="attribute.label"
                />
                <NumberField
                    v-else-if="attribute.displayInterface === 'NUMBER'"
                    v-model="attribute.value"
                    :label="attribute.label"
                />
                <OptionListApi
                    v-else-if="attribute.displayInterface === 'SELECT_SINGLE'"
                    v-model="attribute.value"
                    :label="attribute.label"
                    :preloaded-options="attribute.options"
                />
                <RadioField
                    v-else-if="attribute.displayInterface === 'RADIO'"
                    v-model="attribute.value"
                    :label="attribute.label"
                    :preloaded-options="attribute.options"
                />
                <TextareaField
                    v-else-if="attribute.displayInterface === 'TEXTAREA'"
                    v-model="attribute.value"
                    :label="attribute.label"
                />
                <AddressFormFields
                    v-else-if="attribute.displayInterface === 'ADDRESS'"
                    v-model="attribute.value"
                    :label="attribute.label"
                />
                <TextField
                    v-else
                    v-model="attribute.value"
                    :label="attribute.label"
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
    import AddressFormFields from "./AddressFormFields";
    export default {
        name: 'AttributesEditForm',
        components: {
            AddressFormFields,
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