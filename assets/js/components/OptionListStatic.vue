<template>
    <div class="form-group">
        <label v-text="label" />
        <template v-if="chosen && loaded">
            <select
                v-model="value"
                v-chosen
                class="form-control"
                @change="$emit('input', $event.target.value)"
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
                    v-text="displayText(item)"
                />
            </select>
        </template>
        <template v-else-if="!chosen && loaded">
            <select
                v-model="value"
                class="form-control"
                @change="$emit('input', $event.target.value)"
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
        name: 'OptionListStatic',
        props: {
            value: { type: [Number,String] },
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