<template>
    <div class="box box-info">
        <div class="box-body">
            <h2>{{ orderType }} {{ order.id }}</h2>
            <div class="form-group"  v-bind:class="{ 'has-error': statusError }">
                <template v-if="editable">
                    <hb-optionliststatic
                            label="Status:"
                            v-model="order"
                            property="status"
                            :preloadedOptions="statuses"
                            emptyString="-- Select Status --"
                    ></hb-optionliststatic>
                    <hb-fielderror v-if="statusError">Field is required</hb-fielderror>
                </template>

                <template v-else>
                    <strong>Status:</strong>
                    <span>{{ order.status | orderStatusFormat }}</span>
                </template>
            </div>

            <div class="form-group"  v-if="order.hasOwnProperty('orderPeriod')">
                <template v-if="editable">
                    <label>Order Period:</label>

                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" v-datepicker="{format: 'YYYY-MM-DD', tz:'Etc/UTC'}" v-model="order.orderPeriod">
                    </div>
                </template>

                <template v-else>
                    <strong>Order Period:</strong>
                    <span>{{ order.orderPeriod | dateTimeMonthFormat }}</span>
                </template>
            </div>

            <div class="form-group"  v-if="order.hasOwnProperty('distributionPeriod')">
                <template v-if="editable">
                    <label>Distribution Period:</label>

                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" v-datepicker="{format: 'YYYY-MM-DD', tz:'Etc/UTC'}" v-model="order.distributionPeriod">
                    </div>
                </template>

                <template v-else>
                    <strong>Distribution Period:</strong>
                    <span>{{ order.distributionPeriod | dateTimeMonthFormat }}</span>
                </template>
            </div>

            <div class="form-group"  v-if="order.hasOwnProperty('receivedAt')">
                <template v-if="editable">
                    <hb-date label="Received Date:" v-model="order.receivedAt"></hb-date>
                </template>

                <template v-else>
                    <strong>Received Date:</strong>
                    <span>{{ order.receivedAt | dateFormat }}</span>
                </template>
            </div>
            <div class="form-group"  v-if="order.hasOwnProperty('portalOrderId')">
                <strong>Portal Order ID:</strong>
                <span>{{ order.portalOrderId }}</span>
            </div>
            <strong>Created:</strong> {{ order.createdAt | dateTimeFormat }}<br/>
            <strong>Last Updated:</strong> {{ order.updatedAt | dateTimeFormat }}
        </div>
        <!-- /.box-body -->
    </div>
</template>

<script>
    export default {
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