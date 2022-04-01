<template>
    <div>
        <form role="form">
            <div
                v-for="attribute in attributes.filter(filter)"
                :key="attribute.definition_id"
                :class="bootstrapColSize"
            >
                <template v-if="showAttributeField(attribute)">
                    <BooleanField
                        v-if="attribute.displayInterface === 'TOGGLE'"
                        v-model="attribute.value"
                        :label="attribute.label"
                        :help-text="attribute.helpText"
                        :is-required="attribute.isRequired"
                    />
                    <YesNoRadioField
                        v-else-if="attribute.displayInterface === 'YES_NO_RADIO'"
                        v-model="attribute.value"
                        :label="attribute.label"
                        :help-text="attribute.helpText"
                        :is-required="attribute.isRequired"
                    />
                    <DateField
                        v-else-if="attribute.displayInterface === 'DATETIME'"
                        v-model="attribute.value"
                        :label="attribute.label"
                        :help-text="attribute.helpText"
                        :is-required="attribute.isRequired"
                    />
                    <NumberField
                        v-else-if="attribute.displayInterface === 'NUMBER'"
                        v-model="attribute.value"
                        :label="attribute.label"
                        :help-text="attribute.helpText"
                        :is-required="attribute.isRequired"
                    />
                    <OptionListApi
                        v-else-if="attribute.displayInterface === 'SELECT_SINGLE'"
                        v-model="attribute.value"
                        :label="attribute.label"
                        :help-text="attribute.helpText"
                        :preloaded-options="attribute.options"
                        :is-required="attribute.isRequired"
                    />
                    <OptionListApi
                        v-else-if="attribute.displayInterface === 'SELECT_MULTI'"
                        v-model="attribute.value"
                        :label="attribute.label"
                        :help-text="attribute.helpText"
                        :preloaded-options="attribute.options"
                        :multiple="true"
                        :is-required="attribute.isRequired"
                    />
                    <RadioField
                        v-else-if="attribute.displayInterface === 'RADIO'"
                        v-model="attribute.value"
                        :label="attribute.label"
                        :help-text="attribute.helpText"
                        :preloaded-options="attribute.options"
                        :is-required="attribute.isRequired"
                    />
                    <CheckboxGroupField
                        v-else-if="attribute.displayInterface === 'CHECKBOX_GROUP'"
                        v-model="attribute.value"
                        :name="attribute.name"
                        :label="attribute.label"
                        :help-text="attribute.helpText"
                        :preloaded-options="attribute.options"
                        :is-required="attribute.isRequired"
                    />
                    <TextareaField
                        v-else-if="attribute.displayInterface === 'TEXTAREA'"
                        v-model="attribute.value"
                        :label="attribute.label"
                        :help-text="attribute.helpText"
                        :is-required="attribute.isRequired"
                    />
                    <AddressField
                        v-else-if="displayAddressFiled(attribute)"
                        v-model="attribute.value"
                        :label="attribute.label"
                        :help-text="attribute.helpText"
                        :is-required="attribute.isRequired"
                    />
                    <ZipCountyField
                        v-else-if="attribute.displayInterface === 'ZIPCODE'"
                        v-model="attribute.value"
                        :label="attribute.label"
                        :help-text="attribute.helpText"
                        :is-required="attribute.isRequired"
                        @change="onChangeZip(attribute, $event)"
                    />
                    <FileUploadField
                        v-else-if="attribute.displayInterface === 'FILE_UPLOAD'"
                        v-model="attribute.value"
                        :label="attribute.label"
                        :help-text="attribute.helpText"
                        :is-required="attribute.isRequired"
                    />
                    <TextField
                        v-else
                        v-model="attribute.value"
                        :label="attribute.label"
                        :help-text="attribute.helpText"
                        :is-required="attribute.isRequired"
                    />
                </template>
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
    import CheckboxGroupField from "./CheckboxGroupField";
    import BooleanField from "./ToggleField";
    import YesNoRadioField from "./YesNoRadioField";
    import AddressField from "./AddressField";
    import ZipCountyField from "./ZipCountyField";
    import FileUploadField from "./FileUploadField";

    export default {
        name: 'AttributesEditForm',

        components: {
            FileUploadField,
            CheckboxGroupField,
            ZipCountyField,
            AddressField,
            YesNoRadioField,
            BooleanField,
            RadioField,
            TextareaField,
            OptionListApi,
            NumberField,
            TextField,
            DateField,
        },

        props: {
            new: {
                type: Boolean,
            },
            value: {
                type: Array,
                required: true,
            },
            filter: {
                type: Function,
                required: false,
                default: (attribute) => true,
            },
            bootstrapColSize: {
                type: String,
                required: false,
                default: 'col-md-12',
            },
            showAddressComponent: {
                type: Boolean,
                required: false,
                default: true,
            },
            onlyPublicAttributes: {
                type: Boolean,
                required: false,
                default: false,
            },
        },

        computed: {
            attributes: function () {
                if (this.value) {
                    let attributes = this.value;
                    return attributes.sort((a, b) => a.orderIndex - b.orderIndex)
                }

                return []
            },
        },

        methods: {
            onChangeZip: function (attribute, data) {
                if (attribute) {
                    attribute.value.id = data;
                }
            },

            checkIfAttributeIsRequired: function (attribute) {
                if (this.showAttributeField(attribute) && attribute.isRequired) {
                    return true;
                }

                return false;
            },

            displayAddressFiled: function(attribute) {
                if (attribute.displayInterface === 'ADDRESS' && this.showAddressComponent === true) {
                    return true;
                }

                return false;
            },

            showAttributeField: function(attribute) {
                if (this.onlyPublicAttributes) {
                    return attribute.isDisplayedPublicly;
                }

                return true;
            }
        },
    }
</script>