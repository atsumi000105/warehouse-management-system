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
        <input
            :value="value"
            type="text"
            class="form-control"
            :placeholder="placeholder"
            @input="$emit('input', $event.target.value)"
            @blur="$v.$touch()"
        >
    </div>
</template>

<script>
import {required} from "vuelidate/lib/validators";
import FieldError from "./FieldError";

export default {
    name: 'TextField',

    components: {
        FieldError
    },

    props: {
        isRequired: {
            type: Boolean,
            required: false,
            default: false,
        },
        label: {
            type: [
                String,
                Boolean
            ],
            default: false
        },
        value: {
            type: String,
            required: false
        },
        placeholder: {
            type: String,
            required: false,
            default: ""
        },
        helpText: {
            type: String,
            required: false,
            default: ""
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