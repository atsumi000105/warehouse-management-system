<template>
    <div class="form-group">
        <label v-text="label" v-if="label"></label>
        <div v-text="value" />
    </div>
</template>

<script>
    export default {
        name: 'DisplayField',
        props: {
            label: { type: [String, Boolean], default: false },
            value: { type: String, required: true },
        }
    }
</script>