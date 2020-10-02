<template>
    <table-paged
        v-if="client.id"
        :columns="columns"
        :api-url="apiUrl"
        :params="{include: ['partners']}"
        link-display-property="order.sequence"
        edit-route="/orders/distribution"
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
                    { name: '__slot:link', title: 'Order Number', sortField: 'order.sequence' },
                    { name: 'order.partner', title: 'Partner', sortField: 'order.partner.name'},
                    { name: 'product.name', title: 'Size', sortField: 'product.name'},
                    { name: 'quantity', title: 'Quantity Distributed', sortField: 'quantity'},
                    {
                        name: 'order.distributionPeriod',
                        title: 'Distribution Month',
                        sortField: 'order.distributionPeriod',
                        callback: 'periodFormat'
                    }
                ],
            }
        },
        computed: {
            apiUrl: function () {
                return "/api/client/" + this.client.id + "/history";
            }
        }
    }
</script>