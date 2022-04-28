<template>
    <div>
        <div :class="getFieldClass($v)">
            <label v-if="label">
                {{ label }}
                <i v-if="local_is_required" class="fas fa-asterisk fa-fw text-danger" />
            </label>
            <i
                v-if="helpText"
                v-tooltip
                :title="helpText"
                class="attribute-help-text fa fa-question-circle"
            />
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="far fa-calendar-alt" />
                </div>
                <input
                    v-model.lazy="humanReadable"
                    v-datepicker="{ format: format, tz: timezone }"
                    type="text"
                    class="form-control pull-right"
                    :disabled="getDisabledStatus()"
                    @change="$emit('input', dateValue)"
                    @blur="$v.$touch()"
                >
            </div>
            <FieldError v-if="$v.value.$error">
                Field is required
            </FieldError>
        </div>
    </div>
</template>

<script>
import {required} from 'vuelidate/lib/validators';
import FieldError from "./FieldError";

export default {
    name: "DateField",

    components: {
        FieldError
    },

    props: {
        value: {
            type: String,
            default: ""
        },
        label: {
            type: String,
            required: false,
            default: "Date:",
        },
        helpText: {
            type: String,
            required: false,
            default: ""
        },
        format: {
            type: String,
            default: "MM/DD/YYYY"
        },
        timezone: {
            type: String,
            required: false,
            default: "UTC"
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
            this.local_is_required = false;
        }
    },

    data() {
        return {
            dateValue: null,
            local_is_required: this.isRequired,
        };
    },

    validations() {
        return (this.local_is_required) ? { value: { required } } : { value: {} };
    },

    computed: {
        humanReadable: {
            get: function() {
                if (!this.dateValue && !this.value) {
                    return;
                }
                let date = moment.tz(this.dateValue || this.value, this.timezone);
                return date.format(this.format);
            },
            set: function(val) {
                let date = moment.tz(val, this.format, this.timezone);
                this.dateValue = val ? date.format() : null;
            }
        }
    },

    methods: {
        getDisabledStatus: function() {
            if (this.disabled) {
                return true;
            }

            if (! this.canEdit) {
                return true;
            }

            return false;
        },

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
};
</script>
