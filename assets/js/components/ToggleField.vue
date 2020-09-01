<template>
    <div class="checkbox">
        <label>
            <input
                :checked="value"
                type="checkbox"
                @change="$emit('input', $event.target.checked)"
            > {{ label }}
        </label>
    </div>
</template>

<script>
    export default {
        name: 'BooleanField',
        props: {
            label: { required: true, type: String },
            value: { type: Boolean }
        }
    }
</script>