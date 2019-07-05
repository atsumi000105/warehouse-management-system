<template>
    <section class="content">
        <template>
            <div
                v-for="order in orders"
                :key="order.id"
            >
                <hb-fillsheet
                    :order="order"
                    :products="products"
                />
                <div class="page-break-after" />
            </div>
        </template>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                orders: [],
                products: [],
            };
        },
        created() {
            axios
                .get('/api/orders/partner/bulk', {
                    params: {
                        ids: this.$route.params.ids.split(','),
                        include: ['bags', 'lineItems', 'lineItems.product']
                    }
                })
                .then(response => this.orders = response.data.data);
            axios
                .get('/api/products', {params: { partnerOrderable: 1}})
                .then(response => this.products = response.data.data);
        }
    }
</script>