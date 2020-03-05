<template>
    <div class="form-group">
        <label v-text="label" v-if="label"></label>
        <input
            :value="value"
            type="text"
            class="form-control"
            :placeholder="placeholder"
            @input="$emit('input', $event.target.value)"
        >
    </div>
</template>

<script>
    export default {
        name: 'TextField',
        props: {
            label: { type: [String, Boolean], default: false },
            value: { type: String, required: true },
            placeholder: { type: String, required: false, default: "" }
        }
    }
</script>