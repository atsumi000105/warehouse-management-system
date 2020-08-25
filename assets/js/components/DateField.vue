<template>
    <div class="form-group">
        <label v-text="label" />

        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar" />
            </div>
            <input
                v-model.lazy="humanReadable"
                v-datepicker="{format: format, tz: timezone}"
                type="text"
                class="form-control pull-right"
                @change="$emit('input', dateValue)"
            >
        </div>
    </div>
</template>

<script>
    export default {
        name: 'DateField',
        props: {
            value: { type: String },
            label: { required: false, type: String, default: 'Date:' },
            format: { type: String, default: 'MM/DD/YYYY'},
            timezone: { type: String, required: false },
        },
        data() {
            return { dateValue: null }
        },
        computed: {
            humanReadable: {
                get: function() {
                    let date = moment.tz(this.dateValue || this.value, this.timezone);
                    return date.format(this.format);
                },
                set: function(val) {
                    let date = moment.tz(val, this.format, this.timezone);
                    this.dateValue = val ? date.format() : null;
                },
            }
        }
    }
</script>