<template>
    <hb-fillsheet :order="order" :products="products"></hb-fillsheet>
</template>

<script>
    export default {
        data() {
            return {
                order: {
                    bags: [],
                    partner: {},
                },
                products: [],
            };
        },
        created() {
            axios.get('/api/orders/partner/' + this.$route.params.id, {
                params: { include: ['bags', 'lineItems', 'lineItems.product']}
            }).then(response => this.order = response.data.data);
            axios.get('/api/products', {params: { partnerOrderable: 1}}).then(response => this.products = response.data.data);
        }
    }
</script>