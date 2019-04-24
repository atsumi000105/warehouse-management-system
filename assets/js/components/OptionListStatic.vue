<template>
    <div class="form-group">
        <label v-text="label" />
        <template v-if="chosen && loaded">
            <select
                v-model="value[property]"
                v-chosen
                class="form-control"
            >
                <option
                    value=""
                    v-text="emptyOption"
                />
                <option
                    v-for="item in options"
                    :selected="value[property] == item.id"
                    :value="item.id"
                    v-text="displayText(item)"
                />
            </select>
        </template>
        <template v-else-if="!chosen && loaded">
            <select
                v-model="value[property]"
                class="form-control"
            >
                <option
                    value=""
                    v-text="emptyOption"
                />
                <option
                    v-for="item in options"
                    :selected="value[property] == item.id"
                    :value="item.id"
                    v-text="displayText(item)"
                />
            </select>
        </template>
        <select
            v-else
            class="form-control"
            disabled
        >
            <option selected>
                Loading...
            </option>
        </select>
    </div>
</template>

<script>
    export default {
        props: {
            value: { type: Object },
            property: { type: String },
            label: { type: String },
            preloadedOptions: { type: Array, default: function() {return []}},
            displayProperty: { type: String, default: 'name'},
            displayTextFn: { type: Function },
            emptyString: { type: String },
            alphabetize: { type: Boolean, default: true },
            chosen: { type: Boolean, default: true }
        },

        data() {
            return {
                listOptions: [],
            }
        },

        computed: {
            loaded: function() { return this.options.length > 0 },
            options: function() { return this.listOptions.length > 0 ? this.listOptions : this.preloadedOptions },
            emptyOption: function() { return this.emptyString ? this.emptyString : '-- Select Item --'}
        },

        created() {
            var self = this;

            self.listOptions = self.preloadedOptions;
        },

        methods: {
            displayText: function(item) {
                if (this.displayTextFn) {
                    return this.displayTextFn(item);
                } else {
                    return item[this.displayProperty];
                }
            }
        },
    }
</script>