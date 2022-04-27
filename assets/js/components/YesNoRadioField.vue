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
        <div class="radio-inline">
            <label>
                <input
                    v-model="selected_value"
                    type="radio"
                    :disabled="!canEdit"
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
                    :disabled="!canEdit"
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
            default: true,
        },
    },

    validations() {
        return (this.local_is_required) ? { value: { required } } : { value: {} };
    },

    watch: {
        value(val) {
            if (val) {
                this.selected_value = val;
            }
        },
    },

    data() {
        return {
            selected_value: false,
            local_is_required: this.isRequired,
        };
    },

    created() {
        this.selected_value = _.cloneDeep(this.value);

        if (this.canEdit === false) {
            this.local_is_required = false;
        }
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