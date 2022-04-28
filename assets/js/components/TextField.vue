<template>
    <div :class="getFieldClass($v)">
        <label v-if="label">
            {{ label }}
            <i
                v-if="local_is_required"
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
            :disabled="!canEdit"
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
        FieldError,
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
            type: [String, Number],
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
        canEdit: {
            type: Boolean,
            required:false,
            default: true,
        },
    },

    data() {
        return {
            local_is_required: this.isRequired,
        };
    },

    created() {
        if (this.canEdit === false) {
            this.local_is_required = false;
        }
    },

    validations() {
        return (this.local_is_required) ? { value: { required } } : { value: {} };
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