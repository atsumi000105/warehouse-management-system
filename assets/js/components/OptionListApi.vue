<template>
    <div>
        <div v-if="canEdit" :class="getFieldClass($v)">
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
            <select
                v-if="!groupProperty"
                v-model="selected_values"
                v-chosen
                class="form-control"
                :class="{'loaded': loaded}"
                :multiple="multiple"
                @change="onChange"
                @blur="$v.$touch()"
            >
                <option
                    value=""
                    v-text="emptyOption"
                />
                <option
                    v-for="item in options"
                    :key="item.id"
                    :selected="value == item.id"
                    :value="item.id"
                    v-text="item[displayProperty]"
                />
            </select>
            <select
                v-else
                v-model="selected_values"
                v-chosen
                class="form-control"
                :class="{'loaded': loaded}"
                :multiple="multiple"
                @change="onChange"
                @blur="$v.$touch()"
            >
                <option
                    value=""
                    v-text="emptyOption"
                />
                <optgroup
                    v-for="group in options"
                    :key="group.id"
                    :label="label"
                >
                    <option
                        v-for="item in group"
                        :key="item.id"
                        :selected="value == item.id"
                        :value="item.id"
                        v-text="item[displayProperty]"
                    />
                </optgroup>
            </select>
            <FieldError v-if="$v.value.$error">
                <strong>Field is required</strong>
            </FieldError>
        </div>
        <div v-else>
            <strong>{{ label }}:</strong>
            <div v-for="value in getLabelArray(selected_values, listOptions)" :key="value">
                {{ value }}
            </div>
            <br>
        </div>
    </div>
</template>

<script>
import {required} from "vuelidate/lib/validators";
import FieldError from "./FieldError";

export default {
    name: "OptionListApi",

    components: {
        FieldError
    },

    props: {
        value: {
            type: [String, Number],
            default: () => "",
        },
        label: {
            type: String,
        },
        helpText: {
            type: String,
            requird: false,
            default: "",
        },
        apiPath: {
            type: String,
        },
        preloadedOptions: {
            type: Array,
            default: function() {return []},
        },
        displayProperty: {
            type: String,
            default: 'name',
        },
        property: {
            type: String,
            default: 'id',
        },
        groupProperty: {
            type: String,
            default: null,
        },
        emptyString: {
            type: String,
        },
        alphabetize: {
            type: Boolean,
            default: true,
        },
        multiple: {
            type: Boolean,
            default: false,
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

    data() {
        return {
            listOptions: [],
            selected_values: [],
            local_is_required: this.isRequired,
            current_value_labels: [],
        }
    },

    computed: {
        loaded: function() {
            return this.options.length > 0;
        },

        options: function() {
            var self = this;
            let list = self.listOptions.length > 0 ? self.listOptions : self.preloadedOptions;

            if (this.alphabetize) {
                list = list.sort(function(a, b) {
                    return a[self.displayProperty] > b[self.displayProperty] ? 1 : -1;
                });
            }

            if (this.groupProperty) {
                let groupings = {};
                list.forEach( function(item) {
                    if (!groupings[item[self.groupProperty]]) {
                        groupings[item[self.groupProperty]] = [];
                    }
                    groupings[item[self.groupProperty]].push(item);
                });
                list = groupings;
            }

            return list;
        },

        emptyOption: function() {
            return this.emptyString ? this.emptyString : '-- Select Item --';
        }
    },

    watch: {
        value(vals) {
            if (vals) {
                this.selected_values = vals;
            }
        },
    },

    created() {
        var self = this;

        if (this.apiPath) {
            axios
                .get('/api/' + this.apiPath)
                .then(response => {
                    self.listOptions = response.data.data;
                    self.$emit('loaded');
            });
        } else {
            self.listOptions = self.preloadedOptions;
        }

        self.selected_values = _.cloneDeep(self.value);

        if (this.canEdit === false) {
            this.local_is_required = false;
        }
    },

    validations() {
        return (this.local_is_required) ? { value: { required } } : { value: {} };
    },

    methods: {
        onChange($event) {
            if(this.multiple) {
                this.$emit('input',[...$event.target.selectedOptions]
                    .map(option => option.value));
            } else {
                this.$emit('input', $event.target.value);
            }
        },

        getLabelArray(selectedValues, optionList) {
            const self = this;

            return optionList.map(option => {

                if (Array.isArray(selectedValues)) {
                    if (selectedValues.includes(option.id)) {
                        return option[self.displayProperty];
                    }
                } else {
                    if (option.id === selectedValues) {
                        return option[self.displayProperty];
                    }
                }
            }).filter(notUndefined => notUndefined !== undefined);
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
