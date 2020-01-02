<template>
    <div class="form-group">
        <label v-text="label"></label>
        <textarea
            :value="value"
            class="form-control"
            @input="$emit('input', $event.target.value)"
        />
    </div>
</template>

<script>
    export default {
        name: 'TextareaField',
        props: {
            label: { required: true, type: String },
            value: { type: String, required: true }
        }
    }
</script>