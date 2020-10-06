<template>
    <table-paged
        v-if="client.id"
        :columns="columns"
        :api-url="apiUrl"
        :params="{include: ['order','order.partner']}"
        link-display-property="orderSequence"
        link-id-property="orderId"
        edit-route="/orders/distribution/"
    />
</template>

<script>
    import TablePaged from "../../components/TablePaged";
    export default {
        name: "ClientDistributionHistory",
        components: {TablePaged},
        props: {
            client: { type: Object, required: true }
        },
        data() {
            return {
                columns: [
                    { name: '__slot:link', title: 'Order Number'},
                    {
                        name: 'order.distributionPeriod',
                        title: 'Distribution Month',
                        callback: 'periodFormat'
                    },
                    { name: 'order.partner.title', title: 'Partner'},
                    { name: 'product.name', title: 'Size'},
                    { name: 'quantity', title: 'Quantity Distributed'}
                ],
            }
        },
        computed: {
            apiUrl: function () {
                return "/api/clients/" + this.client.id + "/history";
            }
        }
    }
</script>