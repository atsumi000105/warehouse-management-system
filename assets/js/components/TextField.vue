<template>
    <div class="form-group">
        <label v-text="label"></label>
        <input
            :value="value"
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