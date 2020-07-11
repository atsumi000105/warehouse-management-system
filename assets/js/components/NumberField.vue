<template>
    <div class="form-group">
        <label v-text="label" />
        <input
            :value="value"
            type="number"
            class="form-control"
            :placeholder="placeholder"
            @input="$emit('input', $event.target.value)"
        >
    </div>
</template>

<script>
    export default {
        name: 'NumberField',
        props: {
            label: { required: true, type: String },
            value: { type: String, required: true },
            placeholder: { type: [String,Number] },
        }
    }
</script>