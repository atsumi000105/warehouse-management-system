<template>
    <div class="box box-info">
        <div class="box-body">
            <h2>{{ orderType }} {{ order.id }}</h2>
            <div
                class="form-group"
                :class="{ 'has-error': statusError }"
            >
                <template v-if="editable">
                    <hb-optionliststatic
                        v-model="order"
                        label="Status:"
                        property="status"
                        :preloaded-options="statuses"
                        empty-string="-- Select Status --"
                    />
                    <hb-fielderror v-if="statusError">
                        Field is required
                    </hb-fielderror>
                </template>

                <template v-else>
                    <strong>Status:</strong>
                    <span>{{ order.status | orderStatusFormat }}</span>
                </template>
            </div>

            <div
                v-if="order.hasOwnProperty('orderPeriod')"
                class="form-group"
            >
                <template v-if="editable">
                    <label>Order Period:</label>

                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar" />
                        </div>
                        <input
                            v-model="order.orderPeriod"
                            v-datepicker="{format: 'YYYY-MM-DD', tz:'Etc/UTC'}"
                            type="text"
                            class="form-control pull-right"
                        >
                    </div>
                </template>

                <template v-else>
                    <strong>Order Period:</strong>
                    <span>{{ order.orderPeriod | dateTimeMonthFormat }}</span>
                </template>
            </div>

            <div
                v-if="order.hasOwnProperty('distributionPeriod')"
                class="form-group"
            >
                <template v-if="editable">
                    <label>Distribution Period:</label>

                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar" />
                        </div>
                        <input
                            v-model="order.distributionPeriod"
                            v-datepicker="{format: 'YYYY-MM-DD', tz:'Etc/UTC'}"
                            type="text"
                            class="form-control pull-right"
                        >
                    </div>
                </template>

                <template v-else>
                    <strong>Distribution Period:</strong>
                    <span>{{ order.distributionPeriod | dateTimeMonthFormat }}</span>
                </template>
            </div>

            <div
                v-if="order.hasOwnProperty('receivedAt')"
                class="form-group"
            >
                <template v-if="editable">
                    <hb-date
                        v-model="order.receivedAt"
                        label="Received Date:"
                    />
                </template>

                <template v-else>
                    <strong>Received Date:</strong>
                    <span>{{ order.receivedAt | dateFormat }}</span>
                </template>
            </div>
            <div
                v-if="order.hasOwnProperty('portalOrderId')"
                class="form-group"
            >
                <strong>Portal Order ID:</strong>
                <span>{{ order.portalOrderId }}</span>
            </div>
            <strong>Created:</strong> {{ order.createdAt | dateTimeFormat }}<br>
            <strong>Last Updated:</strong> {{ order.updatedAt | dateTimeFormat }}
        </div>
        <!-- /.box-body -->
    </div>
</template>

<script>
    import FieldError from '../components/FieldError.vue';
    import DateField from '../components/DateField.vue';
    export default {
        components: {
            FieldError,
            DateField
        },
        props: {
            order: { type: Object, required: true },
            orderType: { type: String, required: true, },
            editable: { type: Boolean, default: true },
            statuses: { type: Array, required: true },
            v: { type: Object },
        },
        computed: {
            statusError: function () {
                return this.v && this.v.status && this.v.status.$error;
            }
        }
    }
</script>
