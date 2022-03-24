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
            :value="selected_value"
            type="number"
            class="form-control"
            :placeholder="placeholder"
            :disabled="disabled"
            @input="$emit('input', $event.target.value)"
            @blur="$v.$touch()"
        >
        <FieldError v-if="$v.value.$error">
            Field is required
        </FieldError>
    </div>
</template>

<script>
import {required} from "vuelidate/lib/validators";
import FieldError from "./FieldError";

export default {
    name: "NumberField",

    components: {
        FieldError
    },

    props: {
        value: {
            type: [
                Number,
                String,
            ],
        },
        label: {
            type: String,
            required: true
        },
        helpText: {
            type: String,
            requird: false,
            default: ""
        },
        placeholder: {
            type: [
                String,
                Number
            ]
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

    data() {
        return {
            selected_value: '',
        }
    },

    methods: {
        getFieldClass: function(v) {
            if (v.value.$error) {
                return 'form-group has-error';
            }

            return 'form-group';
        },
    },

    watch: {
        value(val) {
            if (val) {
                this.selected_value = val;
            }
        },
    },
};
</script>
