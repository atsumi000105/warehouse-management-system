<template>
    <div class="form-group">
        <label v-text="label"></label>
        <input
            v-model="value"
            type="text"
            class="form-control"
            @input="$emit('input', $event.target.value)"
        >
    </div>
</template>

<script>
    export default {
        name: 'TextField',
        props: {
            label: { required: true, type: String },
            value: { type: String, required: true }
        }
    }
</script>