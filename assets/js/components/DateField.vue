<template>
    <div class="form-group">
        <label v-text="label"></label>

        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input
                    type="text"
                    class="form-control pull-right"
                    v-datepicker="{format: format, tz: timezone}"
                    v-model.lazy="humanReadable"
                    v-on:change="$emit('input', dateValue)">
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            label: { required: false, type: String, default: 'Date:' },
            value: { type: String },
            format: { type: String, default: 'MM/DD/YYYY'},
            timezone: { type: String },
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
                    this.dateValue = val ? date.toISOString() : null;
                },
            }
        },
    }
</script>