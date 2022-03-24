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
        <div
            v-for="option in options"
            :key="option.id"
            class="radio"
        >
            <label>
                <input
                    v-model="selected_value"
                    type="radio"
                    :value="option.id"
                    @change="$emit('input', $event.target.value)"
                    @blur="$v.$touch()"
                >
                {{ displayText(option) }}
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
        name: 'RadioField',

        components: {
            FieldError
        },

        props: {
            value: {
                type: String,
                required: false
            },
            label: {
                type: String
            },
            helpText: {
                type: String,
                requird: false,
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
        },

        data() {
            return {
                listOptions: [],
                selected_value: '',
            }
        },

        validations() {
            return (this.isRequired) ? { value: { required } } : { value: {} };
        },

        computed: {
            loaded: function() {
                return this.options.length > 0
            },

            options: function() {
                return this.listOptions.length > 0 ? this.listOptions : this.preloadedOptions
            },
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

        watch: {
            value(val) {
                if (val) {
                    this.selected_value = val;
                }
            },
        },
    }
</script>