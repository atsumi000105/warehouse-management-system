<template>
    <div :class="getFieldClass($v)">
        <label v-if="label">
            {{ label }}
            <i
                v-if="isRequired"
                class="fas fa-asterisk fa-fw text-danger"/>
        </label>
        <i
            v-if="helpText"
            v-tooltip
            :title="helpText"
            class="attribute-help-text fa fa-question-circle"
        />
        <div v-if="canEdit" class="radio-inline">
            <div class="radio-inline">
                <label>
                    <input
                        v-model="selected_value"
                        type="radio"
                        :value="true"
                        @change="$emit('input', selected_value)"
                        @blur="$v.$touch()"
                    >
                    Yes
                </label>
            </div>
            <div class="radio-inline">
                <label>
                    <input
                        v-model="selected_value"
                        type="radio"
                        :value="false"
                        @change="$emit('input', selected_value)"
                        @blur="$v.$touch()"
                    >
                    No
                </label>
            </div>
            <FieldError v-if="$v.value.$error">
                <strong>Field is required</strong>
            </FieldError>
        </div>
        <div v-else class="radio-inline">
            {{ boolToStr(selected_value) }}
        </div>
    </div>
</template>

<script>
import {required} from "vuelidate/lib/validators";
import FieldError from "./FieldError";

export default {
    name: 'YesNoRadioField',

    components: {
        FieldError
    },

    props: {
        value: {
            type: Boolean,
            required: false,
        },
        label: {
            type: String,
            required: true
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
        canEdit: {
            type: Boolean,
            required:false,
            default: false,
        },
    },

    validations() {
        return (this.isRequired) ? { value: { required } } : { value: {} };
    },

    watch: {
        value(val) {
            if (val) {
                this.selected_value = val;
            }
        },
    },

    created() {
        this.selected_value = _.cloneDeep(this.value);

        if (this.canEdit === false) {
            this.isRequired = false;
        }
    },

    data() {
        return {
            selected_value: false,
        };
    },

    methods: {
        getFieldClass: function(v) {
            if (v.value.$error) {
                return 'form-group has-error';
            }

            return 'form-group';
        },

        boolToStr(val) {
            return (val) ? "Yes" : "No";
        }
    },
}
</script>