<template>
    <div class="form-group">
        <label
            class="control-label"
            v-text="label"
        />
        <div class="radio-inline">
            <label>
                <input
                    v-model="value"
                    type="radio"
                    :value="true"
                    @change="$emit('input', $event.target.value)"
                >
                Yes
            </label>
        </div>
        <div class="radio-inline">
            <label>
                <input
                    v-model="value"
                    type="radio"
                    :value="false"
                    @change="$emit('input', $event.target.value)"
                >
                No
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'YesNoRadioField',
        props: {
            label: { required: true, type: String },
            value: { type: Boolean, required: true }
        }
    }
</script>