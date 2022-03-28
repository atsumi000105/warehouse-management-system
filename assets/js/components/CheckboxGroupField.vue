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
            class="checkbox"
        >
            <label>
                <input
                    v-model="selected_values"
                    type="checkbox"
                    :value="option.id"
                    :name="'chekbox-group-'+name"
                    @change="$emit('input', selected_values)"
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
    name: 'CheckboxGroupField',

    components: {
      FieldError
    },

    props: {
        value: {
            type: [
                String,
                Array
            ],
            required: true
        },
        isRequired: {
          type: Boolean,
          required: false,
          default: false,
        },
        name: {
            type: String,
            required: true
        },
        label: {
            type: String
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
        }
    },

    validations() {
      return (this.isRequired) ? { value: { required } } : { value: {} };
    },

    data() {
        return {
            listOptions: [],
            selected_values: [],
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
        value(vals) {
            if (vals) {
                this.selected_values = vals;
            }
        },
    },

}
</script>