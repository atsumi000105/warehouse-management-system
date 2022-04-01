<template>
    <div :class="getFieldClass($v)">
        <label>
            <input
                :disabled="disabled"
                :checked="value"
                type="checkbox"
                @change="$emit('input', $event.target.checked)"
                @blur="$v.$touch()"
            >
            <i
                v-if="isRequired"
                class="fas fa-asterisk fa-fw text-danger"/>
            {{ label }}
        </label>
        <i
            v-if="helpText"
            v-tooltip
            :title="helpText"
            class="attribute-help-text fa fa-question-circle"
        />
        <FieldError v-if="$v.value.$error">
            <strong>Field is required</strong>
        </FieldError>
    </div>
</template>

<script>
import {required} from "vuelidate/lib/validators";
import FieldError from "./FieldError";

export default {
    name: "BooleanField",

    components: {
        FieldError
    },

    props: {
        label: {
            type: String,
            required: true
        },
        value: {
            type: Boolean
        },
        helpText: {
            type: String,
            required: false,
            default: ""
        },
        disabled: {
            type: Boolean,
            default: false
        },
        isRequired: {
            type: Boolean,
            required: false,
            default: false,
        },
    },

    validations() {
        return (this.isRequired) ? { value: { required } } : { value: {} };
    },

    methods: {
        getFieldClass: function(v) {
            if (v.value.$error) {
                return 'form-group has-error';
            }

            return 'form-group';
        },
    },
};
</script>
