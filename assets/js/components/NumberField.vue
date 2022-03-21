<template>
    <div class="form-group">
        <label v-text="label" />
        <i
            v-if="helpText"
            v-tooltip
            :title="helpText"
            class="attribute-help-text fa fa-question-circle"
        />
        <input
            :value="selected_value"
            type="number"
            class="form-control"
            :placeholder="placeholder"
            :disabled="disabled"
            @input="$emit('input', $event.target.value)"
        >
    </div>
</template>

<script>
export default {
    name: "NumberField",

    props: {
        value: {
            type: [
                Number,
                String,
            ],
        },
        label: {
            type: String,
            required: true
        },
        helpText: {
            type: String,
            requird: false,
            default: ""
        },
        placeholder: {
            type: [
                String,
                Number
            ]
        },
        disabled: {
            type: Boolean,
            default: false
        }
    },

    data() {
        return {
            selected_value: '',
        }
    },

    watch: {
        value(val) {
            if (val) {
                this.selected_value = val;
            }
        },
    },
};
</script>
