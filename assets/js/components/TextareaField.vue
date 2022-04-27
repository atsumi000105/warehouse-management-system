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
        <textarea
            :disabled="!canEdit"
            :value="value"
            class="form-control"
            @input="$emit('input', $event.target.value)"
            @blur="$v.$touch()"
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
    name: 'TextareaField',

    components: {
        FieldError
    },

    props: {
        value: {
            type: String,
            required: false
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
}
</script>