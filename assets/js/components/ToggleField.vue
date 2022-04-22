<template>
    <div :class="getFieldClass($v)">
        <label>
            <input
                :disabled="getDisabledStatus()"
                :checked="value"
                type="checkbox"
                @change="$emit('input', $event.target.checked)"
                @blur="$v.$touch()"
            >
            <i
                v-if="local_is_required"
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
        canEdit: {
            type: Boolean,
            required:false,
            default: true,
        },
    },

    created() {
        if (this.canEdit === false) {
            this.local_is_required = false
        }
    },

    data() {
        return {
            local_is_required: this.isRequired,
        };
    },

    validations() {
        return (this.local_is_required) ? { value: { required } } : { value: {} };
    },

    methods: {
        getDisabledStatus: function() {
            if (this.disabled) {
                return true;
            }

            if (!this.canEdit) {
                return true;
            }
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
