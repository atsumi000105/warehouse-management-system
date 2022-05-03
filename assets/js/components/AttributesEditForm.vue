<template>
    <div>
        <form role="form">
            <div
                v-for="attribute in attributes.filter(filter)"
                :key="attribute.definition_id"
                :class="bootstrapColSize"
            >
                <template v-if="showAttributeField(attribute) && defineCanViewAttribute(attribute)">
                    <BooleanField
                        v-if="attribute.displayInterface === 'TOGGLE'"
                        v-model="attribute.value"
                        :label="getLabel(attribute)"
                        :help-text="attribute.helpText"
                        :is-required="attribute.isRequired"
                        :can-edit="defineCanEditAttribute(attribute)"
                        :language="language"
                    />
                    <YesNoRadioField
                        v-else-if="attribute.displayInterface === 'YES_NO_RADIO'"
                        v-model="attribute.value"
                        :label="getLabel(attribute)"
                        :help-text="attribute.helpText"
                        :is-required="attribute.isRequired"
                        :can-edit="defineCanEditAttribute(attribute)"
                        :language="language"
                    />
                    <DateField
                        v-else-if="attribute.displayInterface === 'DATETIME'"
                        v-model="attribute.value"
                        :label="getLabel(attribute)"
                        :help-text="attribute.helpText"
                        :is-required="attribute.isRequired"
                        :can-edit="defineCanEditAttribute(attribute)"
                        :language="language"
                    />
                    <NumberField
                        v-else-if="attribute.displayInterface === 'NUMBER'"
                        v-model="attribute.value"
                        :label="getLabel(attribute)"
                        :help-text="attribute.helpText"
                        :is-required="attribute.isRequired"
                        :can-edit="defineCanEditAttribute(attribute)"
                        :language="language"
                    />
                    <OptionListApi
                        v-else-if="attribute.displayInterface === 'SELECT_SINGLE'"
                        v-model="attribute.value"
                        :label="getLabel(attribute)"
                        :help-text="attribute.helpText"
                        :preloaded-options="attribute.options"
                        :is-required="attribute.isRequired"
                        :can-edit="defineCanEditAttribute(attribute)"
                        :display-property="language === 'es' ? 'nameEs' : 'name'"
                        :language="language"
                    />
                    <OptionListApi
                        v-else-if="attribute.displayInterface === 'SELECT_MULTI'"
                        v-model="attribute.value"
                        :label="getLabel(attribute)"
                        :help-text="attribute.helpText"
                        :preloaded-options="attribute.options"
                        :multiple="true"
                        :is-required="attribute.isRequired"
                        :can-edit="defineCanEditAttribute(attribute)"
                        :display-property="language === 'es' ? 'nameEs' : 'name'"
                        :language="language"
                    />
                    <RadioField
                        v-else-if="attribute.displayInterface === 'RADIO'"
                        v-model="attribute.value"
                        :label="getLabel(attribute)"
                        :help-text="attribute.helpText"
                        :preloaded-options="attribute.options"
                        :is-required="attribute.isRequired"
                        :can-edit="defineCanEditAttribute(attribute)"
                        :display-property="language === 'es' ? 'nameEs' : 'name'"
                        :language="language"
                    />
                    <CheckboxGroupField
                        v-else-if="attribute.displayInterface === 'CHECKBOX_GROUP'"
                        v-model="attribute.value"
                        :name="attribute.name"
                        :label="getLabel(attribute)"
                        :help-text="attribute.helpText"
                        :preloaded-options="attribute.options"
                        :is-required="attribute.isRequired"
                        :can-edit="defineCanEditAttribute(attribute)"
                        :display-property="language === 'es' ? 'nameEs' : 'name'"
                        :language="language"
                    />
                    <TextareaField
                        v-else-if="attribute.displayInterface === 'TEXTAREA'"
                        v-model="attribute.value"
                        :label="getLabel(attribute)"
                        :help-text="attribute.helpText"
                        :is-required="attribute.isRequired"
                        :can-edit="defineCanEditAttribute(attribute)"
                        :language="language"
                    />
                    <AddressField
                        v-else-if="displayAddressFiled(attribute)"
                        v-model="attribute.value"
                        :label="getLabel(attribute)"
                        :help-text="attribute.helpText"
                        :is-required="attribute.isRequired"
                        :can-edit="defineCanEditAttribute(attribute)"
                    />
                    <ZipCountyField
                        v-else-if="attribute.displayInterface === 'ZIPCODE' && defineCanEditAttribute(attribute)"
                        v-model="attribute.value"
                        :label="getLabel(attribute)"
                        :help-text="attribute.helpText"
                        :is-required="attribute.isRequired"
                        :can-edit="defineCanEditAttribute(attribute)"
                        @change="onChangeZip(attribute, $event)"
                        :language="language"
                    />
                    <FileUploadField
                        v-else-if="attribute.displayInterface === 'FILE_UPLOAD' && defineCanEditAttribute(attribute)"
                        v-model="attribute.value"
                        :label="getLabel(attribute)"
                        :help-text="attribute.helpText"
                        :is-required="attribute.isRequired"
                        :can-edit="defineCanEditAttribute(attribute)"
                    />
                    <TextField
                        v-else
                        v-model="attribute.value"
                        :label="getLabel(attribute)"
                        :help-text="attribute.helpText"
                        :is-required="attribute.isRequired"
                        :can-edit="defineCanEditAttribute(attribute)"
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
                required: false,
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
            language: {
                type: String,
                default: 'en',
                required: false,
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
            getLabel: function (attribute) {
                if (this.language === 'es') {
                    return attribute.labelEs;
                }

                return attribute.label;
            },

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

            defineCanViewAttribute(attribute) {
                if (attribute.attributeFieldPermissions && attribute.attributeFieldPermissions.length) {
                    const canEditFound = attribute.attributeFieldPermissions.filter(permission => {
                        if (permission.definition_id === attribute.definition_id) {
                            return attribute.user.includes(permission.group_id);
                        }
                    });

                    return !!canEditFound.filter(canView => canView.can_view).length;
                }

                return true;
            },

            defineCanEditAttribute(attribute) {
                if (attribute.attributeFieldPermissions && attribute.attributeFieldPermissions.length) {
                    const canEditFound = attribute.attributeFieldPermissions.filter(permission => {
                        if (permission.definition_id === attribute.definition_id) {
                            return attribute.user.includes(permission.group_id);
                        }
                    });

                    return !!canEditFound.filter(canEdit => canEdit.can_edit).length;
                }

                return true;
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