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
        <div class="radio-inline">
            <label>
                <input
                    v-model="value"
                    type="radio"
                    :value="true"
                    @change="$emit('input', true)"
                    @blur="$v.$touch()"
                >
                Yes
            </label>
        </div>
        <div class="radio-inline">
            <label>
                <input
                    v-model="value"
                    type="radio"
                    :value="false"
                    @change="$emit('input', false)"
                    @blur="$v.$touch()"
                >
                No
            </label>
        </div>
        <FieldError v-if="$v.value.$error">
            <strong>Field is required</strong>
        </FieldError>
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
            required: true
        },
        label: {
            type: String
            , required: true
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