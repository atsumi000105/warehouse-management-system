<template>
    <div :class="getFieldClass($v)">
        <label v-if="label">
            {{ label }}
            <i
                v-if="isRequired"
                class="fas fa-asterisk fa-fw text-danger"/>
        </label>
        <select
            v-if="!groupProperty"
            v-model="selected_value[property]"
            v-chosen
            class="form-control"
            @change="onChange($event, $v)"
            @blur="$v.$touch()"
        >
            <option
                value=""
                v-text="emptyOption"
            />
            <option
                v-for="item in options"
                :key="item.id"
                :selected="selected_value.id === item.id"
                :value="item.id"
                v-text="item[displayProperty].title ? item[displayProperty].title : item[displayProperty]"
            />
        </select>
        <select
            v-else
            v-model="selected_value[property]"
            v-chosen
            class="form-control"
            @change="onChange($event, $v)"
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
                    :selected="selected_value[property] === item.id"
                    :value="item.id"
                    v-text="item[displayProperty]"
                />
            </optgroup>
        </select>
        <FieldError v-if="$v.value.$error">
            <strong v-if="language === 'en'">Field is required</strong>
            <strong v-else>Campo es requerido</strong>
        </FieldError>
    </div>
</template>

<script>
import {required, minLength} from "vuelidate/lib/validators";
import FieldError from "./FieldError";

export default {
    name: 'OptionListEntity',

    components: {
        FieldError,
    },

    props: {
        value: {
            type: Object
        },
        validate: {
            type: Boolean,
            default: true,
        },
        label: {
            type: [
                String,
                Boolean
            ],
            default: false
        },
        apiPath: {
            type: String
        },
        preloadedOptions: {
            type: Array,
            default: function() {return []}
        },
        displayProperty: {
            type: String,
            default: 'name'
        },
        property: {
            type: String,
            default: 'id'
        },
        groupProperty: {
            type: String,
            default: null
        },
        emptyString: {
            type: String
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
        language: {
            type: String,
            default: 'en',
            required: false,
        },
    },

    data() {
        return {
            listOptions: [],
            loaded: false,
            selected_value: '',
        }
    },

    validations () {
        if (this.property !== 'id') {
            return (this.isRequired && this.validate) ? { value: { property: {required} } } : { value: {} };
        }

        return (this.isRequired && this.validate) ? { value: { id: {required} } } : { value: {} };
    },

    computed: {
        options: function() {
            let self = this;
            let list = self.listOptions.length > 0 ? self.listOptions : self.preloadedOptions;

            // THIS IS THE PROBLEM!!!!!!!
            // if (this.alphabetize) {
            //     list = list.sort(function(a, b) {
            //         return a[self.displayProperty] > b[self.displayProperty] ? 1 : -1;
            //     })
            // }

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
        value(val) {
            if (val) {
                this.selected_value = val;
            }
        },
    },

    created() {
        var self = this;

        if (!self.value || !self.value.id) self.value.id = null;

        if (this.apiPath) {
            axios
                .get('/api/' + this.apiPath)
                .then(response => {
                    self.listOptions = response.data.data;
                    self.loaded = true;
                    self.$emit('loaded');
            });
        } else {
            self.listOptions = self.preloadedOptions;
            self.loaded = true;
            self.$emit('loaded');
        }

        self.selected_value = _.cloneDeep(self.value);
    },

    methods: {
        onChange: function(event) {
            this.$emit('change', event);
        },

        getFieldClass: function(v) {
            if (v.value.$error) {
                return 'form-group has-error';
            }

            return 'form-group';
        },
    }
}
</script>
