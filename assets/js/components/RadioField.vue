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
        <div
            v-for="option in options"
            :key="option.id"
            class="radio"
        >
            <label>
                <input
                    v-model="selected_value"
                    :disabled="!canEdit"
                    type="radio"
                    :value="option.id"
                    @change="$emit('input', $event.target.value)"
                    @blur="$v.$touch()"
                >
                {{ displayText(option) }}
            </label>
        </div>
        <FieldError v-if="$v.value.$error">
            <strong v-if="language === 'en'">Field is required</strong>
            <strong v-else>Campo es requerido</strong>
        </FieldError>
    </div>
</template>

<script>
import {required} from "vuelidate/lib/validators";
import FieldError from "./FieldError";

    export default {
        name: 'RadioField',

        components: {
            FieldError
        },

        props: {
            value: {
                type: [String, Number],
                required: false,
                default: "",
            },
            label: {
                type: String,
                required: false,
                default: "",
            },
            helpText: {
                type: String,
                required: false,
                default: ""
            },
            displayProperty: {
                type: String,
                default: 'name'
            },
            displayTextFn: {
                type: Function
            },
            preloadedOptions: {
                type: Array,
                default: function() {
                    return []
                }
            },
            alphabetize: {
                type: Boolean,
                default: true
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
            language: {
                type: String,
                default: 'en',
                required: false,
            },
        },

        data() {
            return {
                listOptions: [],
                selected_value: '',
                local_is_required: this.isRequired,
            }
        },

        computed: {
            loaded: function() {
                return this.options.length > 0
            },

            options: function() {
                return this.listOptions.length > 0 ? this.listOptions : this.preloadedOptions
            },
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
                this.local_is_required = false;
            }
        },

        validations() {
            return (this.local_is_required) ? { value: { required } } : { value: {} };
        },

        methods: {
            displayText: function(item) {
                if (this.displayTextFn) {
                    return this.displayTextFn(item);
                } else {
                    return item[this.displayProperty];
                }
            },

            getFieldClass: function(v) {
                if (v.value.$error) {
                    return 'form-group has-error';
                }

                return 'form-group';
            },
        },
    }
</script>